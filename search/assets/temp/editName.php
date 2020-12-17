
<?php
if(isset($_GET['nId']) && !empty($_GET['nId'])){ 
    $nameId  = urldecode($_GET['nId']);
    
?>
<style>
    textarea {
    white-space: normal;
    text-align: left;
    -moz-text-align-last: left; /* Firefox 12+ */
    text-align-last: left;
}
</style>
<div class="col-md-7 shadow border p-md-5 offset-md-1">
        <h1 class="h3 mb-3 font-weight-normal border-bottom text-muted">Editing Name.</h1>
                <form id ="editNameForm" class="bordered">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control bordered" id="Name" name="Name" value ="<?php echo htmlentities($user->getNameDetailsById($nameId)["name"] ); ?>" placeholder="Pesron's Name" required />
                            <small id="nameHelp" class="form-text text-muted">The name whose history you want to add</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="otherForms">Other Forms</label>
                            <input type="text" class="form-control bordered" id="otherForms" name="otherForms" value ="<?php echo htmlentities($user->getNameDetailsById($nameId)["otherForms"] ); ?>" placeholder="Other forms of the name" required />
                            <small id="otherFormsHelp" class="form-text text-muted">Comma separated list of other name forms.</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nameUsage">Usage</label>
                            <input type="text" class="form-control bordered" id="nameUsage" name="nameUsage" value ="<?php echo htmlentities($user->getNameDetailsById($nameId)["nameUsage"] ); ?>" placeholder="Pesron's Name" required />
                            <small id="nameUsageHelp" class="form-text text-muted">The name whose history you want to add</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender">Gender</label>
                            <select class="form-control" id ="gender" name ="gender" required>
                                <option selected disabled>Default select</option>
                                <option value="Masculine"> Male </option>
                                <option value="Feminine"> Female </option>
                                <option value="Both">   Both </option>
                            </select>
                        </div>
                    </div>
                     
                     
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="origin">Origin</label>
                            <input type="text" class="form-control bordered" id="origin" name="origin" value ="<?php echo htmlentities($user->getNameDetailsById($nameId)["origin"] ); ?>" placeholder="What is the origin of this name ?" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pronounce">Pronunciation</label>
                            <input type="text" class="form-control bordered" id="pronounce" name="pronounce" value ="<?php echo htmlentities($user->getNameDetailsById($nameId)["pronounce"] ); ?>" placeholder="How is this name pronounced ?"  required />
                        </div>
                         
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="history">History</label>
                            <textarea class="form-control bordered" rows ="30" style ="height:150px !important;text-align:left;" id="history" name="history" placeholder="What is the history of this name ?" requied>
                                 <?php echo htmlentities($user->getNameDetailsById($nameId)["history"] ); ?>
                            </textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="meaning">Meaning</label>
                            <textarea class="form-control bordered" rows ="30" style ="height:150px !important;text-align:left;" id="meaning" name="meaning" placeholder="What is the meaning of this name ?" required>
                              <?php echo htmlentities($user->getNameDetailsById($nameId)["meaning"] ); ?>
                            </textarea>
                        </div>
                         
                    </div>
                    <div class="form-group result"> </div>
                    <input type="hidden" name="action" value="editName" />
                    <button type="submit" name ="editSubtn" class="btn btn-primary my-2"> Save Changes </button>

                </form>	 
                
    </div>
<?php } ?>


<script>
  let gender = "<?php echo $user->getNameDetailsById($nameId)["gender"]; ?>";
  $("#gender").find('option[value='+gender+']').attr("selected","selected"); 
</script>
