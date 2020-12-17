 
<div class="col-md-5 shadow border p-md-5">
<h1 class="h3 mb-3 font-weight-normal border-bottom text-muted">Make changes to your profile info.</h1>
        <form id ="profileForm" class="">
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" value ="<?php echo htmlentities($admin->getAdminByEmail($_SESSION["NL_ADMIN_USER_LIVE"])['name']); ?>" placeholder="Your Full Name">
                <small id="nameHelp" class="form-text text-muted">Your full name Eg. LastnName MiddleName FirstName</small>
            </div>


           
            <div class="form-row">
            <div class="form-group col-md-12">
                <label for="emailAddress">Email Address</label>
                <input type="email" class="form-control" id="emailAddress" value ="<?php echo htmlentities($_SESSION["NL_ADMIN_USER_LIVE"]); ?>" name="email" placeholder="Your Email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            </div>
            
            <input type="hidden" name="action" value="update">
             <div class="result"></div> 
            <button type="submit" class="btn btn-primary my-4">Submit Update</button>
        </form>	 
</div>

<div class="col-md-5 shadow border p-md-5">
    <div class="changePassword">
        <h1 class="h3 mb-3 font-weight-normal border-bottom text-muted">Change password </h1>
            <form id ="settingsForm">
                <div class="form-group">
                    <label for="passwd">Old Password </label>
                    <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Your current password">
                    <small id="pwd" class="form-text text-muted">If you cannot remenber your password, please logout and use forgot password.</small>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
                        <small id="pwd" class="form-text text-muted">Choose new passowrd.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="re-newPassword">New Password</label>
                        <input type="password" class="form-control" id="re-newPassword" name="re-newPassword" placeholder="Confirm New Password">
                        <small id="re-newPassword" class="form-text text-muted">Confirm new passowrd.</small>
                    </div>
                </div>
            <div class="result_paswd"></div> 
            <input type="hidden" name="action" value ="update_password">
                <button type="submit" class="btn btn-primary my-4">Submit</button>
            </form>	
        </div>
  
</div>
     
<style>
    #imagePreview{
        border-radius:2%;
        width:40%;
        height:40%;
    }
</style>

 