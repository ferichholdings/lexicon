<?php 
   if(isset($_GET['search']) && !empty($_GET['search'])){ 
	   $searStr = strip_tags(trim($_GET['search']));
   }
?>
<div class="row w-100">
        <form action="?pg=home" class="search my-4 col-md-9">
            <div class="input-group">
                <input type="search" name="search" id="nameSearch" value ="<?php  echo $searStr ?? ""; ?>" placeholder ="Search for a name" class="form-control border" required />
                <span class="input-group-append">
                    <!-- <div class="input-group-text bg-transparent border-0" type ="submit" style ="margin-left:-48px; z-index:2222;">
                        <i class="fa fa-microphone" style="color:red"></i>
                    </div> -->
                    <button type="submit" class="btn btn-sm btn-primary"> Lexi Search </button>
                    <button type="button" class="btn btn-sm btn-outline-primary addNameBtn" onclick ="addSearchedName();"> Add a name </button> 
                </span>
            </div> 
        </form>
<style>
  .addNameBtn,.page-item a.page-link{
    border-color:#20bbeb;
    color:#20bbeb;
  }
  .addNameBtn:hover, li.active a.page-link{
    border-color:#20bbeb;
    background-color:#20bbeb;
  }
  ul li.page-item.active a.page-link{
    border-color:#20bbeb;
    background-color:#20bbeb;
  }
</style>
<script>
  let str = "<?php  echo $searStr ?? ''; ?>";
  function addSearchedName(){
    location.assign('?search='+str+'&pg=addName');
  }
  $('a.page-url').click(function(){
  $('a.page-url i').toggleClass('fa-chevron-up fa-chevron-down');
 });
</script>
        <!--  Display search results  -->
        <div class="col-md-9 result">

         <?php  if(isset($_GET['search']) && !empty($_GET['search'])){?>
          <div class="row mb-4">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                     <?php 
                     
                     $user->nameSearch($searStr);
                     
                     ?>
                    <nav class="col-12" aria-label="Page navigation">
                      <ul class="pagination mt-5">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item  active"><a class="page-link" href="#">Next</a></li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
         <?php } ?>
</div>


<script>
  (function(){
    let addNameBtn  = $(".addNameBtn");
    let nameSearch  = $("#nameSearch");
  })();
</script>

<div class="row w-100">
     <div class="col-md-9">

       <div class="row">
       
          <div class="col-md-3">
              <div class="card border-info mx-sm-1 p-3">
                  <div class="card border-info shadow text-info p-3 my-card" ><span class="fa fa-users" aria-hidden="true"></span></div>
                  <div class="text-info text-center mt-3"><h6>&sum; <a href ="?pg=viewNames" class ="text-info" >Names Added </a></h6></div>
                  <div class="text-info text-center mt-2"><h1><?php echo $user->getTotalAddedNames($_SESSION["NL_USER_LIVE"]); ?></h1></div>
              </div>
          </div>

        <div class="col-md-3">
            <div class="card border-success mx-sm-1 p-3">
                <div class="card border-success shadow text-success p-3 my-card"><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-success text-center mt-3"><h6>&sum;<a href ="?pg=viewNames" class ="text-success" > Names Pending </a></h6></div>
                <div class="text-success text-center mt-2"><h1><?php echo $user->getTotalPendingNames($_SESSION["NL_USER_LIVE"]); ?></h1></div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-danger mx-sm-1 p-3">
                <div class="card border-danger shadow text-danger p-3 my-card" ><span class="fa fa-heart" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3"><h6>&sum;<a href ="?pg=viewNames" class ="text-danger" > Approved Names </a></h6></div>
                <div class="text-danger text-center mt-2"><h1><?php echo $user->getTotalApprovedNames($_SESSION["NL_USER_LIVE"]); ?></h1></div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-warning mx-sm-1 p-3">
                <div class="card border-warning shadow text-warning p-3 my-card" ><span class="fa fa-money" aria-hidden="true"></span></div>
                <div class="text-warning text-center mt-3"><h6> &sum;Lexi Points</h6></div>
                <div class="text-warning text-center mt-2"><h1><?php echo $user->getTotalLexiPoints($_SESSION["NL_USER_LIVE"]); ?></h1></div>
            </div>
        </div>


       </div>
     
       <div class="col-md-12 card mt-4"><br>
               <p> <div class="text-warning"><h6>What are Lexi points?</h6></div>
               These are points awarded to you by the NamesLexicon team for each new name that is being approved and added to our database.
               Lexi points keeps a progress report of names that has been approved by NamesLexicon team.
              Apart from giving credit to our users for adding more new names to Lexicon database, you earn 10 dollars for every 5000 Lexi points you acquire over 
              a period of time (where terms and conditions apply).  <a href= "./?pg=lexipoints">read more ...</a>
                
        </div> 



        <div class="col-md-12 card mt-4"><br>
                
               <div class="text-danger"><h6>Approved names </h6></div>
               Number of names that has been vetted and approved by the NamesLexicon team. 
                
        </div> 


        <div class="col-md-12 card mt-4"><br>
              
                <div class="text-success"><h6>Names pending</h6></div>
                Names pending to be approved by NamesLexicon team.
                
        </div> 


        <div class="col-md-12 card mt-4"><br>
                
                <div class="text-info"><h6>Names added</h6></div>
                Number of new names inputed by you 
                
        </div> 


     </div>
</div>


 







<!--   -->



