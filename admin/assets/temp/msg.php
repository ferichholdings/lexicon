
<div class="">
<!-- <a href="#m" class="btn btn-primary btn-sm float-right sendMsg" data-toggle="modal" data-target="#modal_aside_right_1"> &plus;<i class="fa fa-send"></i></a> -->
<div class="row message-wrapper rounded shadow mb-20">
    <div class="col-md-4 message-sideleft">
        <div class="panel">
            <div class="panel-heading">
                <div class="pull-left"> <h3 class="panel-title mx-2 p-2">Inbox</h3>  </div>
                <div class="pull-right p-2">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle px-2" data-toggle="dropdown">All Sources
                                <span class="caret mr-2 p-2"></span>
                        </button> 
                        <ul class="dropdown-menu" role="menu">
                            <li class ="mx-2 text-primary border-bottom" ><a class ="text-primary" href="?pg=msg"><i class="fa fa-download"></i> Inbox</a></li>
                            <li class ="mx-2 text-primary border-bottom" ><a class ="text-primary" href="?pg=outbox"><i class="fa fa-upload"></i>   Outbox</a></li>
                            <!-- <li class ="mx-2 text-primary border-bottom" ><a class ="text-primary" href="#"><i class="fa fa-trash-o"></i>  Trash</a></li> -->
                            <!-- <li class="divider"></li>  -->
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div><!-- /.panel-heading -->
            <div class="panel-body no-padding" style ="max-height:750px !important; overflow-y:scroll;">
                <div class="list-group no-margin list-message">
                        <!-- List/Show messages here -->

                </div><!-- /.list-group -->
            </div><!-- /.panel-body -->
        </div><!-- /.panel -->
    </div><!-- /.message-sideleft -->

    <!--  Show Message Details When Message is Clicked -->
    <div class="col-md-8 message-sideright messageDetails"> 
        <div class="card">
          <div class ="card-body"> Click on a message on the left pane and the details will show here</div>
        
        </div> 
    </div>
    <!-- /.message-sideright -->

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
		<h6 class="modal-title">Replying to <small id="nameHelp" class="form-text text-muted"><i class="fa fa-spinner fa-spin"></i></small></h6>
		
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
						<input type="hidden" name="senderId"   value ="<?php echo $admin->getAdminByEmail($_SESSION["NL_ADMIN_USER_LIVE"])['adminId']; ?>">
						<input type="hidden" name="action"     value ="replyMsg">
            <input type="hidden" name="receiverId" id ="rcv_ID" value ="">
            <input type="hidden" name="msgId"      id ="msg_ID" value ="">
						<div class="form-group"><button type="submit" class="btn btn-primary"> Send <i class ="fa fa-send"></i></button></div>
				</form>
		</div>
       <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">&times;</button> </div>
    </div>
  </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->

<script>
 $(document).ready(function(){
    let lexiApi = "http://localhost/lexicon/api/adminCtrl.php";
    let $doc    = $(document);
    
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
        $doc.on("submit","#sendMessageForm", function(evt){
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


// 
  //  Load messages onto the left pane
  let loadMessages = ()=>{
        $.ajax({
            url:lexiApi,
            method:"post",
            data:{action:'inbox'},
            beforeSend:()=>{
                $(".list-message").html('<i class ="fa fa-spinner fa-spin"></i>');
            },
            success:(res)=>{
                $(".list-message").html(res);
            }
        });
    }

    loadMessages();
    setInterval(() => {  loadMessages();  }, 30000);


 });

</script>
<style> 
/* ========================================================================
 * MESSAGES
 * ======================================================================== */
.message form {
  padding: 6px 15px;
  background-color: #FAFAFA;
  border-bottom: 1px solid #E6EBED;
}
.message form .has-icon .form-control-icon {
  position: absolute;
  z-index: 5;
  top: 0;
  right: 0;
  width: 34px;
  line-height: 33px;
  text-align: center;
  color: #777;
}
.message > a {
  position: relative;
}
.message .indicator {
  text-align: center;
}
.message .indicator .spinner {
  left: 26%;
  width: 200px;
  font-size: 13px;
  line-height: 17px;
  color: #999;
}

.message-wrapper {
  position: relative;
  padding: 0px;
  background-color: #ffffff;
  margin: 0px;
}
.message-wrapper .message-sideleft {
  vertical-align: top !important;
}
.message-wrapper .message-sideleft[class*="col-"] {
  padding-right: 0px;
  padding-left: 0px;
}
.message-wrapper .message-sideright {
  background-color: #f8f8f8;
}
.message-wrapper .message-sideright[class*="col-"] {
  padding: 30px;
}
.message-wrapper .message-sideright .panel {
  border-top: 1px dotted #DDD;
  padding-top: 20px;
}
.message-wrapper .message-sideright .panel:first-child {
  border-top: none;
  padding-top: 0px;
}
.message-wrapper .message-sideright .panel .panel-heading {
  border-bottom: none;
}
.message-wrapper .panel {
  background-color: transparent !important;
  -moz-box-shadow: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
}
.message-wrapper .panel .panel-heading, .message-wrapper .panel .panel-body {
  background-color: transparent !important;
}
.message-wrapper .media .media-body {
  font-weight: 300;
}
.message-wrapper .media .media-heading {
  margin-bottom: 0px;
}
.message-wrapper .media small {
  color: #999999;
  font-weight: 400;
}

.list-message .list-group-item {
  padding: 15px;
  color: #999999 !important;
  border-right: 3px solid #8CC152 !important;
}
.list-message .list-group-item.active {
  background-color: #EEEEEE;
  border-bottom: 1px solid #02a8f5d7 !important;
}
.list-message .list-group-item.active p {
  color: #999999 !important;
}
.list-message .list-group-item.active:hover, .list-message .list-group-item.active:focus, .list-message .list-group-item.active:active {
  background-color: #f1f1f1;
  color:#fff;
}
.list-message .list-group-item small {
  font-size: 12px;
}
.list-message .list-group-item .list-group-item-heading {
  color: #999999 !important;
}
.list-message .list-group-item .list-group-item-text {
  margin-bottom: 10px;
}
.list-message .list-group-item:last-child {
  -moz-border-radius: 0px;
  -webkit-border-radius: 0px;
  border-radius: 0px;
  border-bottom: 1px solid #DDD !important;
}
.avatar{
    width:50px;
    height:50px;
}
</style>