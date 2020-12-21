
<?php
require_once("db.php");

class Message extends Database{
    
    private $senderId ;
    private $receiverId ;
    private $replyMsgId ;
    private $msgTitle ;
    private $message ;

    public function __construct($senderId=0, $receiverId =0, $replyMsgId =null, $msgTitle="", $message=""){
        $this->senderId     = $this->clean_input($senderId);
        $this->receiverId   = $this->clean_input($receiverId);
        $this->replyMsgId   = $this->clean_input($replyMsgId);
        $this->msgTitle     = $this->clean_input($msgTitle); 
        $this->message      = $this->clean_input($message);
    }

    // Sanitize User input --> Never trust user data.
    private function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function sendMessage(){
        // `senderId`,`receiverId`,`msg`,`msgTitle`,`replyMsgId`,`readStatus`,`createdAt`, `readAt`
         $con        = self::con();
         $senderId   = $this->senderId ;
         $receiverId = $this->receiverId;
         $replyMsgId = $this->replyMsgId;
         $msgTitle   = $this->msgTitle; 
         $message    = $this->message;
         $q =  $con->query("INSERT INTO `messages`(`senderId`,`receiverId`,`msg`,`msgTitle`,`replyMsgId`,`createdAt`) VALUES ('$senderId','$receiverId','$message','$msgTitle','$replyMsgId',NOW())");
         if($q) { return true; }else{ return $con->error;}

    }

// Get all Messages sent to me AND `replyMsgId`='0' 
public function myInbox($memId){
    $con     = self::con(); 
    $query   = $con->query("SELECT * FROM `messages` WHERE `receiverId`='$memId' ORDER BY `createdAt` DESC");
   if($query){
       $counter =0;
       $output ="";
        while($row = $query->fetch_assoc()){
            if($counter==0){
                $output.='<a href="#" class="list-group-item active" id ="'.$row['msgId'].'" >
                            <h6 class="list-group-item-heading" data-msg-sender ="'.$row['senderId'].'" data-id ="'.$this->getSenderName($row['senderId']).'">'.$this->getSenderName($row['senderId']).'<small> '.date("D, d M, Y",strtotime($row['createdAt'])).'</small></h6>
                            <p class="list-group-item-text"><strong>'.$row['msgTitle'].'</strong></p>
                            <span class="label label-success pull-right rounded badge badge-'.$this->setReadStatusClass($row['readStatus']).'">'.$this->setReadStatusState($row['readStatus']).'</span>
                            <div class="clearfix"></div>
                        </a> ';
            }else{
             $output.='<a href="#" class="list-group-item" id ="'.$row['msgId'].'">
                        <h6 class="list-group-item-heading" data-msg-sender ="'.$row['senderId'].'" data-id ="'.$this->getSenderName($row['senderId']).'">'.$this->getSenderName($row['senderId']).'<small> '.date("D, d M, Y",strtotime($row['createdAt'])).'</small></h6>
                        <p class="list-group-item-text"><strong>'.$row['msgTitle'].'</strong></p>
                        <span class="label label-success pull-right rounded badge badge-'.$this->setReadStatusClass($row['readStatus']).'">'.$this->setReadStatusState($row['readStatus']).'</span>
                        <div class="clearfix"></div>
                    </a> ';
            }

            $counter++;
        }
        echo $output;
   }else{
       echo " Error Occured ".$con->error;
   }

}


// Get all Messages I sent sent
public function myOutbox($memId){
    $con     = self::con(); 
    $query   = $con->query("SELECT * FROM `messages` WHERE `senderId`='$memId' AND `replyMsgId`= '0' ORDER BY `createdAt` DESC");
   if($query){
       $counter =0;
       $output ="";
        while($row = $query->fetch_assoc()){
            if($counter==0){
                $output.='<a href="#" class="list-group-item active" id ="'.$row['msgId'].'"  style="border-right: 1px solid #02a8f5d7 !important; ">
                            <h6 class="list-group-item-heading" data-msg-sender ="'.$row['senderId'].'" data-id ="'.$this->getSenderName($row['senderId']).'">'.$this->getSenderName($row['senderId']).'<small> '.date("D, d M, Y",strtotime($row['createdAt'])).'</small></h6>
                            <p class="list-group-item-text"><strong>'.$row['msgTitle'].'</strong></p>
                            <span class="label label-success pull-right rounded badge badge-'.$this->setReadStatusClass($row['readStatus']).'">'.$this->setReadStatusState($row['readStatus']).'</span>
                            <div class="clearfix"></div>
                        </a> ';
            }else{
             $output.='<a href="#" class="list-group-item" id ="'.$row['msgId'].'" style="border-right: 1px solid #02a8f5d7 !important; ">
                        <h6 class="list-group-item-heading" data-msg-sender ="'.$row['senderId'].'" data-id ="'.$this->getSenderName($row['senderId']).'">'.$this->getSenderName($row['senderId']).'<small> '.date("D, d M, Y",strtotime($row['createdAt'])).'</small></h6>
                        <p class="list-group-item-text"><strong>'.$row['msgTitle'].'</strong></p>
                        <span class="label label-success pull-right rounded badge badge-'.$this->setReadStatusClass($row['readStatus']).'">'.$this->setReadStatusState($row['readStatus']).'</span>
                        <div class="clearfix"></div>
                    </a> ';
            }
 
            $counter++;
        }
        echo $output;
   }else{
       echo " Error Occured ".$con->error;
   }
   
}


//================================================================================//
private function setReadStatusState($status){
   return ($status==0) ? "unread" : "read";
}

private function setReadStatusClass($status){
    return ($this->setReadStatusState($status)=="unread") ? "success" : "default";
 }
//=================================================================================//



//============================================================================================//
public function getMemberDetailsById($uid){
    $con        = self::con();
    $queryRow   = $con->query("SELECT * FROM `members` WHERE `memId` ='$uid'")->fetch_assoc();
    return  $queryRow;
  }

   // Get User/member details by ID
   public function getAdminById($uid){
    $con        = self::con();
    $queryRow   = $con->query("SELECT * FROM `admins` WHERE `adminId` ='$uid'")->fetch_assoc();
    return  $queryRow;
}

public function getAdminByEmail($email){
    $con        = self::con();
    $queryRow   = $con->query("SELECT * FROM `admins` WHERE `email` ='$email'")->fetch_assoc();
    return  $queryRow;
}

//     This function returns the name of the user sending the message using the ID of the Sender
private function getSenderName($sender_id){
      return $this->getAdminById($sender_id)['name'] ?? $this->getMemberDetailsById($sender_id)["fullName"];
}
//========================================================================================//

// date('jS F Y', strtotime($user_date))
public function getMessageDetail($msgId){
    $con     = self::con(); 
    $query   = $con->query("SELECT * FROM `messages` WHERE `msgId`='$msgId'");
    if($query){ 
        $row = $query->fetch_assoc();
            echo '<div class="card p-2">
                    <div class="card-heading">
                        <div class="media">
                            <a class="pull-left" href="#"> 
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" 
                                    style ="border-radius:50%;" alt="Rebecca Cabean" 
                                    class="img-circle avatar" />
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading ml-2"> <small> From </small>'.$this->getSenderName($row['senderId']).'<small>...</small></h4>
                                <small class="ml-2">'.date('jS F Y', strtotime($row['createdAt'])).'</small>
                            </div>
                            <a href="#m" class="btn btn-primary btn-sm float-right replyMsg" 
                                         data-toggle="modal" id ="'.$msgId.'" 
                                         data-id   = "'.$row['senderId'].'"
                                         data-name ="'.$this->getSenderName($row['senderId']).'" 
                                         data-target="#modal_aside_right_1"><i class="fa fa-share"></i>
                                         </a>
                        </div>
                    </div><!-- /.panel-heading -->
                   <div class="card-body">
                    <!--<p class ="h6 border">'.$row['msgTitle'].'</p>-->
                    <div class="border-bottom bg-primary mr-4 w-70 p-3" style="color:#fff !important; font-weight:600;border-radius:4px;"> '.$row['msg'].'</div> 
                     <p class ="ml-4 w-80">'.$this->getRepliesToMessage($msgId).'</p>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->'; 
    }else{         
       echo " Error Occured ".$con->error;
   }
   $this->readMessage($msgId);   // flag Message as read
}



///////// User Specific messages/////  AND `replyMsgId`=0 <i class="fa fa-envelope mx-1" aria-hidden="true"></i> 
public function getUserInbox($memId){
    $con     = self::con(); 
    $query   = $con->query("SELECT * FROM `messages` WHERE `receiverId`='$memId' ORDER BY `createdAt` DESC");
    if($query){ 
        if($query->num_rows>0){
            $output ="";
            while($row = $query->fetch_assoc()){
                $output .='<div id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="card">
                                <div class="card-header" role="tab" id="heading'.$row['msgId'].'">
                                <div class="mb-1">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$row['msgId'].'" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                        <p>
                                            <small>'.$this->getSenderName($row['senderId']).' 
                                            &nbsp; <i class="fa fa-share replyMsg ml-1" 
                                                             data-toggle="modal" 
                                                             id        = "'.$row['msgId'].'"
                                                             data-id   = "'.$row['senderId'].'"
                                                             data-name = "'.$this->getSenderName($row['senderId']).'"
                                                             data-target="#modal_aside_right_2"></i> 
                                            </small>
                                            <small class="float-right">'.date('jS F Y', strtotime($row['createdAt'])).'<i class="fa fa-angle-right" aria-hidden="true"></i></small>
                                        </p>
                                        <p>'.$row['msgTitle'].'</p>
                                    </a>
                            
                                </div>
                                </div>
                                <div id="collapse'.$row['msgId'].'" class="collapse" role="tabpanel" aria-labelledby="heading'.$row['msgId'].'" aria-expanded="false">
                                <div class="card-body p-2"> '.$row['msg'].'</div>
                                <div>'.$this->getRepliesToMessage($row['msgId']).'</div>
                                </div>
                            </div>  <!-- End of Card --> 
                  
                </div><!-- End of Accordion -->';
            }
            echo $output ;
        }else{
            echo '<p> You have not received any message(s) yet</p>'; 
        }
    }
}

public function getuserOutBox($memId){
    $con     = self::con(); 
    $query   = $con->query("SELECT * FROM `messages` WHERE `senderId`='$memId' AND `replyMsgId`= '0' ORDER BY `createdAt`");
    if($query){ 
        if($query->num_rows>0){
            $output ="";
            while($row = $query->fetch_assoc()){
               $output .='<div id="accordion" role="tablist" aria-multiselectable="true">
               <div class="card">
                   <div class="card-header" role="tab" id="heading'.$row['msgId'].'">
                     <div class="mb-1">
                       <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$row['msgId'].'" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                           <p><small>'.$this->getSenderName($row['senderId']).'<small class="float-right mr-4">'.date('jS F Y', strtotime($row['createdAt'])).'</small></small></p>
                           <p><small>'.$row['msgTitle'].'</small></p>
                       </a>
                       <i class="fa fa-angle-right" aria-hidden="true"></i>
                     </div>
                   </div>
                   <div id="collapse'.$row['msgId'].'" class="collapse" role="tabpanel" aria-labelledby="heading'.$row['msgId'].'" aria-expanded="false">
                     <div class="card-block p-2"> '.$row['msg'].'</div>
                   </div>
                 </div>  <!-- End of Card --> 
                 
               </div><!-- End of Accordion -->';
           }
           echo $output ;
        }else{
            echo '<p> You have not sent out message(s) yet</p>';
        }
    }
}
//////////////////////////////////////////////////////////////////////////////////////


//  Get Replies to this message '.$this->getRepliesToMessage($row['msgId']).' 
private function getRepliesToMessage($msgId){
    $con     = self::con(); 
    $query   = $con->query("SELECT * FROM `messages` WHERE `replyMsgId`='$msgId'");
    $output  ="";
    if($query){
        if($query->num_rows>0){
            while($row = $query->fetch_assoc()){
                $output.= '<p class ="bg-info w-60 p-2" data-id ="'.$msgId.'" data-name ="'.$this->getSenderName($row['senderId']).'" style ="border-radius:4px; margin-right:20px;color:#fff;">'.$row['msg'].'
                <a href="#m" class="btn btn-default btn-sm float-right replyMsg" 
                   data-id="'.$row['senderId'].'" 
                   data-toggle="modal" 
                   data-name ="'.$this->getSenderName($row['senderId']).'"
                   id ="'.$row['msgId'].'" 
                   data-target="#modal_aside_right_1">
                   <i></small> from'.$this->getSenderName($row['senderId']).'<small></i> &nbsp; <i class="fa fa-share"></i>
                </a>
                </p>';
            }
        } 
        //else{  $output.="No Replies yet!";  }
   }else{
    $output.="Error Occured ".$con->error;
   }
   return $output;
}

/////////////////////////////  Mesage Statistics /////////////////////////////////////////////////////    
    // Flag a message as read when the reeiver has read message
    public function readMessage($msgId){
        $con     = self::con(); 
        $query   = $con->query("UPDATE `messages` SET `readStatus`= '1', `readAt`= NOW() WHERE `msgId`='$msgId'");
        // echo  $query->num_rows ;
    }

    // Get Total Received messages
    public function getTotalReceivedMessages($memId){
        $con     = self::con();
        $query   = $con->query("SELECT * FROM `messages` WHERE `receiverId` ='$memId'");
        echo  $query->num_rows ;
    }

    //  Get total sent Messages
    public function getTotalSentMessage($memId){
        $con     = self::con();
        $query   = $con->query("SELECT * FROM `messages` WHERE `senderId` ='$memId'");
        echo  $query->num_rows ;
    }

    // Get Total Unread Message
    public function getTotalUnreadMessages($email){
        $con     = self::con();
        $memId   = $this->getAdminByEmail($email)['adminId'];
        $query   = $con->query("SELECT * FROM `messages` WHERE `receiverId` ='$memId' AND `readStatus`='0' AND `replyMsgId`= '0'");
        return $query->num_rows ;
    }
 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  




}

