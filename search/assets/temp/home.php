<div class="row w-100">
        <form action="?pg=home" class="search my-4 col-md-9">
        <div class="input-group">
            <input type="search" name="search" id="nameSearch" placeholder ="Search for a name" class="form-control border" required />
            <span class="input-group-append">
                <div class="input-group-text bg-transparent border-0" type ="submit" style ="margin-left:-48px; z-index:2222;">
                    <i class="fa fa-microphone" style="color:red"></i>
                </div>
            </span>
        </div>
            <div class="my-2 d-flex justify-content-center mx-5" role="group" aria-label="lexi search and add name"> 
                <button type="submit" class="btn btn-primary mx-1">Lexi Search </button>
                <button type="button" class="btn btn-secondary mx-1 addNameBtn">Add a name </button> 
            </div>
        </form>

        <!--  Display search results  -->
        <div class="col-md-9 result">

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
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item  active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
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
        <div class="col-md-2">
            <div class="card border-info mx-sm-1 p-3">
                <div class="card border-info shadow text-info p-3 my-card" ><span class="fa fa-users" aria-hidden="true"></span></div>
                <div class="text-info text-center mt-3"><h6>&sum; names added</h6></div>
                <div class="text-info text-center mt-2"><h1><?php echo $user->getTotalAddedNames($_SESSION["NL_USER_LIVE"]); ?></h1></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-success mx-sm-1 p-3">
                <div class="card border-success shadow text-success p-3 my-card"><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-success text-center mt-3"><h6>&sum; Names pending</h6></div>
                <div class="text-success text-center mt-2"><h1><?php echo $user->getTotalPendingNames($_SESSION["NL_USER_LIVE"]); ?></h1></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-danger mx-sm-1 p-3">
                <div class="card border-danger shadow text-danger p-3 my-card" ><span class="fa fa-heart" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3"><h6>&sum; Aprroved Names</h6></div>
                <div class="text-danger text-center mt-2"><h1><?php echo $user->getTotalApprovedNames($_SESSION["NL_USER_LIVE"]); ?></h1></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-warning mx-sm-1 p-3">
                <div class="card border-warning shadow text-warning p-3 my-card" ><span class="fa fa-money" aria-hidden="true"></span></div>
                <div class="text-warning text-center mt-3"><h6> &sum;Lexi Points</h6></div>
                <div class="text-warning text-center mt-2"><h1><?php echo $user->getTotalLexiPoints($_SESSION["NL_USER_LIVE"]); ?></h1></div>
            </div>
        </div>

     </div>

   






<!--   -->



