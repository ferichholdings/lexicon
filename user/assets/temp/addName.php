<?php 
   if(isset($_GET['search']) && !empty($_GET['search'])){ 
	   $searStr = strip_tags(trim($_GET['search']));
   }
?> 
   <div class="col-md-7 shadow border p-md-5 offset-md-1">
        <h1 class="h3 mb-3 font-weight-normal border-bottom text-muted">Adding names would earn you some lexi points.</h1>
                <form id ="addNameForm" class="bordered">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control bordered" id="Name" name="Name" value ="<?php  echo $searStr ?? ""; ?>" placeholder="" required />
                            <!-- <small id="nameHelp" class="form-text text-muted">The name whose history you want to add</small> -->
                        </div>
                        <div class="form-group col-md-6">
                            <label for="otherForms">Other forms of the name 
                               <i class ="fa fa-info-circle" 
                                  data-toggle="popover" data-trigger="hover" 
                                  title="Other forms of the name" data-placement="top"
                                  data-content="Other ways in which this name can be written Eg. Christian : Chris,Christ,Christopher, Christy, Christiana"></i>
                            </label>
                            <input type="text" class="form-control bordered" id="otherForms" name="otherForms" placeholder="" required />
                            <!-- <small id="otherFormsHelp" class="form-text text-muted">Comma separated list of other name forms.</small> -->
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nameUsage"> Usage                              
                                <i class ="fa fa-info-circle" 
                                  data-toggle="popover" data-trigger="hover" 
                                  title="Usage" data-placement="top"
                                  data-content="Likely places where this name is used Eg England, USA, Israel."></i>
                            </label>
                            <input type="text" class="form-control bordered" id="nameUsage" name="nameUsage" placeholder="" required />
                            <small id="nameUsageHelp" class="form-text text-muted"> Likely places where this name is used Eg England, USA, Israel.</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender">Gender</label>
                            <select class="form-control" id ="gender" name ="gender" required>
                                <option selected disabled>Default select</option>
                                <option value="Masculine"> Male </option>
                                <option value="Feminine"> Female </option>
                                <option value="Both">   Both (unisex) </option>
                            </select>
                        </div>
                    </div>

                     
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="origin">What is the origin of this name ?</label>
                            <input type="text" class="form-control bordered" id="origin" name="origin" placeholder="" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pronounce">How is this name pronounced ?</label>
                            <input type="text" class="form-control bordered" id="pronounce" name="pronounce" placeholder=""  required />
                        </div>
                         
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="history">What is the history of this name ?</label>
                            <textarea class="form-control bordered" rows ="30" style ="height:150px !important;" id="history" name="history" placeholder="" requied></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="meaning">What is the meaning of this name ?</label>
                            <textarea class="form-control bordered" rows ="30" style ="height:150px !important;" id="meaning" name="meaning" placeholder="" required></textarea>
                        </div>
                         
                    </div>
                    <div class="form-group result"></div>
                    <input type="hidden" name="action" value="addName">
                    <button type="submit" class="btn btn-primary my-2"> Submit </button>
                </form>	 
             
    </div>

