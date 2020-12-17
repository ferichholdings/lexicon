    <div class="col-md-7 shadow border p-md-5 offset-md-1">
        <h1 class="h3 mb-3 font-weight-normal border-bottom text-muted">Adding names would earn you some lexi points.</h1>
                <form id ="addNameForm" class="bordered">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control bordered" id="Name" name="Name"  placeholder="Pesron's Name" required />
                            <small id="nameHelp" class="form-text text-muted">The name whose history you want to add</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="otherForms">Other Forms</label>
                            <input type="text" class="form-control bordered" id="otherForms" name="otherForms" placeholder="Other forms of the name" required />
                            <small id="otherFormsHelp" class="form-text text-muted">Comma separated list of other name forms.</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nameUsage">Usage</label>
                            <input type="text" class="form-control bordered" id="nameUsage" name="nameUsage" placeholder="Pesron's Name" required />
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
                            <input type="text" class="form-control bordered" id="origin" name="origin" placeholder="What is the origin of this name ?" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pronounce">Pronunciation</label>
                            <input type="text" class="form-control bordered" id="pronounce" name="pronounce" placeholder="How is this name pronounced ?"  required />
                        </div>
                         
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="history">History</label>
                            <textarea class="form-control bordered" rows ="30" style ="height:150px !important;" id="history" name="history" placeholder="What is the history of this name ?" requied></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="meaning">Meaning</label>
                            <textarea class="form-control bordered" rows ="30" style ="height:150px !important;" id="meaning" name="meaning" placeholder="What is the meaning of this name ?" required></textarea>
                        </div>
                         
                    </div>
                    <div class="form-group result"></div>
                    <input type="hidden" name="action" value="addName">
                    <button type="submit" class="btn btn-primary my-2">Submit Update</button>
                </form>	 
             
    </div>

