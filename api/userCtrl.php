<?php
header('Access-Control-Allow-Origin: *');
require_once("db.php");
require_once("notification.php");
require_once("messaging.php");    //sendMsg 

class User extends Database{

   public function __construct(){
    $con      = self::con();
    @$action  = trim($_POST['action']);
    session_start();
    switch($action){
        case 'register':
            self::register($con);
        break;

        case 'login':
           self::login($con);
        break;

        case 'update':
            self::updateUserInfo($_SESSION["NL_USER_LIVE"]);
         break;

        case 'recover_password':
            self::recoverPassword($con);
        break;

        case 'update_password':
            self::updatePassword($_SESSION["NL_USER_LIVE"]);
        break;

        case 'bankInfo':
            self::bankInfo($_SESSION["NL_USER_LIVE"]);
        break;
        
        case 'delUsers':
            self::deleteUser();    // this deletes a user
        break;  

        case 'delName':
            self::deleteName($_SESSION["NL_USER_LIVE"]);        // Delete this name  viewNameDetails
        break; 
       
        case 'viewName':
            self::viewNameDetails($_SESSION["NL_USER_LIVE"]);    // Delete this name  
        break; 

        case 'addName':
            self::addName($_SESSION["NL_USER_LIVE"]); 
        break;  
        
        case 'editName':
            self::editName($_SESSION["NL_USER_LIVE"]); 
        break; 
        
        case 'contact':
            self::contactUs(); 
        break; 
        
        case 'sendMsg': 
            $msg        = new Message($_POST['senderId'], $_POST['receiverId'], null, $_POST['msgTitle'], $_POST['msg']);
            if($_POST['senderId']===$_POST['receiverId']){
                die("Sorry you cannot send message to yourself");
            }else{ 
                if($msg->sendMessage()){
                    echo true;
                }else{
                    echo "Error Sending Message";
                }
          }
        break; 

        case 'replyMsg':
            $msg = new Message($_POST['senderId'], $_POST['receiverId'], $_POST['msgId'], null, $_POST['msg']); 
            if($_POST['senderId']===$_POST['receiverId']){
                die("Sorry you cannot reply your own message");
            }else{
                if($msg->sendMessage()){
                    echo true; 
                }else{
                    echo "Error Sending Message => ".$msg->sendMessage();
                }
            }

        break;

    }

   }
 
   

   public function getAdminId(){ 
       $con          = self::con();
       $query        = $con->query("SELECT * FROM `admins`");
       $a            = array(); 
       while($row = $query->fetch_assoc()){  array_push($a,$row['adminId']);  }

       if (in_array(1, $a)){ unset($a[array_search(1,$a)]);}  // exclude Super admin from the list ID of THE SUPPER ADMIN = 1

       return $a[array_rand($a)];     // Choose only one admin
   }
 

   private function register($con){
       // `memId`, `fullName`, `email`, `pwd`, `date_created`, `date_updated`
       $fname           = trim($_POST["fullName"]);   //fullName  inputEmail inputPassword
       $email           = trim($_POST["inputEmail"]);
       $pass            = trim($_POST["password"]);
      
        if(self::checkUserExist($con,$email,"members","email")==false){	
            $pass_hash = password_hash($pass,PASSWORD_DEFAULT);
            $sql       = "INSERT INTO `members`(`fullName`, `email`, `pwd`, `date_created`) VALUES(?,?,?,NOW())";
            $statement = $con->prepare($sql);
            $statement->bind_param("sss",$fname,$email,$pass_hash);
            if($statement->execute()){
                echo true;
                $_SESSION["NL_USER_LIVE"]  = $email;
            }else{
                echo "Error Registering ".$statement->error;
            }
            $statement->close();
      }else{
          echo 'User Already Exist! Try logging in instead';
      }
    $con->close();
   }


   private function login($con){ 
    $email    = trim($_POST["email"]);
    $pass     = trim($_POST["pwd"]);
    if(self::checkUserExist($con,$email,"members","email")){	
        $sql  		= "SELECT * FROM `members` WHERE `email`=?";
        $stmt 		= $con->prepare($sql);
        $stmt->bind_param("s",$email);  
        
       if($stmt->execute()){
            $result	   = $stmt->get_result();
            $row       = $result->fetch_assoc();
            if($row['user_status']==1){
                if(password_verify($pass,$row['pwd'])){
                    $user 	      = $_SESSION["NL_USER_LIVE"] = $row['email'];
                    if(isset($user)){
                        echo true;
                    }else{
                        echo "Sorry No Session Was set at this time";
                    }
                    }else{
                    echo "Incorrect Password";
                }
            }else{
              die("Your account is blocked! Please contact us @ nameslexicon@gmail.com");
            }
            
       }else{
        echo "LOGIN FAILED  ".$stmt->error;
    }
       
    }else{
        echo "The User with this emil does not exist";
    }
   }
   
public function contactUs(){
    // `conId`, `name`, `email`, `subject`, `message`, `createdAt`
    $con        = self::con();
    $name       = $this->clean_input($_POST['name']);
    $email      = $this->clean_input($_POST['email']);
    $subject    = $this->clean_input($_POST['subject']);
    $msg        = $this->clean_input($_POST['message']);
    $sql        = "INSERT INTO `contact`(`name`, `email`, `subject`, `message`, `createdAt`) VALUES(?,?,?,?,NOW())";
    $stmt       = $con->prepare($sql);
    $stmt->bind_param("ssss",$name,$email,$subject,$msg);
    if($stmt->execute()){
       echo true;
    }else{
       echo "Error Sending message ".$con->error;
    }
}


   // Return User Details as Associative array
   public function getMemberDetails($email){
        $con        = self::con();
        $queryRow   = $con->query("SELECT * FROM `members` WHERE `email` ='$email'")->fetch_assoc();
        return  $queryRow;
   }

   // Get User/member details by ID
   public function getMemberDetailsById($uid){
    $con        = self::con();
    $queryRow   = $con->query("SELECT * FROM `members` WHERE `mID` ='$uid'")->fetch_assoc();
    return  $queryRow;
}


   // Get User/member details by ID
public function getNameDetailsById($nId){
    $con        = self::con();
    $queryRow   = $con->query("SELECT * FROM `names` WHERE `namesId` ='$nId'")->fetch_assoc();
    return      $queryRow;
  }

// Get Bank Info 
public function getBankInfo($email){
    $con = self::con();
    $uid = $this->getMemberDetails($email)['memId'];
    $checkAccountExist = $con->query("SELECT * FROM `bankInfo` WHERE `memId` ='$uid'");
    if($checkAccountExist->num_rows>0){
       $row     = $checkAccountExist->fetch_assoc();
       return   $row;
    }
    
}


//  fullName  email  dob profilePix
  private function updateUserInfo($email){ 
        $con          = self::con();
         $fname       = $this->clean_input($_POST['fullName']);
         $em          = $this->clean_input($_POST['email']);
         $gender      = $this->clean_input($_POST['gender']);
         $dob         = $this->clean_input($_POST['dob']);  $realBob = date("Y-m-d", strtotime($dob));
         $profPix     = $this->uploadProfilePix('profilePix');
        // `memId`, `fullName`, `gender`, `dob`, `profilePix`, `email`, `pwd`, `date_created`, `date_updated`
        $queryUpdate  =  $con->query("UPDATE `members` SET `fullName`='$fname',`gender`='$gender',`email`='$em',`profilePix`='$profPix',`dob`='$realBob',`date_updated`= NOW() WHERE `email` ='$email'");
        if($queryUpdate){
            echo true;
        }else{
            echo "Error Updating info! ".$con->error;
        }
        $con->close();
    }





    private function uploadProfilePix($pix){
        $uploadDir        = "../user/images/uploads/"; 
        $name             = basename($_FILES[$pix]['name']);
        $temp             = $_FILES[$pix]['tmp_name'];
        $uploadFilePath   = $uploadDir.$name; 
        // Check for file type
        if( in_array( pathinfo($name, PATHINFO_EXTENSION), ['jpg','png','gif'] ) ) { 
            if(move_uploaded_file($temp, $uploadFilePath)){ 
                return $name ;
            }
         }
        
    }


    // Add or update account infomation
private function bankInfo($email){
    // `bnk_id`, `memId`, `accountName`, `bankName`, `accountNumber`, `accountType`, `date_updated`
    $con         = self::con();      
    $uid         = $this->getMemberDetails($email)['memId'];
    $acc_type    = $this->clean_input($_POST['AccountType']);
    $bank_name   = $this->clean_input($_POST['BankName']);
    $acc_no      = $this->clean_input($_POST['AccNumber']);
    $ac_name     = $this->clean_input($_POST['AccName']);
    $checkAccountExist = $con->query("SELECT * FROM `bankInfo` WHERE `memId` ='$uid'");
    if($checkAccountExist->num_rows>0){
        $bankInsert = $con->query("UPDATE `bankInfo` SET `accountName`='$ac_name ', `acc_no`='$acc_no ', `bankName`='$bank_name', `accountType`='$acc_type',`date_updated`=NOW() WHERE `memId`='$uid'");
        if($bankInsert){
            echo true;
        }else{
            echo "Error Occured! ".$con->error;
        }
    }else{
        $bankUpdate =$con->query("INSERT INTO `bankInfo`(`memId`, `accountName`, `accountNumber`, `bankName`, `accountType`,`date_updated`) VALUES('$uid','$ac_name','$acc_no','$bank_name','$acc_type',NOW())"); 
        if($bankUpdate){
            echo true;
        }else{
            echo "Error Occured! ".$con->error;
        }           
    }
}


// Check if this name already exist

private function isNameExist($name){
    $con          = self::con(); 
    $n = strtolower($name);
    if(!empty($name)){
        $sql       = "SELECT * FROM `names` WHERE `name`=?";
        $stmt      = $con->prepare($sql);
        $stmt->bind_param("s",$n);
        $exec      = $stmt->execute();
        if($exec){
            $result   = $stmt->get_result();
            $num_rows = $result->num_rows;
		if($num_rows>0){
			return true;
		}else{
			return false;
		}
		$stmt->close();
	  }
    }
}


// This function allows user to Add names
 public function addName($email){
     // `namesId`,`name`,`otherForms`,`nameUsage`,`gender`,`origin`,`pronounce`,`meaning`,`history`,`personality`,`addedBy`,`status`,`date_created`, `date_updated`
     $con          = self::con(); 
     $addById      = $this->getMemberDetails($email)['memId'];
     $Name         = strtolower($this->clean_input($_POST['Name']));
     $otherForms   = $this->clean_input($_POST['otherForms']);
     $nameUsage    = $this->clean_input($_POST['nameUsage']);
     @$gender       = $this->clean_input($_POST['gender']);
     $origin       = $this->clean_input($_POST['origin']); 
     $pronounce    = $this->clean_input($_POST['pronounce']);  
     $history      = $this->clean_input($_POST['history']); 
     $meaning      = $this->clean_input($_POST['meaning']);
     if(!isset($gender) || empty($gender)){
        echo "Gender is not selected";
        exit();
     }
     if($this->isNameExist($Name)){
        echo "This name already exist ";
        exit();
     }else{
                $sql      = "INSERT INTO `names`(`name`,`otherForms`,`nameUsage`,`gender`,`origin`,`pronounce`,`meaning`,`history`,`addedBy`,`date_created`) VALUES(?,?,?,?,?,?,?,?,?,NOW())";
                $stmt     = $con->prepare($sql);    
                $stmt->bind_param("ssssssssi",$Name,$otherForms,$nameUsage,$gender,$origin,$pronounce,$meaning,$history,$addById);
                if($stmt->execute()){
                    echo true;
                    // $this->setLexiPoint($addById);
                    // $noty  = new Notification($addById, "Lexi points", "Congratulations! You have earned 10 lexipoints for adding new name");
                    // $noty->notifyMe();
            }else{
                echo "Error ! ".$con->error;
            } 
     }

     $con->close();
 }


private function isNameApproved($name){
    $con      = self::con(); 
    $query    = $con->query("SELECT * FROM `names` WHERE `status`='approved'");
    if($query){
        if($query->num_rows>0){
            return true;
        }else{
            return false;
        }
    }
}


 public function editName($email){
    // `namesId`,`name`,`otherForms`,`nameUsage`,`gender`,`origin`,`pronounce`,`meaning`,`history`,`personality`,`addedBy`,`status`,`date_created`, `date_updated`
    $con          = self::con(); 
    $nameId       = $_POST['nId'];
    $addById      = $this->getMemberDetails($email)['memId'];
    $Name         = $this->clean_input($_POST['Name']);
    $otherForms   = $this->clean_input($_POST['otherForms']);
    $nameUsage    = $this->clean_input($_POST['nameUsage']);
    @$gender      = $this->clean_input($_POST['gender']);
    $origin       = $this->clean_input($_POST['origin']); 
    $pronounce    = $this->clean_input($_POST['pronounce']);  
    $history      = $this->clean_input($_POST['history']); 
    $meaning      = $this->clean_input($_POST['meaning']);
    
    if($this->isNameApproved($Name)){
        die("Sorry you cannot edit this name anymore.");
    }
    if(!isset($gender) || empty($gender)){
        echo "Gender is not selected";
        exit();
     }
    $sql          = "UPDATE `names` SET `name`='$Name',`otherForms`='$otherForms',`nameUsage`='$nameUsage',`gender`='$gender',`origin`='$origin',`pronounce`='$pronounce',`meaning`='$meaning',`history`='$history',`date_created`=NOW() WHERE  `namesId` ='$nameId' AND `addedBy`='$addById'";
    $query        = $con->query($sql);   
    if($query){
       echo true;
     }else{
         echo "Error ! ".$con->error;
     }
    $con->close();
}





private function viewNameDetails($email){
    $con          = self::con(); 
    $uid          = $this->getMemberDetails($email)['memId'];
    $nameId       = $this->clean_input($_POST['namesId']);
    $query        = $con->query("SELECT * FROM `names` WHERE `namesId`='$nameId' AND `addedBy` ='$uid'");
    if($query){
       
        if($query->num_rows>0){
            $row  = $query->fetch_assoc();
            $personality = $row['personality'] ?? "Not available yet";
            echo '
                 <div>
                    <h6 class ="h4">Name</h6>
                    <p> '.$row['name'].'  </p>
                </div>  

                <div>
                    <h6 class ="h4"> Pronunciation </h6>
                    <p> '.$row['pronounce'].'  </p>
                </div>

                <div>
                    <h6 class ="h4">Other forms </h6>
                    <p> '.$row['otherForms'].'  </p>
                </div>

                <div>
                    <h6 class ="h4"> Usage </h6>
                    <p> '.$row['nameUsage'].'  </p>
                </div>    

                 <div>
                    <h6 class ="h4"> Gender </h6>
                    <p> '.$row['gender'].'  </p>
                 </div>  

                 <div>
                    <h6 class ="h4">History</h6>
                    <p> '.$row['history'].' </p>
                 </div>

                 <div>
                        <h6 class ="h4"> Origin </h6>
                        <p> '.$row['origin'].'  </p>
                 </div>

                <div>
                    <h6 class ="h4">Meaning</h6>
                    <p> '.$row['meaning'].' </p>
                </div>

                <div>
                <h6 class ="h4">Personality</h6>
                <p> '.$personality .' </p>
            </div>';
                
        }
    }
}



//////////////////  Delete Name /////////////////////
private function deleteName($email){
    $con          = self::con(); 
    $uid          = $this->getMemberDetails($email)['memId'];
    $nameId       = $_POST['namesId'];
    if($this->getNameDetailsById($nameId)['status'] =='pending'){
        $query        = $con->query("DELETE FROM `names` WHERE `namesId`='$nameId' AND `addedBy` ='$uid' AND `status`='pending' LIMIT 1");
        if($query){
            echo true;
        }else{
            echo "Error Deleting ".$con->error;
        }
    }else{
        echo "Sorry You cannot delete name(s) already approved/published";
    }


}
/////////////////////////////////////////////////////////


/////////////////// GET NY NAMES///////////////////////////////
public function getMyNames($email){
//<a href="#" class="deleteName btn btn-sm btn-primary" id ="'.$row['namesId'].'"><i class="fa fa-trash mx-1" data-toggle="tooltip"  title="Delete this name"></i></a>                             
   $memId   = $this->getMemberDetails($email)['memId'];
   $con        = self::con(); 
   $query      = $con->query("SELECT * FROM `names` WHERE `addedBy` ='$memId' AND `published`='0' ORDER BY `date_created` DESC");
   if($query){
        if($query->num_rows>0){
              $i = 0;
                while($row = $query->fetch_assoc()){
                        echo ' <tr>
                                <td>'.(++$i).'</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['pronounce'].'</td>
                                <td>'. htmlentities($row['meaning']).'</td>
                                <td>'.$row['status'].'</td> 
                                <td>'.$this->getLpByName($memId,$row['namesId']).'</td> 
                                <td>
                                <!--<a href="index.php?pg=editName&nId='.$row['namesId'].'" class=" btn btn-sm btn-primary" id ="'.$row['namesId'].'"><i class="fa fa-pencil mx-1" data-toggle="tooltip"  title="Edit this name"></i> Edit </a>-->
                                <a href="#" class="viewName btn btn-sm btn-primary" id ="'.$row['namesId'].'" data-toggle="modal" data-target="#myModal2" ><i class="fa fa-eye mx-1" data-toggle="tooltip" title="View details"></i> View Name</a>          
                                </td>
                            </tr>  ';
                    }
                }else{
                    echo '<tr> <td colspan ="6">No Record Yet!</td>  </tr>';
                }
        }
   }


   public function getMyPublishedNames($email){
    //<a href="#" class="deleteName btn btn-sm btn-primary" id ="'.$row['namesId'].'"><i class="fa fa-trash mx-1" data-toggle="tooltip"  title="Delete this name"></i></a>                             
       $memId   = $this->getMemberDetails($email)['memId'];
       $con        = self::con(); 
       $query      = $con->query("SELECT * FROM `names` WHERE `addedBy` ='$memId' AND `published`='1' ORDER BY `date_created` DESC");
       if($query){
            if($query->num_rows>0){
                  $i = 0;
                    while($row = $query->fetch_assoc()){
                            echo ' <tr>
                                    <td>'.(++$i).'</td>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['pronounce'].'</td>
                                    <td>'. htmlentities($row['meaning']).'</td>
                                    <td>Published</td> 
                                    <td>'.$this->getLpByName($memId,$row['namesId']).'</td> 
                                    <td>
                                    <!--<a href="index.php?pg=editName&nId='.$row['namesId'].'" class=" btn btn-sm btn-primary" id ="'.$row['namesId'].'"><i class="fa fa-pencil mx-1" data-toggle="tooltip"  title="Edit this name"></i> Edit </a>-->
                                    <a href="#" class="viewName btn btn-sm btn-primary" id ="'.$row['namesId'].'" data-toggle="modal" data-target="#myModal2" ><i class="fa fa-eye mx-1" data-toggle="tooltip" title="View details"></i> View Name</a>          
                                    </td>
                                </tr>  ';
                        }
                    }else{
                        echo '<tr> <td colspan ="6">No Record Yet!</td>  </tr>';
                    }
            }
       }
//========================================================================///

public function nameSearch($name){
    $nm  =  $this->clean_input($name);
    $con          = self::con(); 
    $query        = $con->query("SELECT * FROM `names` WHERE `name` LIKE '%$nm%' AND `status`='approved' AND `published`='1'");
    // `name`,`otherForms`,`nameUsage`,`gender`,`origin`,`pronounce`,`meaning`,`history`,`personality`
    if($query){
        $output ='<div class="col-12">
                    <h3>Search Result For<u class="ml-2">"'.$name.'"</u></h3>
                    <p class="text-muted">About <span class ="badge badge-info">'.$query->num_rows.'</span> results (0.52 seconds)</p>
                </div>';
         if($query->num_rows>0){
            while($row = $query->fetch_assoc() ){
                $output.= '<div class="col-12 results">
                            <div class="pt-4 border-bottom">
                                <a class="d-block h4" data-toggle="collapse" href="#details_'.$row['namesId'].'" role="button" aria-expanded="false" aria-controls="details_'.$row['namesId'].'">
                                <u style ="color:#001098;">'.ucfirst($row['name']).'</u></a>                               
                                <p class="page-description mt-1 w-75 text-muted"> <h6 class="h5">Meaning: </h5> '. htmlentities($row['meaning']).'</p>
                            
                                <div class="collapse multi-collapse" id="details_'.$row['namesId'].'">
                                    <div class="page-description text-muted mb-2"> <h6 class="h5">Other Forms   </h5> '.$row['otherForms'].'  </div>
                                    <div class="page-description text-muted mb-2"> <h6 class="h5">Pronunciation </h5> '.$row['pronounce'].'  </div>
                                    <div class="page-description text-muted mb-2"> <h6 class="h5">Origin        </h5> '.$row['origin'].'      </div>
                                    <div class="page-description text-muted mb-2"> <h6 class="h5">Usage         </h5> '.$row['nameUsage'].'   </div>
                                    <div class="page-description text-muted mb-2"> <h6 class="h5">History       </h5> '.$row['history'].'   </div>
                                    <div class="page-description text-muted mb-2"> <h6 class="h5">Personality   </h5> '.$row['personality'].' </div>
                                </div>
                                
                            </div>
                            <a class="page-url" data-toggle="collapse" href="#details_'.$row['namesId'].'"  role="button" aria-expanded="false" aria-controls="details_'.$row['namesId'].'" style="color:#20bbeb;"> 
                                <i class ="fa fa-chevron-down"></i> &nbsp; view more 
                            </a>
                     </div>
                     ';
               }             

            }else{
                $output.='<div class ="col-md-12 alert alert-info"> No Record Found! &nbsp; &nbsp;<a class="btn btn-outline-primary btn-sm mx-1 addNameBtn" style ="margin-left:90px !important;" onClick ="addSearchedName()"> <i class="fa fa-plus"></i> add this name </a></div></div>';
            }
            echo $output;
         }
    }
 




// ============== USER STATISTICS ====================

// Pending
public function getTotalPendingNames($email){
    $uid   = $this->getMemberDetails($email)['memId'];
    $con   = self::con(); 
    $query = $con->query("SELECT * FROM `names` WHERE `addedBy` ='$uid' AND `status`='pending'");
    $total = $query->num_rows;
    return $total;
}


// Approved Names
public function getTotalApprovedNames($email){
    $uid   = $this->getMemberDetails($email)['memId'];
    $con   = self::con(); 
    $query = $con->query("SELECT * FROM `names` WHERE `addedBy` ='$uid' AND `status`='approved'");
    $total = $query->num_rows;
    return $total;
}


// Total Added Name
public function getTotalAddedNames($email){
    $uid   = $this->getMemberDetails($email)['memId'];
    $con   = self::con(); 
    $query = $con->query("SELECT * FROM `names` WHERE `addedBy` ='$uid'");
    $total = $query->num_rows;
    return $total;
}

//==================== LEXI POINTS Exlusive ==============////////////////////////
// Get Total points earned  ( THis Function is Obsolete use the functions below it)
// public function getTotalLexiPoints($email){
//     $uid   = $this->getMemberDetails($email)['memId'];
//     $con   = self::con(); 
//     $query = $con->query("SELECT `lexiPoints` FROM `members` WHERE `memId` ='$uid'");
//     $row   = $query->fetch_assoc();
//     $total = number_format($row['lexiPoints'],0,".",",");
//     return $total;
// }

// Get Total points earned//  `lexp_id`, `memId`, `namesId`, `name`, `gender`, `n_usage`, `origin`, `history`, `meaning`, `pronounce`, `otherForms`, `updatedAt`
public function getTotalLexiPoints($email){
    $con   = self::con(); 
    $memId   = $this->getMemberDetails($email)['memId'];
    $query = $con->query("SELECT  SUM(`name`+`gender`+`n_usage`+`origin`+`history`+`meaning`+`pronounce`+`otherForms`) AS totalLexi FROM `lexipoints` WHERE `memId` ='$memId'");
    $row   = $query->fetch_assoc();
    $total = number_format($row['totalLexi'],0,".",",");
    return $total;
}

public function getLpByName($memId,$nameId){
    $con   = self::con(); 
    $query = $con->query("SELECT  SUM(`name`+`gender`+`n_usage`+`origin`+`history`+`meaning`+`pronounce`+`otherForms`) AS totalLexi FROM `lexipoints` WHERE `memId` ='$memId' AND `namesId` ='$nameId'");
    $row   = $query->fetch_assoc();
    $total = number_format($row['totalLexi'],0,".",",");
    return $total;
}
//==================== LEXI POINTS Exlusive ==============////////////////////////



// Assign Points to user who successfully 
// private function setLexiPoint($uid,$pointValue = 10){
//       $con       = self::con(); 
//       $query     = $con->query("UPDATE `members` SET `lexiPoints`=`lexiPoints`+'$pointValue' WHERE `memId`='$uid'");
// }


// Sanitize User input --> Never trust user data.
 private function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


    private function updatePassword($email){
        $con           = self::con();               
        $old_password  = trim($_POST['passwd']);
        $new_password  = trim($_POST['newPassword']);
        $re_password   = trim($_POST['re-newPassword']);
        $_oldPassword  = $this->getMemberDetails($email)['pwd'];
        if(password_verify($old_password ,$_oldPassword)){
            if($new_password === $re_password){
               $pass_hash    = password_hash($new_password,PASSWORD_DEFAULT);
                $updateQuery = $con->query("UPDATE `members` SET `pwd`='$pass_hash' WHERE `email`='$email'");
                if($updateQuery){
                     echo true;
                }else{
                   echo "Error Changing Password!";
                }
            }else{
                echo "Password Mismatch";
            }
        }else{
            echo "Your Old password is not correct!";
        }

    }

   public function recoverPassword($con){
	     if(isset($_POST)){	
            $email = trim($_POST["email"]);
			if(self::checkUserExist($con,$email,"members","email")){			  
			$new_password  	    = substr(str_shuffle(rand(time(),time()+7)."Aab12345CcDdeFoNdaTi@zZKkL"),1,8);
			$hash_pass 			= password_hash($new_password,PASSWORD_DEFAULT);  // hash the password
			$updateQuery 		= "UPDATE `members` SET `passWD`=? WHERE `email`=?";
			$stmt_update 		= $con->prepare($updateQuery);
			$stmt_update->bind_param("ss",$hash_pass,$email);
			if($stmt_update->execute()){
			$msg 	    		='<h2 style ="background-color:#a41034; color:#fff;font-weight:600;">PASSWORD RECOVERY</h2>
								    <p> A request to reset your password has been initiated </p>
								    <h3>Your New Passowrd is :</h3>
								    <p><h2>'.$new_password.'</h2></p>
								<p>NB: If you did not initiate this action, kindly  contact us @  <a href ="mailt:support@zenithcash.com" >support@zenithcash.com</a></p>';
			$headers 	="";
			if(mail($email,"ZENITHCASH PASWORD RECOVERY","",$msg,$headers)){
					echo "We have sent you a new password to your email. Use it to login.";
			}else{
				echo 'Error Snding Mail Please Try again Ensuring you have a network connection ';
			}
			$stmt_update->close();
			}


			}else{
				echo "User does not Exist!";
			}
			$con->close();
	
	}
}

    // this function checks if a user already exist  based on email and phone number
public function checkUserExist($con,$email,$table,$email_field){
        if(!empty($email)){
        $sql       = "SELECT * FROM `".$table."` WHERE `".$email_field."`=?";
        $stmt      = $con->prepare($sql);
        $stmt->bind_param("s",$email);
        $exec      = $stmt->execute();
        if($exec){
		$result   = $stmt->get_result();
		$num_rows = $result->num_rows;
		if($num_rows>0){
			return true;
		}else{
			return false;
		}
		$stmt->close();
		}
        }
    }



    public function checkLoggedIn(){
        if(!isset($_SESSION["NL_USER_LIVE"] )){
            header("location:../login.html");
        }
    }


// Logout From all sessions set 
 public function logOut(){
    if(isset($_GET['pg']) && $_GET['pg']=="logout"){
         unset($_SESSION["NL_USER_LIVE"]);
         session_destroy();   
         self::checkLoggedIn();  
    }
       
  }

   public function deleteUser(){
          $con        = self::con();
          $uid        = $_POST['user_id'];
          $query      = $con->query("DELETE FROM `members` WHERE `mID`='$uid'");
          if($query){
            echo "Successful!";
          }else{
              echo "Error Deleting User!";
          }
   }


 }
 
 $user = new User();
//  $user->getAdminId();
