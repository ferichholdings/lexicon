<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->

<div class="row">

  <div class="col-md-10">
      <h5 class="border-bottom">My Messages </h5>  
      <?php  $msg->getUserInbox($user->getMemberDetails($_SESSION["NL_USER_LIVE"])['memId']); ?>
      <?php  //$msg->getuserOutBox($user->getMemberDetails($_SESSION["NL_USER_LIVE"])['memId']); ?>		 
  </div>

  <div class ="col-md-2">
    <a href="#m" class="btn btn-primary btn-sm float-right sendMsg" data-toggle="modal" data-target="#modal_aside_right_1"><i class="fa fa-send"></i> Message Admin </a>
  </div>
	<!---  End of the first column -=Received messages -->
	
	 <!-- Outbox Begins -->
	<div class="col-md-12">
      <h5 class="border-bottom"> Outbox </h5> 
      <?php  $msg->getuserOutBox($user->getMemberDetails($_SESSION["NL_USER_LIVE"])['memId']); ?>		 
	</div>



</div>





 <!-- ============================ SIDE MODAL ================================= -->  
 <style>
	.modal .modal-dialog-aside{ width: 400px; max-width:80%; height: 100%; margin:0;transform: translate(0); transition: transform .2s;  }	 
	.modal .modal-dialog-aside .modal-content{  height: inherit; border:0; border-radius: 0;}
	.modal .modal-dialog-aside .modal-content .modal-body{ overflow-y: auto }
	.modal.fixed-left .modal-dialog-aside{ margin-left:auto;  transform: translateX(100%); }
	.modal.fixed-right .modal-dialog-aside{ margin-right:auto; transform: translateX(-100%); }
	.modal.show .modal-dialog-aside{ transform: translateX(0);  } 
</style>

<!--  /////////////////////// Fow Sending message -->
<div id="modal_aside_right_1" class="modal fixed-left fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-aside" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<h6 class="modal-title">Message to <small id="nameHelp" class="form-text text-muted"> Admin </small></h6>
		
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<div class="modal-body">
				<form id ="sendMessageForm">
						<div class="form-group">
							<label for="msgTitle">Message Title</label>
							<input type="text" class="form-control" id="msgTitle"  name ="msgTitle" placeholder="Message title" required />
						</div>
						<div class="form-group">
							<label for="msg">Messasge</label>
							<textarea class="form-control" style="height:150px !important;" id="msg" name ="msg" placeholder="Type your message" required></textarea>
						</div>
						<div class="result_msg"></div> 
						<input type="hidden" name="senderId"  value ="<?php echo $user->getMemberDetails($_SESSION["NL_USER_LIVE"])['memId']; ?>" />
						<input type="hidden" name="action"    value ="sendMsg" />
            <input type="hidden" name="receiverId" value ="<?php echo $user->getAdminId(); ?>" /> 
						<div class="form-group"><button type="submit" class="btn btn-primary">Send <i class ="fa fa-send"></i></button></div>
				</form>
		</div>
       <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">&times;</button> </div>
    </div>
  </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->



<!--  /////////////////////// For Replying  message /////////////////////-->
<div id="modal_aside_right_2" class="modal fixed-left fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-aside" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<h6 class="modal-title">Replying to <small id="nameHelp" class="form-text text-muted"> Receiver's name </small></h6>
		
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<div class="modal-body">
				<form id ="sendMessageForm">
						<!-- <div class="form-group">
							<label for="msgTitle">Message Title</label>
							<input type="text" class="form-control" id="msgTitle"  name ="msgTitle" placeholder="Message title" required />
						</div> -->
						<div class="form-group">
							<label for="msg">Messasge</label>
							<textarea class="form-control" style="height:150px !important;" id="msg" name ="msg" placeholder="Type your message" required></textarea>
						</div>
						<div class="result_msg"></div> 
						<input type="hidden" name="senderId"   value ="<?php echo $user->getMemberDetails($_SESSION["NL_USER_LIVE"])['memId']; ?>">
						<input type="hidden" name="action"     value ="sendMsg">
            <input type="hidden" name="receiverId" id ="rcv_ID" value ="">
            <input type="hidden" name="msgId"      id ="msg_ID" value ="">
						<div class="form-group"><button type="submit" class="btn btn-primary">Send <i class ="fa fa-send"></i></button></div>
				</form>
		</div>
       <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">&times;</button> </div>
    </div>
  </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->

<script>
 $(document).ready(function(){
    let lexiApi = "http://localhost/lexicon/api/userCtrl.php";

     $(document).on('click', ".list-group-item", function(evt){
        evt.preventDefault();
        $(".list-group-item").removeClass("active");
        $(this).toggleClass("active");
        let msgId = $(this).attr('id');
        // Name of the user/Admin who is to receive the message  
        let replyingTo      = $(this).find(".list-group-item-heading").attr('data-id');          // Name of the user replying to
        let userMsgSenderId = $(this).find(".list-group-item-heading").attr('data-msg-sender'); // id of the user who sent this message that I am replying
         $("#nameHelp").html(replyingTo);  // Set the name of the user on the field in the side modal
         $("#rcv_ID").val(userMsgSenderId);  // Set the value in the hidden field found in the side modal
         
          $.ajax({
              url:lexiApi,
              method:"post",
              data:{action:'msgdetails',msgId:msgId},
              success:(res)=>{
                  $(".messageDetails").html(res);
              }
          });

     });


//  Replying message
$(document).on('click', ".replyMsg", function(evt){
        evt.preventDefault(); 
        let msgId      = $(this).attr('id');
        let username   = $(this).attr('data-name');
        let SenderId   = $(this).attr('data-id');
        $("#msg_ID").val(msgId);
        $("#nameHelp").html(username);
        $("#rcv_ID").val(SenderId);    // Set the value in the hidden field found in the side modal
        $(document).on("submit","#sendMessageForm", function(evt){
            evt.preventDefault();
            let data = $("#sendMessageForm").serialize();
            $(".result_msg").html('<i class="fa fa-spinner fa-spin fa-3x"></i> Sending...');
            $.ajax({
                url:lexiApi,
                method:"post",
                data:data,
                success: (res)=>{
                    if(res==1){
                        $(".result_msg").html('<p class ="alert alert-success"> Message Sent! </p>');
                        setTimeout(function(){ $(".result_msg").slideUp(2000); $("#sendMessageForm").trigger('reset'); },1000);
                    }else{
                        $(".result_msg").html('<p class ="alert alert-danger">'+res+'</p>');
                    }
                }
            });
        });
   });


 });

</script>