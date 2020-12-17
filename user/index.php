<?php 
   require_once("../api/userCtrl.php"); 
   require_once("../api/notification.php"); 
   require_once("../api/messaging.php");
   $msg   = new Message();  
   $noty  = new Notification();
   $user->checkLoggedIn();
   $user->logOut();
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Names Lexicon ~ Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="shortcut icon" type="icon" href="images/favicon.ico">


		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.bootstrap4.min.css">

		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="js/popper.js"></script>
		<script src="js/bootstrap.min.js"></script>
        <script src="js/userLexi.js"></script>	

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
	<style>
	  .lexiMenu:hover{
		  background-color:#f1f1f1;
		  color:#fff !important;
	  }
	</style>
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class ="shadow" style ="color:#1f769ed7 !important;">  
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary"> <i class="fa fa-bars"></i>
					    <span class="sr-only">Toggle Menu</span> </button>
				</div>
		   <div class="p-4">
			<h6><a href="./" class="logo img-responsive"><img src="images/logo-outline.png" width="100%" height="60"/></a></h6>
	        <ul class="list-unstyled components mb-5">
			  <li class="text-center mb-4"> 
				<a href="./?pg=profile">
				 <img src="<?php  echo "./images/uploads/".$user->getMemberDetails($_SESSION["NL_USER_LIVE"])['profilePix'] ?? "./images/photo.jpg" ?>" style ="height:100px; width:100px;" class="rounded" alt="Profile Picture" /> <br/>  
				 <?php echo $user->getMemberDetails($_SESSION["NL_USER_LIVE"])['fullName']; ?> 
			   </a> 
			  </li>
	          <li class="border-bottom lexiMenu"> <a href="./?pg=home"><span class="fa fa-home mx-2"></span>       Home  </a>           </li>
			  <li class="border-bottom lexiMenu"> <a href="./?pg=addName"><span class="fa fa-plus mx-2"></span>    Add a name </a>      </li>
			  <li class="border-bottom lexiMenu"> <a href="./?pg=viewNames"><span class="fa fa-eye mx-2"></span>   View my names </a>   </li>
			  <li class="border-bottom lexiMenu"> <a href="./?pg=lexipoints"><span class="fa fa-cogs mx-2"></span> My Lexi points <i class ="badge badge-primary float-right"><?php echo $user->getTotalLexiPoints($_SESSION["NL_USER_LIVE"]); ?></i> </a> </li>
			  <li class="border-bottom lexiMenu"> <a href="./?pg=notify"><span class="fa fa-bell mx-2"></span>     Notifications  <i class ="badge badge-danger float-right"><?php echo  $noty->getTotalNotification($user->getMemberDetails($_SESSION["NL_USER_LIVE"])['memId']); ?></i> </a> </li>
			  <li class="border-bottom lexiMenu"> <a href="./?pg=msg"><span class="fa fa-envelope mx-2"></span>    Messages       <i class ="badge badge-danger float-right"><?php $msg->getTotalReceivedMessages($user->getMemberDetails($_SESSION["NL_USER_LIVE"])['memId']); ?></i> </a> </li>
			  <li class="border-bottom lexiMenu"> <a href="./?pg=logout"><span class="fa fa-lock mx-2"></span>     Logout  </a>  </li>
	        </ul>

 

	        <div class="footer m-4" style ="color:#1f769ed7 !important;">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				Copyright &copy;<spann id="dateHolder"></spann> 
				All rights reserved | <i class="icon-heart" aria-hidden="true"></i> 
				by <a href="https://nameslexicon.com" target="_blank">Beulah Media Ltd</a>
				</p>
	        </div>

	      </div>
    	</nav>
		

		
        <!-- Page Content  style="background-image: url('../img/background_2.gif');" -->
      <div id="content">
			<div class="row p-5 offset-md-1">
				<?php 
					if(isset($_GET['pg'])){
						$pg   = $_GET['pg']; $page = "assets/temp/".$pg.".php";
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

  <script src="js/main.js"></script>
  <script>
    (function(){
		document.getElementById("dateHolder").innerHTML = new Date().getFullYear(); $('[data-toggle="popover"]').popover()
	})();
  </script>
  </body>
</html>