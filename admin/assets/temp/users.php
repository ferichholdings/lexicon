

<div class="col-md-12">
    <div class ="result"></div>
<table id="example" class="table table-striped table-bordered nowrap" >

        <thead>
            <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Date Created</th>
            <th>&#8721; Lexi points</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  $admin->getAllUsers(); ?>
        </tbody>
        <tfoot>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Date Created</th>
            <th>&#8721; Lexi points</th>
            <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
 <!-- ============================ SIDE MODAL ================================= -->  
 <style>
     .modal .modal-dialog-aside{ 
        	width: 400px; max-width:80%; height: 100%; margin:0;transform: translate(0); transition: transform .2s;
     }
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
        <h5 class="modal-title">User Detail View</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class ="userViewMoreDetails">  
                <i class="fa fa-spinner fa-spin fa-3x"></i> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">&times;</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->

 <!-- ============================ //SIDE MODAL ================================= -->  
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        "dom": '<"toolbar">frtip'
    } );
  
} );

</script>










