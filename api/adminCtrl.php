<?php
require_once("db.php");
require_once("notification.php");
require_once("messaging.php");  //sendMsg

class Admin extends Database{

   public function __construct()
   {
    $con      = self::con();
    @$action  = trim($_POST['action']);
    session_start();
    switch($action){
        case 'login':
           self::login($con);
        break;

        case 'add-admin':
            self::addAdmin($con);
         break;

        case 'show-admin':     
            self::findOneAdmin();
         break;

         case 'update-admin':     
             self::updateAdminUserInfo($_SESSION["NL_ADMIN_USER_LIVE"]);
         break;
         
         case 'delAdmin':     
             self::deleteAdmin($_SESSION["NL_ADMIN_USER_LIVE"]);
         break; 

         case 'addName':
            self::addName($_SESSION["NL_ADMIN_USER_LIVE"]); 
        break;  
        
        case 'editName':
            self::editName($_SESSION["NL_ADMIN_USER_LIVE"]); 
        break; 
        
        case 'approve':  
            self::approveName($_SESSION["NL_ADMIN_USER_LIVE"],$_POST['namesId']);   // for marking name as approved
        break; 

        case 'approveName':
            self::setLexiPoint($_SESSION["NL_ADMIN_USER_LIVE"]);
        break; 
        
        case 'update':
            self::updateMyDetails($_SESSION["NL_ADMIN_USER_LIVE"]); 
        break; 

        case 'update_password':
            self::updatePassword($_SESSION["NL_ADMIN_USER_LIVE"]); 
        break;        
         
        case 'viewUserDetails':
            self::viewUserDetails(); 
        break; 

        case 'viewName':
            self::viewNameDetails();   
        break; 

        case 'publish':
            self::publishName();   
        break; 

        case 'flagName':
            self::flagNameWaiting($_SESSION["NL_ADMIN_USER_LIVE"]);   
        break; 

        case 'completed':
            self::workOnNameCompleted($_SESSION["NL_ADMIN_USER_LIVE"]);   
        break; 

        case 'delName':
            self::deleteName($_SESSION["NL_ADMIN_USER_LIVE"]);        // Delete this name  viewNameDetails
        break; 

        case 'blockUser':
            self::blockUser(); 
        break; 

        case 'unblockUser':
            self::unblockUser(); 
        break; 

        case 'sendMsg':
            $msg = new Message($_POST['senderId'], $_POST['receiverId'], null, $_POST['msgTitle'], $_POST['msg']);
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
            $msg = new Message($_POST['senderId'], $_POST['receiverId'], $_POST['msgId'], "", $_POST['msg']); 
            if($_POST['senderId']=== $_POST['receiverId']){
                die("Sorry you cannot reply your own message");
            }else{
                if($msg->sendMessage()){
                    echo true; 
                }else{
                    echo "Error Sending Message => ".$msg->sendMessage();
                }
            }

        break;

         case 'inbox':
            $msg = new Message(); 
            $msg->myInbox($this->getAdminByEmail($_SESSION["NL_ADMIN_USER_LIVE"])['adminId']);
        break; 

        case 'outbox':
            $msg = new Message(); 
            $msg->myOutbox($this->getAdminByEmail($_SESSION["NL_ADMIN_USER_LIVE"])['adminId']);
        break; 
        
        case 'msgdetails':
            $msg = new Message(); 
            $msg->getMessageDetail($_POST['msgId']);
        break;  
    }

   }
 
// /////////////// Fix the personality Algorithm for names////////////// `algoId`, `algoLetter`, `xteristics`
public function fixNamePersonality($name){
    $strippedName        = preg_replace('/\s+/', '', $name);                   // Remove any white space in between name
    $nameCharacterArray  = str_split(strtoupper(trim($strippedName)),1);      // covert the name to array
    $arrayUnique         = array_unique($nameCharacterArray, SORT_REGULAR);  // Remove Duplicates from the array
    $PersonalityTrait    = ""; 
    foreach( $arrayUnique  as $person){
             $PersonalityTrait .= $this->getNameCharateristics($person).'<br/>';
    }
    return $PersonalityTrait;
}
// /////////////// Fix the personality Algorithm for names//////////////    


private function getNameCharateristics($char){
    $con        = self::con();
    $queryRow   = $con->query("SELECT * FROM `lexicon_algo` WHERE `algoLetter`='$char'")->fetch_assoc();
    return $queryRow['xteristics'];
}



   private function addAdmin($con){
       // `adminId`, `name`, `email`, `paswd`, `adminLevel`, `createdAt`
       $fname           = $this->clean_input($_POST["name"]);   //fullName  inputEmail inputPassword
       $email           = $this->clean_input($_POST["email"]);
       $pass            = $this->clean_input($_POST["password"]);

        if(!self::checkUserExist($con,$email,"admins","email")){	
            $pass_hash = md5($pass);
            $sql       = "INSERT INTO `admins`(`name`,`email`,`paswd`,`createdAt`) VALUES(?,?,?,NOW())";
            $statement = $con->prepare($sql);
            $statement->bind_param("sss",$fname,$email,$pass_hash);
            if($statement->execute()){
                echo true;
            }else{
                echo "Error Registering ".$statement->error;
            }
            $statement->close();
      }else{
          echo 'Admin User Already Exist!';
      }
    $con->close();
   }







   private function login($con){ 
   // `adminId`, `name`, `email`, `paswd`, `adminLevel`, `createdAt`
    $email    = $this->clean_input($_POST["email"]);
    $pass     = $this->clean_input($_POST["pwd"]);
    if(self::checkUserExist($con,$email,"admins","email")){	
        $sql  		= "SELECT * FROM `admins` WHERE `email`=?";
        $stmt 		= $con->prepare($sql);
        $stmt->bind_param("s",$email);  
       if($stmt->execute()){
            $result	   = $stmt->get_result();
            $row       = $result->fetch_assoc();
            if(md5($pass) === $row['paswd']){
                $user 	= $_SESSION["NL_ADMIN_USER_LIVE"] = $row['email'];
                if(isset($user)){
                    echo true;
                }else{
                    echo "Sorry No Session Was set at this time";
                }
            }else{
            echo "Incorrect Password";
        }
            
       }else{
        echo "LOGIN FAILED  ".$stmt->error;
    }
       
    }else{
        echo "The User with this emil does not exist";
    }
   }
   

   // Return User Details as Associative array
   // Get User/member details by ID
   public function getMemberDetailsById($uid){
    $con        = self::con();
    $queryRow   = $con->query("SELECT * FROM `members` WHERE `memId` ='$uid'")->fetch_assoc();
    return  $queryRow;
  }



   // Show all Admins
   public function getAllAdmins(){
       // `adminId`, `name`, `email`, `paswd`, `adminLevel`, `createdAt`
    $con          = self::con(); 
    $query        = $con->query("SELECT * FROM `admins`");
    if($query){
        if($query->num_rows>0){
              $i = 0;
              $output ="";
                while($row = $query->fetch_assoc()){              
                    $output .='<tr>
                                <td> <span class="custom-checkbox"><input type="checkbox" class ="selectadmin" id="'.$row['adminId'].'" name="options[]" value="1">  <label for="checkbox1"></label> </span> </td>
                                <td>'.(++$i).'</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['email'].'</td>';
                    if($row['adminLevel'] == 1){
                        $output .='<td> <span class ="badge badge-success">Super Admin</span> </td>';
                    }else{
                        $output .='<td> <span class ="badge badge-info">Admin</span> </td>';
                    }
                    $output .='<td> '.date("D, M Y H:i A",strtotime($row['createdAt'])).'</td>
                                <td>
                                    <a href="#editEmployeeModal"   class="edit"    id="'.$row['adminId'].'"   data-toggle="modal"><i class="fa fa-pencil" data-toggle="tooltip" title="A"></i></a>
                                    <a href="#deleteEmployeeModal" class="delAdmin"  id="'.$row['adminId'].'" data-toggle="modal"><i class="fa fa-trash"  data-toggle="tooltip" title="Delete this name"></i></a>                              
                                </td> 
                              </tr>';

                }
             echo $output;
            }
        }

   }
  


// Show all users registered
public function getAllUsers(){
    $con      = self::con(); 
    $query    = $con->query("SELECT * FROM `members`");
    // `memId`, `fullName`, `gender`, `dob`, `profilePix`, `email`, `pwd`, `lexiPoints`, `date_created`, `date_updated`
    if($query){
        if($query->num_rows>0){
              $i = 0;
              $output ="";
              while($row = $query->fetch_assoc()){  
                $output.='<tr>
                            <td>'.(++$i).'</td>
                            <td>'.$row['fullName'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>'.$row['gender'].'</td>
                            <td>'.$row['dob'].'</td>
                            <td>'.$row['date_created'].'</td>
                            <td>'.$this->getSumOfLexiPoints($row['memId']).'</td>
                            <td>';
                  if($row['user_status'] == 1){
                    $output.='<a href="#deleteEmployeeModal" class="blockUser btn btn-danger btn-sm  mx-2"      id ="'.$row['memId'].'" data-toggle="modal"><i class="fa fa-lock" data-toggle="tooltip" title="Block this user"></i> Block User </a>';
                  }else{
                    $output.='<a href="#deleteEmployeeModal" class="unblockUser btn btn-success btn-sm  mx-2"   id ="'.$row['memId'].'" data-toggle="modal"><i class="fa fa-unlock" data-toggle="tooltip" title="Unblock this user"></i> &nbsp; Unblock  &nbsp;</a>';
                  }
                    $output.='<a href="#modal_aside_right" class="viewUserDetails btn btn-primary btn-sm  mx-2" id ="'.$row['memId'].'" data-toggle="modal"><i class="fa fa-eye" data-toggle="tooltip" title="View More"></i> View More </a>  
                             <a href="#modal_aside_right"  class="sendMsg btn btn-primary btn-sm  mx-2"  id ="'.$row['memId'].'" data-toggle="modal"><i class="fa fa-send" data-toggle="tooltip" title="Send message to this user"></i>Send</a>                          
                        </td>
                    </tr>';

              }
              echo $output;
        }
    }
}

// Allow admin to view more details of the user
public function viewUserDetails(){
    // `bnk_id`, `memId`, `accountName`, `bankName`, `accountNumber`, `accountType`, `date_updated`
    $con      = self::con(); 
    $user_id  = $_POST['uid'];
    $query    = $con->query("SELECT * FROM `bankinfo` WHERE `memId` ='$user_id'");
    if($query){ 
        if($query->num_rows>0){
            $userPix   = $this->getMemberDetailsById($user_id)['profilePix'];
            $output   ='<p class ="text-center"> <img src ="../user/images/uploads/'.$userPix.'" style ="width:150px; height:150px;"/></p>';  
            $row     = $query->fetch_assoc();
            $output.='<table class="table table-bordered" style ="width:100%">
                        <tbody>
                             <tr> <th> Account Name   </th> <td>'.$row['accountName'].'</td> </tr>
                             <tr> <th> Account Number </th> <td>'.$row['accountNumber'].'</td> </tr>
                             <tr> <th> Account Name </th>   <td>'.$row['bankName'].'</td> </tr>
                             <tr> <th> Account Type </th>   <td>'.$row['accountType'].'</td> </tr>
                        </tbody>
                    </table>';
         echo $output;
      }else{
          echo "No Record found!";
      }
    }
}


// Block This User
private function blockUser(){
    $con      = self::con(); 
    $user_id  = $_POST['uid'];
    $query    = $con->query("UPDATE `members`  SET `user_status` = '0' WHERE `memId` ='$user_id'");
    if($query){
        echo true;
    }else{
        echo "Error ".$con->error;
    }
}

// Block This User
private function unblockUser(){
    $con      = self::con(); 
    $user_id  = $_POST['uid'];
    $query    = $con->query("UPDATE `members`  SET `user_status` = 1 WHERE `memId` ='$user_id'");
    if($query){
        echo true;
    }else{
        echo "Error ".$con->error;
    }
}




// Find and Show One Admin
   private function findOneAdmin(){
       $con      = self::con(); 
       $uid      = $_POST['adminId'];
      $query     = $con->query("SELECT * FROM `admins` WHERE `adminId` ='$uid'");
        if($query){
            $row = $query->fetch_assoc();
            echo '<div class="form-group">
                    <label>Name</label>
                        <input type="text" class="form-control" value ="'.$row['name'].'" name ="name" id ="name" placeholder ="Admin Full Name" required />
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" value ="'.$row['email'].'" name ="email" id ="email" placeholder ="Email"  required /> 
                    </div>
                    <p> Change Password as well: <input type="checkbox" class="switch" name="myswitch" id="myswitch" /></p>
                    <div class="form-group paswordSection" style ="display:none;"> 
                        <label>Password</label>
                        <input type="password" class="form-control" name ="password" id ="password" placeholder ="password" />
                    </div>

                     <div class="form-group result"></div>

                    <input type ="hidden" name ="adminId" value ="'.$uid.'" />	
                    <input type ="hidden" name ="action"  value ="update-admin" /> ';
        }else{
            echo "Error Fecthing Admin details";
        }
       
   }

   // Return User Details as Associative array
   public function getAdminByEmail($email){
        $con        = self::con();
        $queryRow   = $con->query("SELECT * FROM `admins` WHERE `email` ='$email'")->fetch_assoc();
        return  $queryRow;
   }

   // Get User/member details by ID
   public function getAdminById($uid){
    $con        = self::con();
    $queryRow   = $con->query("SELECT * FROM `admins` WHERE `adminId` ='$uid'")->fetch_assoc();
    return  $queryRow;
}

   // Get User/member details by ID
   public function getNameDetailsById($nId){
    $con        = self::con();
    $queryRow   = $con->query("SELECT * FROM `names` WHERE `namesId` ='$nId'")->fetch_assoc();
    return      $queryRow;
  }

  
private function deleteAdmin($email){
    // `adminId`, `name`, `email`, `paswd`, `adminLevel`, `createdAt`
    $con          = self::con(); 
    $uid          = $this->getAdminByEmail($email)['adminLevel'];
    if($uid==1){
        $adminId  = $_POST['adminId'];
        $query    = $con->query("DELETE FROM `admins` WHERE `adminId`='$adminId' LIMIT 1");
        if($query){
            echo true;
        }else{
            echo "Error Deleting ".$con->error;
        }
    }else{
        echo "You have not the permission to perform this action";
    }
    
}


// Updating Admin User By Supper Admin
private function updateAdminUserInfo($email){
    // `adminId`, `name`, `email`, `paswd`, `adminLevel`, `createdAt`
    $con          = self::con(); 
    $uid          = $this->getAdminByEmail($email)['adminLevel'];
    if($uid==1){
        $adminId     = $_POST['adminId'];
        $name        = trim($_POST['name']);
        $email       = trim($_POST['email']);
        $sql ="" ;
        if(isset($_POST['myswitch'])){;
            $password    = trim($_POST['password']);
            $pwd         = md5($password);
            $sql.="UPDATE `admins` SET `name`='$name', `email`='$email',`paswd`='$pwd' WHERE `adminId` ='$adminId'";
        }else{
            $sql.="UPDATE `admins` SET `name`='$name', `email`='$email' WHERE `adminId` ='$adminId'";
        }       
        $query    = $con->query($sql);
        if($query){
            echo true;
        }else{
            echo "Error Deleting ".$con->error;
        }
    }else{
        echo "You have not the permission to perform this action";
    }
    
}


//  fullName  email  dob profilePix
  private function updateMyDetails($email){ 
        $con          = self::con();
         $fname       = $this->clean_input($_POST['fullName']);
         $em          = $this->clean_input($_POST['email']); 
        $queryUpdate  =  $con->query("UPDATE `admins` SET `name`='$fname',`email`='$em' WHERE `email` ='$email'");
        if($queryUpdate){
            echo true;
        }else{
            echo "Error Updating info! ".$con->error;
        }
        $con->close();
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
     $addById      = $this->getAdminByEmail($email)['adminId'];
     $Name         = strtolower($this->clean_input($_POST['Name']));
     $otherForms   = $this->clean_input($_POST['otherForms']);
     $nameUsage    = $this->clean_input($_POST['nameUsage']);
     @$gender       = $this->clean_input($_POST['gender']);
     $origin       = $this->clean_input($_POST['origin']); 
     $pronounce    = $this->clean_input($_POST['pronounce']);  
     $history      = $this->clean_input($_POST['history']); 
     $meaning      = $this->clean_input($_POST['meaning']);
     $personality  = $this->fixNamePersonality($Name);
     if(!isset($gender) || empty($gender)){
        echo "Gender is not selected";
        exit();
     }
     if($this->isNameExist($Name)){
        echo "This name already exist ";
        exit();
     }else{
                $sql      = "INSERT INTO `names`(`name`,`otherForms`,`nameUsage`,`gender`,`origin`,`pronounce`,`meaning`,`history`,`personality`,`addedBy`,`status`,`approvedBy`,`date_created`) VALUES(?,?,?,?,?,?,?,?,?,?,'approved','$addById',NOW())";
                $stmt     = $con->prepare($sql);    
                $stmt->bind_param("sssssssssi",$Name,$otherForms,$nameUsage,$gender,$origin,$pronounce,$meaning,$history,$personality,$addById);
                if($stmt->execute()){
                    echo true;
                    // $this->setLexiPoint($addById);
                    // $noty  = new Notification($addById, "Lexi points ~ CR-10", "Congratulations! You have earned 10 lexipoints for adding new name");
                    // $noty->notifyMe();
            }else{
                echo "Error ! ".$con->error;
            } 
     }

     $con->close();
 }



////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Approvig name here means assigning the personality trait to the name with the NL ALGORITTHM FUNCTIOn above
 private function approveName($email,$nameId){
    $con          = self::con(); 
    // $nameId       = $_POST['nId'];
    $approvedById = $this->getAdminByEmail($email)['adminId'];        //Id of the Admin who Approved this name
    $addedById    = $this->getNameDetailsById($nameId)['addedBy'];   // Get the ID of the user who added the name
    $name         = $this->getNameDetailsById($nameId)['name'];     //  Get the name by the ID
    $personality  = $this->fixNamePersonality($name);              //   fix the pesronality trait to this name
    $stmt         = $con->prepare("UPDATE `names` SET `personality`=?,`approvedBy`=?, `status`='approved',`date_updated`= NOW() WHERE `namesId` =? AND `name` =? LIMIT 1");
    $stmt->bind_param("siis",$personality,$approvedById,$nameId,$name);
    $stmt->execute();
    echo true;
    $con->close();

 }
////////////////////////////////////////////////////////////////////////////////////////////////////////////



// Used for Testing
// public function seedAdmin(){
//     $con          = self::con(); 
//     $con->query("UPDATE `names` SET `addedBy`=2, `approvedBy`=2  WHERE `addedBy`=0  AND `status`='approved'");
//     if($con->affected_rows >0){
//         echo 'Successful';
//     }
// }



//////////////////////////////////// PUBLISH NAME -- only super-Admin can do this //////////////////////////////////////
private function publishName(){
    $con    = self::con(); 
    $nameId = $_POST['nId'];
    $query  = $con->query("UPDATE `names` SET `published`='1',`publishedAt`= NOW() WHERE `namesId` ='$nameId' AND `status`='approved' LIMIT 1");
    if($query){
        echo true;
    }else{
        echo "Error ! ".$con->error;
      }
     $con->close();
}

/////////////////////////////////////////// PUblish Name </end> ///////////////////////////////////////////////

//////////////////////////////////// Flag name as waiting //////////////////////////////////////
private function flagNameWaiting($email){
    $con        = self::con(); 
    $nameId     = $_POST['nId'];
    $memId      = $_POST['memId'];
    $adminId    = $this->getAdminByEmail($email)['adminId'];
    $query      = $con->query("UPDATE `names` SET `status`='waiting' WHERE `namesId` ='$nameId' AND `addedBy`='$memId' LIMIT 1");
    $sql        ="";
    if($this->isNamePresent($memId,$nameId)){
        $sql .= "UPDATE `lexipoints` SET `adminId`='$adminId' WHERE `memId`='$memId' AND `namesId`='$nameId'";
    }else{
        $sql .= "INSERT INTO `lexipoints`(`memId`,`namesId`,`adminId`) VALUES('$memId','$nameId','$adminId')";
    }
    $query2 = $con->query($sql);
    if($query && $query2){
        echo true;
    }else{
        echo "Error ! ".$con->error;
      }
     $con->close();
}


private function isNamePresent($memId,$nameId){
    $con        = self::con(); 
    $query      = $con->query("SELECT * FROM `lexipoints` WHERE `namesId` ='$nameId' AND `memId`='$memId'");
    if($query->num_rows>0){
        return true;
    }else{
        return false;
    }
}
/////////////////////////////////////////// Name waiting </end> ///////////////////////////////////////////////


//////////////////////////////  COMPLETED WORKING ON A NAME  /////////////////////////////////////
// this function markes names completed if an admin has completed workig on a name
private function workOnNameCompleted($email){
    $con = self::con(); 
    $nameId     = $_POST['nId'];
    $memId      = $_POST['memId'];
    if($this->isNamePresent($memId,$nameId)){
        $adminId    = $this->getAdminByEmail($email)['adminId'];
        $sql        = "UPDATE `lexipoints` SET `work_status`='completed',`updated`= NOW() WHERE `memId`='$memId' AND `namesId`='$nameId' AND `adminId`='$adminId'";
        $query = $con->query($sql);
        if($query){
            echo true;
        }else{
            echo "Error ! ".$con->error;
          }
         $con->close();
    }else{
        echo "You have NOT worked/started working or on this name.";
    }

}
//////////////////////////////////  COMPLETED WORKING ON NAME <END/>

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 public function editName($email){
    // `namesId`,`name`,`otherForms`,`nameUsage`,`gender`,`origin`,`pronounce`,`meaning`,`history`,`personality`,`addedBy`,`status`,`date_created`, `date_updated`
    $con          = self::con(); 
    $nameId       = $_POST['nId'];
    // $addById      = $this->getAdminByEmail($email)['adminId'];
    // $nameStatus   = $this->getNameDetailsById($nameId)['status'];
    // if($nameStatus !== 'pending'){
    //     echo "Sorry you cannot Edit this name anymore! => " .$nameStatus;
    //     exit();
    // }
    $Name         = $this->clean_input($_POST['Name']);
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
    $sql          = "UPDATE `names` SET `name`='$Name',`otherForms`='$otherForms',`nameUsage`='$nameUsage',`gender`='$gender',`origin`='$origin',`pronounce`='$pronounce',`meaning`='$meaning',`history`='$history',`date_created`=NOW() WHERE  `namesId` ='$nameId' LIMIT 1";
    $query        = $con->query($sql);   
    if($query){
       echo true;
     }else{
         echo "Error ! ".$con->error;
     }
    $con->close();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////// DELETE NAME ADDED BY THIS ADMIN  //////////////////
private function deleteName($email){
    $con          = self::con(); 
    $uid          = $this->getAdminByEmail($email)['adminId'];
    $nameId       = $_POST['namesId'];
    $nameStatus   = $this->getNameDetailsById($nameId)['status'];
    if($nameStatus == 'pending'){
        $query = $con->query("DELETE FROM `names` WHERE `namesId`='$nameId' AND `addedBy` ='$uid' AND `status` ='pending' LIMIT 1");
        if($query){
            echo true;
        }else{
            echo "Error Deleting ".$con->error;
        }      
    }else{
        echo "Sorry you cannot perform this action on this name anymore";
        exit();   
    }

}
//////////////// DELETE NAME ADDED BY THIS ADMIN  </end> //////////////////

// Use this to Check the points against names part
public function isPointGiven($nameId){
    $con   = self::con();  
    $query = $con->query("SELECT * FROM `lexipoints` WHERE `namesId`='$nameId'");
    $row   =  $query->fetch_assoc();
    return $row;
}


private function viewNameDetails(){
    $con    = self::con(); 
    //$uid  = $this->getMemberDetails($email)['memId'];
    $nameId = $this->clean_input($_POST['namesId']);
    $query  = $con->query("SELECT * FROM `names` WHERE `namesId` ='$nameId'");
    $output = "";
    if($query){      
        if($query->num_rows>0){
            $row  = $query->fetch_assoc();
            $output.='<div class ="border p-2">
                        <button class ="btn btn-primary btn-sm flagNameWaiting" id ="'.$row['namesId'].'" data-id ="'.$row['addedBy'].'"><span>Flag as waiting &nbsp; </span></button>
                        <i class ="fa fa-info-circle" data-toggle="popover" data-trigger="hover" title="Add this name to waiting list so you can finish correction before approving it" 
                            data-placement="top"
                            data-content="Add this name to waiting list so you can finish correction before approving it"></i> 
                        <span> Total Lexi Points so far : <i class ="lexiPointOutput"></i> </span>
                        <button class ="float-right btn btn-primary btn-sm approveAll" id ="'.$row['namesId'].'" data-id ="'.$row['addedBy'].'" name ="all"><span>Award all points</span></button>              
                    </div>
                <p class ="result_name"></p>';

             if(@$this->isPointGiven($row['namesId'])['name']==0){
                 $output.='<div>
                        <h6 class ="h5 border-bottom" >Name [1 LP] <span class="float-right"> 
                         <i class="fa fa-check btn-sm approveLexipoint" style="background-color:#ccc;" data-lxpoint="1" id ="'.$row['namesId'].'" data-id ="'.$row['addedBy'].'" name ="name" style="width:30px; cursor:pointer;"></i> 
                            </span>
                        </h6>
                        <p> '.$row['name'].' </p>
                    </div>';

             }       
             if(@$this->isPointGiven($row['namesId'])['otherForms']==0){                    
                $output.='<div>
                    <h6 class ="h5 border-bottom" >Other forms [1 LP] <span class="float-right"> 
                    <i class="fa fa-check btn-sm approveLexipoint" style="background-color:#ccc;" data-lxpoint="1" id ="'.$row['namesId'].'" data-id ="'.$row['addedBy'].'" name ="otherForms" style="width:30px; cursor:pointer;"></i> 
                    </span>
                    </h6>
                    <p> '.$row['otherForms'].' </p>
                 </div>';
             }

             if(@$this->isPointGiven($row['namesId'])['n_usage']==0){
                $output.='<div>
                    <h6 class ="h5 border-bottom" > Usage  [0.5 LP] <span class="float-right"> 
                    <i class="fa fa-check btn-sm approveLexipoint" style="background-color:#ccc;" data-lxpoint="0.5" id ="'.$row['namesId'].'" data-id ="'.$row['addedBy'].'" name ="usage" style="width:30px; cursor:pointer;"></i>
                    </span>
                    </h6>
                    <p> '.$row['nameUsage'].' </p>
                </div>';
             }
              
             if(@$this->isPointGiven($row['namesId'])['gender']==0){
                $output.='<div>
                        <h6 class ="h5 border-bottom" > Gender [0.5 LP] <span class="float-right"> 
                        <i class="fa fa-check btn-sm approveLexipoint" style="background-color:#ccc;" data-lxpoint="0.5" id ="'.$row['namesId'].'" data-id ="'.$row['addedBy'].'" name ="gender" style="width:30px; cursor:pointer;"></i> 
                        </span>
                        </h6>
                        <p> '.$row['gender'].'  </p>
                 </div>';
             }
                
             if(@$this->isPointGiven($row['namesId'])['origin']==0){
                $output.='<div>
                        <h6 class ="h5 border-bottom" > Origin [1 LP] <span class="float-right"> 
                        <i class="fa fa-check btn-sm approveLexipoint" style="background-color:#ccc;" data-lxpoint="1" id ="'.$row['namesId'].'" data-id ="'.$row['addedBy'].'" name ="origin" style="width:30px; cursor:pointer;"></i> 
                        </span>
                        </h6>
                        <p> '.$row['origin'].'  </p>
                 </div>';
             }   
              
             if(@$this->isPointGiven($row['namesId'])['pronounce']==0){
                $output.='<div>
                    <h6 class ="h5 border-bottom" > Pronunciation [1 LP] <span class="float-right"> 
                        <i class="fa fa-check btn-sm approveLexipoint" style="background-color:#ccc;" data-lxpoint="1" id ="'.$row['namesId'].'" data-id ="'.$row['addedBy'].'" name ="pronounce" style="width:30px; cursor:pointer;"></i> 
                        </span>
                    </h6>
                    <p> '.$row['pronounce'].'  </p>
                </div>';
             }

             if(@$this->isPointGiven($row['namesId'])['meaning']==0){
                $output.='<div>
                    <h6 class ="h5 border-bottom" >Meaning [1 LP] <span class="float-right"> 
                    <i class="fa fa-check btn-sm approveLexipoint" style="background-color:#ccc;" data-lxpoint="1" id ="'.$row['namesId'].'" data-id ="'.$row['addedBy'].'" name ="meaning" style="width:30px; cursor:pointer;"></i> 
                    </span>
                    </h6>
                    <p> '.$row['meaning'].' </p>
                </div>';
             }
              
            if(@$this->isPointGiven($row['namesId'])['history']==0){
                $output.='<div>
                    <h6 class ="h5 border-bottom" >History [1 LP] 
                    <span class="float-right"> 
                        <i class="fa fa-check btn-sm approveLexipoint" style="background-color:#ccc;" data-lxpoint="1" id ="'.$row['namesId'].'" data-id ="'.$row['addedBy'].'" name ="history" style="width:30px; cursor:pointer;"></i> 
                    </span>
                    </h6>
                    <p> '.$row['history'].' </p>
                </div>';
            }    
                
            $output.='<div>
                    <h6 class ="h5" >Personality Trait </h6>
                    <p> '.$row['personality'].' </p>

                    <div class ="border p-2">
                        If you have finished working on this name please click <b>*Completed*</b>
                        <button class ="float-right btn btn-primary btn-sm nameCompleted" id ="'.$row['namesId'].'" data-id ="'.$row['addedBy'].'""><span>Completed</span></button>              
                  </div>
               </div>';  
        }
    }
    echo $output;
}


//  name  gender usage  origin   otherForms
private function setLexiPoint($email){
    // `lexp_id`, `memId`, `namesId`, `name`, `gender`, `n_usage`, `origin`, `history`, `meaning`, `pronounce`, `otherForms`, `updatedAt`
    $con          = self::con(); 
    $namesPart    = $_POST['npart'];   // part of the name information 
    $memId        = $_POST['memId'];   // ID of the user who added the the name
    $namesId      = $_POST['namesId']; // ID of this Name form names table
    $query        = $con->query("SELECT * FROM `lexipoints` WHERE `namesId`='$namesId' AND `memId` ='$memId'");   
    $sql=""; 
    if($query){
        if($query->num_rows>0){  // check if name record already exist on the table of Lexi points
            switch($namesPart){
               case 'name':        
                $sql.="UPDATE `lexipoints` SET `name`=1 ,`updatedAt`=NOW() WHERE `namesId`='$namesId' AND `memId` ='$memId' LIMIT 1"; 
                    $noty  = new Notification($memId, "Lexi points ~ CR-1", "Congratulations! You have earned 1 lexipoint for adding new name");
                    $noty->notifyMe();  
               break;

               case 'gender':     
                 $sql.="UPDATE `lexipoints` SET `gender`= 0.5, `updatedAt`=NOW()  WHERE `namesId`='$namesId' AND `memId` ='$memId' LIMIT 1"; 
                    $noty  = new Notification($memId, "Lexi points ~ CR-0.5", "Congratulations! You have earned 0.5 lexipoint for adding new name. Gender Confirmed");
                    $noty->notifyMe();
               break;

               case 'usage':      
                 $sql.="UPDATE `lexipoints` SET `n_usage`= 0.5, `updatedAt`=NOW() WHERE `namesId`='$namesId' AND `memId` ='$memId' LIMIT 1"; 
                        $noty  = new Notification($memId, "Lexi points ~ CR-0.5", "Congratulations! You have earned 0.5 lexipoint for adding new name. Name Usage Confirmed!");
                        $noty->notifyMe();
               break;

               case 'origin':      
                $sql.="UPDATE `lexipoints` SET `origin`=1 , `updatedAt`=NOW()    WHERE `namesId`='$namesId' AND `memId` ='$memId' LIMIT 1"; 
                        $noty  = new Notification($memId, "Lexi points ~ CR-1", "Congratulations! You have earned 1 lexipoint for adding new name. Gender Confirmed!");
                        $noty->notifyMe();
               break;

               case 'history':  
                $sql.="UPDATE `lexipoints` SET `history`=1, `updatedAt`=NOW()    WHERE `namesId`='$namesId' AND `memId` ='$memId' LIMIT 1"; 
                        $noty  = new Notification($memId, "Lexi points ~ CR-1", "Congratulations! You have earned 1 lexipoint for adding new name. History Confirmed!");
                        $noty->notifyMe();
                   
               break;

               case 'meaning':  
                  $sql.="UPDATE `lexipoints` SET `meaning`=1 , `updatedAt`=NOW()   WHERE `namesId`='$namesId' AND `memId` ='$memId' LIMIT 1"; 
                        $noty  = new Notification($memId, "Lexi points ~ CR-1", "Congratulations! You have earned 1 lexipoint for adding new name. Meaning Confirmed!");
                        $noty->notifyMe();
            
               break;

               case 'pronounce': 
                  $sql.="UPDATE `lexipoints` SET `pronounce`=1, `updatedAt`=NOW()  WHERE `namesId`='$namesId' AND `memId` ='$memId' LIMIT 1"; 
                        $noty  = new Notification($memId, "Lexi points ~ CR-1", "Congratulations! You have earned 1 lexipoint for adding new name. Name pronounciation Confirmed!");
                        $noty->notifyMe();             
               break;

               case 'otherForms':  
                  $sql.="UPDATE `lexipoints` SET `otherForms`=1, `updatedAt`=NOW() WHERE `namesId`='$namesId' AND `memId` ='$memId' LIMIT 1";
                        $noty  = new Notification($memId, "Lexi points ~ CR-1", "Congratulations! You have earned 1 lexipoint for adding new name. Other forms of the name Confirmed!");
                        $noty->notifyMe();
            
               break;

               case 'all':  $sql.="UPDATE `lexipoints` SET 
                                            `name`=1,
                                            `gender`=0.5,
                                            `n_usage`=0.5,
                                            `origin`=1,
                                            `history`=1,
                                            `meaning`=1,
                                            `pronounce`=1,
                                            `otherForms`=1, 
                                            `updatedAt`=NOW() WHERE `namesId`='$namesId' AND `memId`='$memId' LIMIT 1"; 
                    $this->approveName($email,$namesId);                         
                    //$sql.="INSERT INTO `lexipoints`(`memId`,`namesId`,`name`,`gender`,`n_usage`,`origin`,`history`,`meaning`,`pronounce`,`otherForms`,`updatedAt`) VALUES('$memId','$namesId',1,0.5,0.5,1,1,1,1,1,NOW())";
                break;
            }
          
        } else{
            
            switch($namesPart){
                case 'name':      
                 $sql.="INSERT INTO `lexipoints`(`memId`,`namesId`,`name`,`updatedAt`) VALUES('$memId','$namesId',1,NOW())"; 
                     $noty  = new Notification($memId, "Lexi points ~ CR-1", "Congratulations! You have earned 1 lexipoint for adding new name");
                     $noty->notifyMe();  
                break;
 
                case 'gender':    
                  $sql.="INSERT INTO `lexipoints`(`memId`,`namesId`,`gender`,`updatedAt`) VALUES('$memId','$namesId',0.5,NOW())";
                     $noty  = new Notification($memId, "Lexi points ~ CR-0.5", "Congratulations! You have earned 0.5 lexipoint for adding new name. Gender Confirmed");
                     $noty->notifyMe();
                break;
 
                case 'usage': 
                  $sql.="INSERT INTO `lexipoints`(`memId`,`namesId`,`n_usage`,`updatedAt`) VALUES('$memId','$namesId',0.5,NOW())";
                         $noty  = new Notification($memId, "Lexi points ~ CR-0.5", "Congratulations! You have earned 0.5 lexipoint for adding new name. Name Usage Confirmed!");
                         $noty->notifyMe();
                break;
 
                case 'origin':   
                 $sql.="INSERT INTO `lexipoints`(`memId`,`namesId`,`origin`,`updatedAt`) VALUES('$memId','$namesId',1,NOW())";
                         $noty  = new Notification($memId, "Lexi points ~ CR-1", "Congratulations! You have earned 1 lexipoint for adding new name. Gender Confirmed!");
                         $noty->notifyMe();
                break;
 
                case 'history':   
                 $sql.="INSERT INTO `lexipoints`(`memId`,`namesId`,`history`,`updatedAt`) VALUES('$memId','$namesId',1,NOW())";
                         $noty  = new Notification($memId, "Lexi points ~ CR-1", "Congratulations! You have earned 1 lexipoint for adding new name. History Confirmed!");
                         $noty->notifyMe();                    
                break;
 
                case 'meaning': 
                   $sql.="INSERT INTO `lexipoints`(`memId`,`namesId`,`meaning`,`updatedAt`) VALUES('$memId','$namesId',1,NOW())";
                         $noty  = new Notification($memId, "Lexi points ~ CR-1", "Congratulations! You have earned 1 lexipoint for adding new name. Meaning Confirmed!");
                         $noty->notifyMe();
             
                break;
 
                case 'pronounce':  
                   $sql.="INSERT INTO `lexipoints`(`memId`,`namesId`,`pronounce`,`updatedAt`) VALUES('$memId','$namesId',1,NOW())"; 
                         $noty  = new Notification($memId, "Lexi points ~ CR-1", "Congratulations! You have earned 1 lexipoint for adding new name. Name pronounciation Confirmed!");
                         $noty->notifyMe();
                break;
 
                case 'otherForms':  
                    $sql.="INSERT INTO `lexipoints`(`memId`,`namesId`,`otherForms`,`updatedAt`) VALUES('$memId','$namesId',1,NOW())";
                         $noty  = new Notification($memId, "Lexi points ~ CR-1", "Congratulations! You have earned 1 lexipoint for adding new name. Other forms of the name Confirmed!");
                         $noty->notifyMe();
             
                break;
 
                case 'all':  
                    // $sql.="UPDATE `lexipoints` SET  `name`=1, `gender`=0.5,`n_usage`=0.5,`origin`=1,`history`=1,`meaning`=1,`pronounce`=1,`otherForms`=1,`updatedAt`=NOW() WHERE `namesId`='$namesId' AND `memId`='$memId' LIMIT 1"; 
                       $sql.="INSERT INTO `lexipoints`(`memId`,`namesId`,`name`,`gender`,`n_usage`,`origin`,`history`,`meaning`,`pronounce`,`otherForms`,`updatedAt`) VALUES('$memId','$namesId',1,0.5,0.5,1,1,1,1,1,NOW())";
                       $noty  = new Notification($memId, "Lexi points ~ CR-7", "Congratulations! You have earned 7 lexipoints for adding new name.!");
                       $noty->notifyMe();
                       $this->approveName($email,$namesId); 
               break;
             }
           
        }
        $executeCommand = $con->query($sql);
        if($executeCommand){
            echo true;
        }else{
            echo "Error approving this lexipoint ".$con->error;
        }
    }
}


//     This function returns the name of the user sending the message using the ID of the Sender
private function getSenderName($sender_id){
    return @$this->getMemberDetailsById($sender_id)["fullName"] ?? @$this->getAdminById($sender_id)['name'].' ( Admin )';
}


// This function gets the name of the admin woking on name
private function getAdminNameWokingOnName($namesId){
    $con          = self::con(); 
    $query        = $con->query("SELECT * FROM `lexipoints` WHERE `namesId`='$namesId'");
    if($query->num_rows>0){
        $row = $query->fetch_assoc();
        return $this->getAdminById($row['adminId'])['name'];
    }else{
        return "...";
    }
    $con->close();
}




/////////////////// GET ALL APPROVED NAMES -> For ADMINS///////////////////////////////
public function getAllNames(){
   $con          = self::con(); 
   $query        = $con->query("SELECT * FROM `names` WHERE `status`='approved'");
   if($query){
        if($query->num_rows>0){
              $i = 0;
                while($row = $query->fetch_assoc()){
                        echo ' <tr>
                                <td>'.(++$i).'</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['nameUsage'].'</td>
                                <td>'.$row['origin'].'</td>
                                <td>'.$row['otherForms'].'</td>
                                <td>'.$row['gender'].'</td>
                                <td>'.$row['status'].'</td> 
                                <td>'.$this->getLpByName($row['addedBy'],$row['namesId']).'</td> 
                                <td>
                                <!--<a href="#" class="deleteName btn btn-sm btn-primary" id ="'.$row['namesId'].'"><i class="fa fa-trash mx-1" data-toggle="tooltip"  title="Delete this name"></i> &nbsp;Delete</a>-->
                                <!--<a href="index.php?pg=editName&nId='.$row['namesId'].'" class="btn btn-sm btn-primary" id ="'.$row['namesId'].'"><i class="fa fa-pencil mx-1" data-toggle="tooltip"  title="Edit this name"></i> &nbsp; Edit</a>-->
                                <a href="#" class="viewName btn btn-sm btn-primary" id ="'.$row['namesId'].'" data-toggle="modal" data-target="#myModal2" ><i class="fa fa-eye mx-1" data-toggle="tooltip" title="View details"></i> &nbsp; View</a>          
                                <a href="#modal_aside_right_1" class="sendMsg btn btn-primary btn-sm  mx-2" data-ab = "'.$this->getSenderName($row['addedBy']).'" id ="'.$row['addedBy'].'" data-toggle="modal"><i class="fa fa-send mr-1" data-toggle="tooltip" title="Send message to this user"></i> &nbsp;Message user</a>
                                </td>
                            </tr>  ';
                    }
                }else{
                    echo '<tr> <td colspan ="6">No Record Yet!</td>  </tr>';
                }
        }
   }
////////////////////=====================///////////////////////////////////////



/////////////////// GET ALL APPROVED NAMES FOR Super-Admin ---- EDITOR------ ///////////////////////////////
public function getAllApprovedNames(){
    $con          = self::con(); 
    $query        = $con->query("SELECT * FROM `names` WHERE `status`='approved' AND `published`='0'");
    if($query){
         if($query->num_rows>0){
               $i = 0;
               $output ="";
                 while($row = $query->fetch_assoc()){
                    $output.=' <tr>
                                 <td>'.(++$i).'</td>
                                 <td>'.$row['name'].'</td>
                                 <td>'.$row['nameUsage'].'</td>
                                 <td>'.$row['origin'].'</td>
                                 <td>'.$row['status'].'</td>';
                    if ($row['published'] == 1){
                        $output.= '<td> Yes </td>';
                    }else{
                        $output.= '<td> No </td>';
                    } 
                       $output.='<td>'.$this->getLpByName($row['addedBy'],$row['namesId']).'</td>
                                 <td>'.$this->getAdminNameWokingOnName($row['namesId']).'</td>
                                 <td>
                                 <a href="#" class="publishName btn btn-sm btn-primary" id ="'.$row['namesId'].'"><i class="fa fa-check mx-1" data-toggle="tooltip"></i> publish </a>
                                 <a href="#" class="viewName btn btn-sm btn-primary" id ="'.$row['namesId'].'" data-toggle="modal" data-target="#myModal2" ><i class="fa fa-eye mx-1" data-toggle="tooltip" title="View details"></i> view</a>          
                                 <a href="#" class="sendMsg btn btn-sm btn-primary" id ="'.$row['namesId'].'"  data-ab ="'.$this->getSenderName($row['approvedBy']).'" data-id ="'.$row['approvedBy'].'" data-toggle="modal" data-target="#modal_aside_right_1"><i class="fa fa-send mx-1" data-toggle="tooltip"  title="Send Message to the admin who appproved this name"></i> Message Admin</a>
                                 </td>  
                             </tr>  ';
                     }
                 }else{
                    $output.='<tr> <td colspan ="6">No Record Yet!</td>  </tr>';
                 }
            echo $output;
         }
    }
 //========================================================================///
 // getApprovedNames




 /////////////////// GET ALL Published NAMES FOR Super-Admin ---- EDITOR ------  `approvedBy`, `published`, `publishedAt` ///////////////////////////////
public function getPublishedNames(){
    $con          = self::con(); 
    $query        = $con->query("SELECT * FROM `names` WHERE `status`='approved' AND `published`='1'");
    if($query){
         if($query->num_rows>0){
               $i = 0;
                 while($row = $query->fetch_assoc()){
                         echo ' <tr>
                                 <td>'.(++$i).'</td>
                                 <td>'.$row['name'].'</td>
                                 <td>'.$row['nameUsage'].'</td>
                                 <td>'.$row['origin'].'</td>
                                 <td> Yes </td> 
                                 <td>'.$this->getAdminNameWokingOnName($row['namesId']).'</td>
                                 <td>
                                 <a href="#" class="viewName btn btn-sm btn-primary" id ="'.$row['namesId'].'" data-toggle="modal" data-target="#myModal2" ><i class="fa fa-eye mx-1" data-toggle="tooltip" title="View details"></i> view</a>          
                                 <a href="index.php?pg=editName&nId='.$row['namesId'].'" class="btn btn-sm btn-primary" id ="'.$row['namesId'].'"><i class="fa fa-pencil mx-1" data-toggle="tooltip"  title="Edit name"></i> Edit</a>
                                 </td>
                             </tr>  ';
                     }
                 }else{
                     echo '<tr> <td colspan ="6">No Record Yet!</td>  </tr>';
                 }
         }
    }
 //========================================================================///


/////////////////// GET NY NAMES///////////////////////////////
public function getMyNames($email){
    $uid   = $this->getAdminByEmail($email)['adminId'];
    $con          = self::con(); 
    $query        = $con->query("SELECT * FROM `names` WHERE `addedBy` ='$uid'");
    if($query){
         if($query->num_rows>0){
               $i = 0;
                 while($row = $query->fetch_assoc()){
                         echo ' <tr>
                                 <td>'.(++$i).'</td>
                                 <td>'.$row['name'].'</td>
                                 <td>'.$row['nameUsage'].'</td>
                                 <td>'.$row['origin'].'</td>
                                 <td>'.$row['otherForms'].'</td>
                                 <td>'.$row['gender'].'</td>
                                 <td>'.$row['status'].'</td> 
                                 <td>'.$this->getLpByName($row['addedBy'],$row['namesId']).'</td>
                                 <td>
                                 <!--<a href="#" class="deleteName btn btn-sm btn-primary" id ="'.$row['namesId'].'"><i class="fa fa-trash mx-1" data-toggle="tooltip"  title="Delete this name"></i></a>-->
                                 <a href="index.php?pg=editName&nId='.$row['namesId'].'" class="btn btn-sm btn-primary" id ="'.$row['namesId'].'"><i class="fa fa-pencil mx-1" data-toggle="tooltip"  title="Edit this name"></i> Edit </a>
                                 <a href="#" class="viewName btn btn-sm btn-primary" id ="'.$row['namesId'].'" data-toggle="modal" data-target="#myModal2" ><i class="fa fa-eye mx-1" data-toggle="tooltip" title="View details"></i> View</a>          
                                 </td>
                             </tr>  ';
                     }
                 }else{
                     echo '<tr> <td colspan ="6">No Record Yet!</td>  </tr>';
                 }
         }
    }
 //========================================================================///
/////////////////// GET NY NAMES///////////////////////////////



/////////////////// GET PENDING  ADDED NAMES///////////////////////////////
public function getNewlyAddedNames(){ 
     // `namesId`,`name`,`otherForms`,`nameUsage`,`gender`,`origin`,`pronounce`,`meaning`,`history`,`personality`,`addedBy`,`status`,`date_created`, `date_updated` // `date_created` > (now() - INTERVAL 7 day)
    $con          = self::con(); 
    $query        = $con->query("SELECT * FROM `names` WHERE `status`='pending' ORDER BY `date_created` DESC");
    if($query){
         if($query->num_rows>0){
               $i = 0;
                 while($row = $query->fetch_assoc()){
                         echo ' <tr>
                                 <td> <span class="custom-checkbox"> <input type="checkbox" id="'.$row['namesId'].'"> <label for="'.$row['namesId'].'"></label> </span> </td>
                                 <td>'.$row['name'].'</td>
                                 <td>'.$row['nameUsage'].'</td>
                                 <td>'.$row['origin'].'</td>
                                 <td>'.$row['otherForms'].'</td>
                                 <td>'.$row['gender'].'</td>
                                 <td>'.date("M, d Y",strtotime($row['date_created'])).'</td>
                                 <td>'.$row['status'].'</td> 
                                 <!--<td>'.$this->getLpByName($row['addedBy'],$row['namesId']).'</td>-->
                                 <td>
                                 <!--<a href="#" class="approveName btn btn-sm btn-primary" id ="'.$row['namesId'].'"  data-toggle="modal" data-target="#modal_aside_right_2"><i class="fa fa-check mx-1" ></i> Approve</a>-->
                                 <!-- <a href="#" class="deleteName btn btn-sm btn-primary"  id ="'.$row['namesId'].'"><i class="fa fa-trash mx-1" data-toggle="tooltip"  title="Delete this name"></i> Delete</a>-->
                                 <a href="#myModal2" class="viewName btn btn-sm btn-primary" id ="'.$row['namesId'].'" data-toggle="modal" data-target="#myModal2"><i class="fa fa-eye mx-1" data-toggle="tooltip" title="View details"></i> View </a>          
                                 </td>
                             </tr>  ';
                     }
                 }else{
                     echo '<tr> <td colspan ="9" class ="text-center">No Record Yet!</td>  </tr>';
                 }
         }
    }
 //==================GET NEWLY ADDED NAMES  ===================================///




/////////////////// GET WAITING NAMES ///////////////////////////////
public function getWaitingNames(){ 
    // `namesId`,`name`,`otherForms`,`nameUsage`,`gender`,`origin`,`pronounce`,`meaning`,`history`,`personality`,`addedBy`,`status`,`date_created`, `date_updated` // `date_created` > (now() - INTERVAL 7 day)
   $con          = self::con(); 
   $query        = $con->query("SELECT * FROM `names` WHERE `status`='waiting' ORDER BY `date_created` DESC");
   if($query){
        if($query->num_rows>0){
              $i = 0;
                while($row = $query->fetch_assoc()){
                        echo ' <tr>
                                <td> <span class="custom-checkbox"> <input type="checkbox" id="'.$row['namesId'].'"> <label for="'.$row['namesId'].'"></label> </span> </td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['nameUsage'].'</td>
                                <td>'.$row['origin'].'</td>
                                <td>'.$row['otherForms'].'</td>
                                <td>'.$row['gender'].'</td>
                                <td>'.date("M, d Y",strtotime($row['date_created'])).'</td>
                                <td>'.$row['status'].'</td> 
                                <td>'.$this->getLpByName($row['addedBy'],$row['namesId']).'</td> 
                                <td>'.$this->getAdminNameWokingOnName($row['namesId']).'</td> 
                                <td>
                                <a href="#" class="approveName btn btn-sm btn-primary" id ="'.$row['namesId'].'"><i class="fa fa-check mx-1" ></i> Approve </a>
                                <a href="index.php?pg=editName&nId='.$row['namesId'].'" class="btn btn-sm btn-primary"  id ="'.$row['namesId'].'"><i class="fa fa-pencil mx-1" data-toggle="tooltip"  title="Edit this name"></i> Edit</a>
                                <a href="#myModal2" class="viewName btn btn-sm btn-primary" id ="'.$row['namesId'].'" data-toggle="modal" data-target="#myModal2"><i class="fa fa-eye mx-1" data-toggle="tooltip" title="View details"></i> View </a>          
                                </td>
                            </tr>  ';
                    }
                }else{
                    echo '<tr> <td colspan ="9" class ="text-center">No Record Yet!</td>  </tr>';
                }
        }
   }
//==================GET NEWLY ADDED NAMES  ===================================///






/////////////////// NAMES search ///////////////////////////////
public function nameSearch($name){
    $nm  =  $this->clean_input($name);
    $con          = self::con(); 
    $query        = $con->query("SELECT * FROM `names` WHERE `name` LIKE '%$nm%' AND `published`='1'");
    // `name`,`otherForms`,`nameUsage`,`gender`,`origin`,`pronounce`,`meaning`,`history`,`personality`
    if($query){
        $output ='<div class="col-12">
                    <h2>Search Result For<u class="ml-2">"'.$name.'"</u></h2>
                    <p class="text-muted">About <span class ="badge badge-info">'.$query->num_rows.'</span> results (0.52 seconds)</p>
                </div>';
         if($query->num_rows>0){
            while($row = $query->fetch_assoc() ){
                $output.= '<div class="col-12 results">
                            <div class="pt-4 border-bottom">
                                <a class="d-block h4" data-toggle="collapse" href="#details_'.$row['namesId'].'" role="button" aria-expanded="false" aria-controls="details_'.$row['namesId'].'">'.$name.'</a>
                                <a class="page-url text-primary" data-toggle="collapse" href="#details_'.$row['namesId'].'" role="button" aria-expanded="false" aria-controls="details_'.$row['namesId'].'">View Details </a>
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
                     </div>';
               }             

            }else{
                $output.='<div class ="col-md-12 alert alert-info"> No Record Found! </div></div>';
            }
            echo $output;
         }
    }
 




// ============== USER STATISTICS ====================

// Pending
public function getTotalPendingNames(){
    $con   = self::con(); 
    $query = $con->query("SELECT * FROM `names` WHERE `status`='pending'");
    $total = $query->num_rows;
    return $total;
}


// Approved Names
public function getTotalApprovedNames(){
    $con   = self::con(); 
    $query = $con->query("SELECT * FROM `names` WHERE `status`='approved'");
    $total = $query->num_rows;
    return $total;
}


// Total Added Name
public function getTotalAddedNames(){
    $con   = self::con(); 
    $query = $con->query("SELECT * FROM `names`");
    $total = $query->num_rows;
    return $total;
}


// Get Total points earned   [ This function is obsolete ]
public function getTotalLexiPoints(){
    $con   = self::con(); 
    $query = $con->query("SELECT  SUM(`lexiPoints`) AS totalLexi FROM `members`");
    $row   = $query->fetch_assoc();
    $total = number_format($row['totalLexi'],0,".",",");
    return $total;
}
//getNameDetailsById($nId)

//==================== LEXI POINTS Exlusive ============== 
// Get Total points earned//  `lexp_id`, `memId`, `namesId`, `name`, `gender`, `n_usage`, `origin`, `history`, `meaning`, `pronounce`, `otherForms`, `updatedAt`
public function getSumOfLexiPoints($memId){
    $con   = self::con(); 
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
//==================== LEXI POINTS Exlusive ============== 


// Get Total points earned
public function getTotalUsers(){
    $con   = self::con(); 
    $query = $con->query("SELECT * FROM `members`");
    $row   = $query->fetch_assoc();
    $total = $query->num_rows;
    $total = number_format($total,0,".",",");
    return $total;
}




// This returns the total Number of names completed by this ADMIN
private function adminTotalCompletedNames($adminId){
    $con          = self::con(); 
    $query        = $con->query("SELECT * FROM `lexipoints` WHERE `adminId`='$adminId' AND `work_status`='completed'");
    if($query->num_rows>0){
        $rowCount = $query->num_rows;
        return number_format($rowCount,0,".",",");
    }else{
        return 0;
    }
    $con->close();
}



// This returns the total Number of names completed by this ADMIN
private function adminTotalInProgressNames($adminId){
    $con          = self::con(); 
    $query        = $con->query("SELECT * FROM `lexipoints` WHERE `adminId`='$adminId' AND `work_status`='in-progress'");
    if($query->num_rows>0){
        $rowCount = $query->num_rows;
        return number_format($rowCount,0,".",",");
    }else{
        return 0;
    }
    $con->close();
}


// Assign Points to user who successfully 
// private function setLexiPoint($uid,$pointValue = 0){
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
        $passReal      = $this->getAdminByEmail($email)['paswd'];
        if($new_password === $re_password){
            $pass_hash     = md5($new_password);
            if($passReal === md5($old_password)){
                $updateQuery = $con->query("UPDATE `admins` SET `paswd`='$pass_hash' WHERE `email`='$email'");
                    if($updateQuery){
                        echo true;
                    }else{
                        echo "Error Changing Password!";
                    }
            }else{
                echo "Wrong old password!";
            }
        }else{
            echo "Password Mismatch";
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
        if(!isset($_SESSION["NL_ADMIN_USER_LIVE"] )){
            header("location:./login.html");
        }
    }


// Logout From all sessions set 
 public function logOut(){
    if(isset($_GET['pg']) && $_GET['pg']=="logout"){
         unset($_SESSION["NL_ADMIN_USER_LIVE"]);
         session_destroy();   
         self::checkLoggedIn();  
    }
       
  }

  
 }
 
 $admin = new Admin();
//  $admin->seedAdmin();
//  echo $admin->getLpByName(105,94);
//  echo '<br/>';
//  echo $admin->getSumOfLexiPoints(105);
// $admin->isPointGiven(94);