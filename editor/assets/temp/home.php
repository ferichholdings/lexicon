<div class="col-md-12">
     
     <div class="row w-100">
        <div class="col-md-2">
            <div class="card border-info mx-sm-1 p-3">
                <div class="card border-info shadow text-info p-3 my-card" ><span class="fa fa-users" aria-hidden="true"></span></div>
                <div class="text-info text-center mt-3"><h6>&sum; <a href ="?pg=viewAllNames" class ="text-info"> names </a> </h6></div>
                <div class="text-info text-center mt-2"><h1><?php echo $admin->getTotalAddedNames(); ?></h1></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-success mx-sm-1 p-3">
                <div class="card border-success shadow text-success p-3 my-card"><span class="fa fa-eye" aria-hidden="true"></span></div>
                <div class="text-success text-center mt-3"><h6>&sum; <a href ="?pg=viewAllNames" class ="text-success"> Names pending </a> </h6></div>
                <div class="text-success text-center mt-2"><h1><?php echo $admin->getTotalPendingNames(); ?></h1></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-danger mx-sm-1 p-3">
                <div class="card border-danger shadow text-danger p-3 my-card" ><span class="fa fa-heart" aria-hidden="true"></span></div>
                <div class="text-danger text-center mt-3"><h6>&sum; <a href ="?pg=viewAllNames" class ="text-danger"> Approved Names</a> </h6></div>
                <div class="text-danger text-center mt-2"><h1><?php echo $admin->getTotalApprovedNames(); ?></h1></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card border-warning mx-sm-1 p-3">
                <div class="card border-warning shadow text-warning p-3 my-card" ><span class="fa fa-money" aria-hidden="true"></span></div>
                <div class="text-warning text-center mt-3"><h6> &sum;Lexi Points</h6></div>
                <div class="text-warning text-center mt-2"><h1><?php echo $admin->getTotalLexiPoints(); ?></h1></div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card border-primary mx-sm-1 p-3">
                <div class="card border-primary shadow text-primary p-3 my-card" ><span class="fa fa-users" aria-hidden="true"></span></div>
                <div class="text-primary text-center mt-3"><h6> &sum; <a href ="?pg=users"> Users </a></h6></div>
                <div class="text-primary text-center mt-2"><h1><?php echo $admin->getTotalUsers(); ?></h1></div>
            </div>
        </div>

		<div class="col-md-2">
            <div class="card border-warning mx-sm-1 p-3">
                <div class="card border-warning shadow text-warning p-3 my-card"><span class="fa fa-money" aria-hidden="true"></span></div>
                <div class="text-warning text-center mt-3"><h6> &sum; Lexi Points</h6></div>
                <div class="text-warning text-center mt-2"><h1><?php echo $admin->getTotalLexiPoints(); ?></h1></div>
            </div>
        </div>

     </div>
      
</div>

<!--  The end of The statistics -->
<div class="col-md-12"> 
		<div class="row mt-4 border-bottom"> 
			<div class="col-md-12"> <h3 class="text-mutted"><b> Names approved and awaiting to be published </b></h3 class="text-mutted"></div>  

			<div class="col-md-12">
				<div class="form-group result"></div>
					<div class="form-group" id ="progress" style ="display:none">
						<div class="progress" style="height: 5px;">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
			  </div>  

		</div>    
	<table class="table table-striped table-hover" id ="newlyAddedNames">
		<thead>
			<tr>
				<th> # </th>
				<th>Name</th>
				<th>Usage</th>
				<th>Origin</th>
				<th>Status</th>
				<th>Published</th>
				<th>&sum; LP </th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php  $admin->getAllApprovedNames(); ?>
		</tbody>
	</table>      
</div>
<!-- Edit Modal HTML -->




<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body">
				<div class="nameInfo">
						<i class="fa fa-spinner fa-spin fa-3x"></i> 
				</div>
			</div>  
			<div class="modal-footer">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button>
			</div>
		</div><!-- modal-content -->

	</div><!-- modal-dialog -->
</div><!-- modal -->


<script>
$(document).ready(function() {
    $('#newlyAddedNames').DataTable( {
        "dom": '<"toolbar">frtip'
    } );
  
} );

</script>


<style>
.paginate_button .page-item .active{
	background-color:#20bbeb !important;
}
/* Modal styles */
.modal .modal-dialog {
	max-width: 800px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
	padding: 20px 30px;
}
.modal .modal-content {
	border-radius: 3px;
	font-size: 14px;
}
.modal .modal-footer {
	background: #ecf0f1;
	border-radius: 0 0 3px 3px;
}
.modal .modal-title {
	display: inline-block;
}
.modal .form-control {
	border-radius: 2px;
	box-shadow: none;
	border-color: #dddddd;
}
.modal textarea.form-control {
	resize: vertical;
}
.modal .btn {
	border-radius: 2px;
	min-width: 100px;
}	
.modal form label {
	font-weight: normal;
}	
</style>
    

<!--   -->



