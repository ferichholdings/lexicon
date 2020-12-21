<div class="row">
      <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-info p-4">
                    <div class="card border-info shadow text-info p-4 my-card" ><span class="fa fa-users" aria-hidden="true"></span></div>
                    <div class="text-info text-center mt-3"><h6>&sum; <a href ="?pg=viewNames" class ="text-info" >Names Added </a></h6></div>
                    <div class="text-info text-center mt-2"><h1><?php echo $user->getTotalAddedNames($_SESSION["NL_USER_LIVE"]); ?></h1></div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-success p-4">
                    <div class="card border-success shadow text-success p-4 my-card"><span class="fa fa-eye" aria-hidden="true"></span></div>
                    <div class="text-success text-center mt-3"><h6>&sum;<a href ="?pg=viewNames" class ="text-success" > Names Pending </a></h6></div>
                    <div class="text-success text-center mt-2"><h1><?php echo $user->getTotalPendingNames($_SESSION["NL_USER_LIVE"]); ?></h1></div>
                </div>
            </div>

                <div class="col-md-3">
                    <div class="card border-danger p-4">
                        <div class="card border-danger shadow text-danger p-4 my-card" ><span class="fa fa-heart" aria-hidden="true"></span></div>
                        <div class="text-danger text-center mt-3"><h6>&sum;<a href ="?pg=viewNames" class ="text-danger" > Approved Names </a></h6></div>
                        <div class="text-danger text-center mt-2"><h1><?php echo $user->getTotalApprovedNames($_SESSION["NL_USER_LIVE"]); ?></h1></div>
                    </div>
                </div>
        
                <div class="col-md-3">
                    <div class="card border-warning p-4">
                        <div class="card border-warning shadow text-warning p-4 my-card" ><span class="fa fa-money" aria-hidden="true"></span></div>
                        <div class="text-warning text-center mt-3"><h6> &sum;Lexi Points</h6></div>
                        <div class="text-warning text-center mt-2"><h1><?php echo $user->getTotalLexiPoints($_SESSION["NL_USER_LIVE"]); ?></h1></div>
                    </div>
                </div>

          </div>
      </div>
    <div class="col-md-9 mt-4">
        <div class="row">
           <div class="col-md-12 card">
            <div class="my-2 border-bottom p-2" style ="color:#000;"><h6>Lexi points</h6></div>
            <p>
                What are Lexi points?<br/> 
                These are points awarded to you by the NamesLexicon team for each new name that is being approved and added to our database.
                Lexi points keeps a progress report of names that has been approved by NamesLexicon team.
                Apart from giving credit to our users for adding more new names to Lexicon database, you earn 10 dollars for every 5000 Lexi points you acquire over a period of time (where terms and conditions apply). 
            </p>

            <p>
            The information to be provided for each new name includes;
            Other forms of the name, pronunciation, meaning of the name, usage, Gender, origin and history of the name.
            For each name that is being added, vetted and approved by the NamesLexicon team, you get a maximum number of 7points.
            Here are how these points are awarded: <br/>

            <pre>
            The name that is provided    - 1 point
            The meaning                  - 1 point 
            Usage                        - 0.5 point
            Gender                       - 0.5 point
            The pronunciation            - 1 point 
            The other forms of the name  - 1 point
            The origin of the name       – 1 point 
            The history of the name      – 1 point 
            </pre>


            </p>

            <p>
             The Lexipoints(s) you get for each name that has been approved by the NamesLexicon team will depend on the accuracy of the information that has been provided. The maximum points you can get for each name cannot exceed 7
            </p>
 
            </div> 
        </div>  
    </div> 
</div>