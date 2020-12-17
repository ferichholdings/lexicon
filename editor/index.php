<?php 
   //require_once("../api/userCtrl.php"); 
   require_once("../api/adminCtrl.php"); 
   require_once("../api/messaging.php");
   $msg   = new Message();   
   $admin->checkLoggedIn();
   $admin->logOut();
   if($admin-> getAdminByEmail($_SESSION["NL_ADMIN_USER_LIVE"])['adminLevel']===1){
	   die('<p> YOU ARE IN THE WRONG PLACE. Kindly go back and do the right thing.</p>');
    }

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Names Lexicon ~ Editor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="shortcut icon" type="icon" href="./images/favicon.ico">
		
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="./js/popper.js"></script>
		<script src="./js/bootstrap.min.js"></script>
		<script src="./js/main.js"></script>
		<script src="./js/admin-lexi.js"></script>

		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.bootstrap4.min.css">
		

		<style>
	  .lexiMenu:hover{
		  background-color:#f1f1f1;
		  color:#fff !important;
	  }
	</style>
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary"> <i class="fa fa-bars"></i>
					    <span class="sr-only">Toggle Menu</span> </button>
				</div>
		   <div class="p-4">
		  		<h4><a href="../" class="logo"><img src="../user/images/logo-outline.png" width="100%" height="60"/></a></h4>
	        <ul class="list-unstyled components mb-5">
			  <li class="mb-4"> <a href="./?pg=profile"> <span class="fa fa-user mr-3"></span>  <?php echo $admin-> getAdminByEmail($_SESSION["NL_ADMIN_USER_LIVE"])['name']; ?> </a>  </li>


	          <li class="border-bottom lexiMenu"> <a href="./?pg=home"><span class="fa fa-home mr-3"></span>      Home        </a>    </li>
			  <li class="border-bottom lexiMenu"> <a href="./?pg=viewNames"><span class="fa fa-eye mr-3"></span>  Names  </a>    </li>
			  <li class="border-bottom lexiMenu"> <a href="./?pg=users"><span class="fa fa-users mr-3"></span>    Users        </a>    </li>
			  <?php if($admin-> getAdminByEmail($_SESSION["NL_ADMIN_USER_LIVE"])['adminLevel']==1){ ?>

			   <li class="border-bottom lexiMenu"> <a href="./?pg=admins"><span class="fa fa-users mr-3"></span> Admins </a>  </li>

			  <?php } ?>
			  <li class="border-bottom lexiMenu"> <a href="./?pg=msg"><span class="fa fa-envelope mr-3"></span> Messages  <i class ="badge badge-danger float-right">
			      <?php echo $msg->getTotalUnreadMessages($_SESSION["NL_ADMIN_USER_LIVE"]);  ?>
			  </i></a></li>
			  <li class="border-bottom lexiMenu"> <a href="./?pg=logout"><span class="fa fa-lock mr-3"></span>  Logout  </a> </li>
	        </ul>

 

	        <div class="footer m-4">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				Copyright &copy; <span id ="nlDateYear"></span>
				All rights reserved | <i class="icon-heart" aria-hidden="true"></i> 
				by <a href="https://nameslexicon.com" target="_blank">Names Lexicon</a>
				</p>
	        </div>

	      </div>
    	</nav>
		
	<script>
		(function(){
			let nld = document.getElementById("nlDateYear");
	        nld.innerHTML = new Date().getFullYear();
		})();
	</script> 
		
        <!-- Page Content  -->
      <div id="content" class="">
			<div class="row p-4 p-md-5">
				<?php 

				if(isset($_GET['pg'])){
				   $pg   = $_GET['pg'];
				   $page = "assets/temp/".$pg.".php";
				   if(file_exists($page)){
					   require_once($page);
				   }
				}else{
				   require_once("assets/temp/home.php");
				}
			   
			   ?>
			   
			</div>
		</div>
  </div>
 

  		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.bootstrap4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>

 <!-- ============================ SIDE MODAL ================================= -->  
 <style>
	.modal .modal-dialog-aside{  width: 400px; max-width:80%; height: 100%; margin:0;transform: translate(0); transition: transform .2s;  }	 
	.modal .modal-dialog-aside .modal-content{  height: inherit; border:0; border-radius: 0;}
	.modal .modal-dialog-aside .modal-content .modal-body{ overflow-y: auto }
	.modal.fixed-left .modal-dialog-aside{ margin-left:auto;  transform: translateX(100%); }
	.modal.fixed-right .modal-dialog-aside{ margin-right:auto; transform: translateX(-100%); }
	.modal.show .modal-dialog-aside{ transform: translateX(0);  } 
</style>
 
<!-- <button data-toggle="modal" data-target="#modal_aside_right" class="btn btn-primary" type="button">  Modal aside right  </button>-->

<div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-aside" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sending Message </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class ="userViewMoreDetails">  
                <!-- <i class="fa fa-spinner fa-spin fa-3x"></i>  -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">&times;</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->



<!--  /////////////////////// For Sending message //////////////////////// -->
<div id="modal_aside_right_1" class="modal fixed-left fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-aside" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<h6 class="modal-title">Message to <small id="nameHelp" class="form-text text-muted"><i class="fa fa-spinner fa-spin"></i></small></h6>
		
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
						<input type="hidden" name="senderId"   value ="<?php echo $admin-> getAdminByEmail($_SESSION["NL_ADMIN_USER_LIVE"])['adminId']; ?>">
						<input type="hidden" name="action"     value ="sendMsg">
						<input type="hidden" name="receiverId" id ="receiverId" value ="">
						<div class="form-group"><button type="submit" class="btn btn-primary">Send <i class ="fa fa-send"></i></button></div>
						
				</form>
		</div>
       <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">&times;</button> </div>
    </div>
  </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->

  </body>
</html>