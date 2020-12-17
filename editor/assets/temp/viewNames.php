 

<div class="col-md-12 mx-n2">
	<p class="h4 text-center border-bottom"> All Approved names </p>
	<div class="col-md-12">
				<div class="form-group result"></div>
					<div class="form-group" id ="progress" style ="display:none">
						<div class="progress" style="height: 10px;">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
			  </div>  

    <table id="example" class="table table-striped table-bordered nowrap" >
        <thead>
            <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Usage</th>
            <th>Origin</th>
            <th>Status</th>
			<th>Published</th>
			<th>&sum; LP</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $admin->getAllApprovedNames($_SESSION["NL_ADMIN_USER_LIVE"]); ?>     
        </tbody> 
    </table>
</div>

<div class="col-md-12">
	<p class="h4 text-center border-bottom"> All published names </p>
    <table id="example2" class="table table-striped table-bordered nowrap" >
        <thead>
            <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Usage</th>
            <th>Origin</th>
			<th>Published</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $admin->getPublishedNames($_SESSION["NL_ADMIN_USER_LIVE"]); ?>     
        </tbody> 
    </table>
</div>

<script>
$(document).ready(function() {
    $('#example, #example2').DataTable( {
        "dom": '<"toolbar">frtip'
    } );
  
} );

</script>


	<!-- Modal -->
	<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
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

<style>
.modal .modal-dialog {
	max-width: 800px;
}
	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}
	
	.modal.right .modal-body {
		padding: 15px 15px 80px;
	}

        
/*Right*/
	.modal.right.fade .modal-dialog {
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

/* ----- MODAL STYLE ----- */
	.modal-content {
		border-radius: 0;
		border: none;
	}

	.modal-header {
		border-bottom-color: #EEEEEE;
		background-color: #FAFAFA;
	}

</style>