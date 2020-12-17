<?php 
   require_once("../api/userCtrl.php"); 
   if(isset($_GET['search']) && !empty($_GET['search'])){ 
	   $searStr = strip_tags(trim($_GET['search']));
   }
?>
<!doctype html>
<html lang="en">
  <head> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Primary Meta Tags -->
<title>Names Lexicon ~ Search</title>
<meta name="title" content="Names Lexicon ~ Search">
<meta name="description" content="Your name is your identity. Find the meaning of your name and your personality. Before you give your child a name, find out what the name means">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://metatags.io/">
<meta property="og:title" content="Names Lexicon ~ Search">
<meta property="og:description" content="Your name is your identity.
Find the meaning of your name and your personality. Before you give your child a name, find out what the name means">
<meta property="og:image" content="https://metatags.io/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://metatags.io/">
<meta property="twitter:title" content="Names Lexicon ~ Search">
<meta property="twitter:description" content="Your name is your identity.
Find the meaning of your name and your personality. Before you give your child a name, find out what the name means">
<meta property="twitter:image" content="https://metatags.io/assets/meta-tags-16a33a6a8531e519cc0936fbba0ad904e52d35f34a46c97a2c9f6f7dd7d336f2.png">


<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/style.css">

		<link rel="shortcut icon" type="icon" href="images/favicon.ico">
		<style>
			.page-link{
				border:1px solid #20bbeb !important;
				background-color:#fff !important;
			}
			li.page-item.active a{
				background-color:#20bbeb !important;
				font-weight:800 !important;
			}
			.addNameBtn,.page-item a.page-link{
				border-color:#20bbeb;
				color:#20bbeb;
			}
			.addNameBtn:hover, li.active a.page-link{
				border-color:#20bbeb;
				background-color:#20bbeb;
			}
		</style>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="js/popper.js"></script>
		<script src="js/bootstrap.min.js"></script>
        <script src="js/userLexi.js"></script>	

  </head>
  <body>
		
   <div class="container">
        <!-- Page Content  --> 
			<div class="row">
					<div class="com-md-2 my-2"><a href="../" class="logo img-responsive"><img src="images/logo-outline.png"  height="60"/></a></div>
					<div class="col-md-7">
							<form action="" class="search my-4">
									<div class="input-group">
										<input type="search" style ="width:50% !important;" name="search" id="nameSearch" value ="<?php  echo $searStr ?? ""; ?>" placeholder ="Search for a name" class="form-control form-control-lg border" required />
										 <span class="input-group-append">
											<!-- <div class="input-group-text bg-transparent border-0 w-10" type ="submit" style ="margin-left:-38px; z-index:2222;">
												<i class="fa fa-microphone" style="color:red"></i>
											</div> -->
											<button type="submit" class="btn btn-primary input-group-text border-0 w-40" style="color:#fff;font-weight:600;"> Lexi Search </button>
										</span>
									</div> 								
							</form>
				    </div>
				
        <!--  Display search results  -->
        <div class="col-md-10 result">

         <?php  if(isset($_GET['search']) && !empty($_GET['search'])){?>
          <div class="row mb-4">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                     <?php 
                     
                     $user->nameSearch(trim($_GET['search']));
                     
                     ?>
                    <nav class="col-12" aria-label="Page navigation">
                      <ul class="pagination mt-5">
                        <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
                        <li class="page-item active" onclick="history.go(-1);"><a class="page-link" href="#">Previous</a></li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
		  </div>
		   <?php } ?>
        </div>
	       
		</div> <!-- End of Row user/?search=tobi&pg=addName -->
    </div>    <!-- End of Conatiner  -->
 <script>
  let str = "<?php  echo $searStr ?? ''; ?>";
  function addSearchedName(){
	  let urlRedirect = 'http://localhost/lexicon/user/?search='+str+'&pg=addName';
      location.assign(urlRedirect);
	  sessionStorage.setItem("searchUrl", urlRedirect);
  }
 </script>
  <script src="js/main.js"></script>
  </body>
</html>