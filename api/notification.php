
<?php
require_once("db.php");

class Notification extends Database{
    
    private $memId ;
    private $subject ;
    private $message ;

    public function __construct($memId=0, $subject="", $message=""){
        $this->memId          = $memId;
        $this->subject        = $subject; 
        $this->message        = $message;
    }

    public function notifyMe(){
         $con     = self::con();
         $memId   =  $this->memId;
         $subject =  $this->subject; 
         $message =  $this->message;
         $q       =  $con->query("INSERT INTO `notify`(`memId`,`subject`,`message`,`date_created`) VALUES ('$memId','$subject','$message', NOW())");
         if($q) { return true; }else{ return false;  }

    }


    public function getMyNotifications($memId){
        $con     = self::con();
        $query   = $con->query("SELECT * FROM `notify` WHERE `memId` ='$memId' ORDER BY `date_created` DESC");
        if($query){
            while($row = $query->fetch_assoc()){
                echo '<li>
                        <a target="_blank" href="#">'.$row['subject'].'</a>
                        <a href="#" class="float-right">'.date("Y-m-d H:i A", strtotime($row['date_created'])).'</a>
                        <p> '.$row['message'].'</p>
                    </li>';
            }
        }

    }


    public function getTotalNotification($memId){
        $con     = self::con();
        $query   = $con->query("SELECT * FROM `notify` WHERE `memId` ='$memId'");
        echo  $query->num_rows ;
    }


}

