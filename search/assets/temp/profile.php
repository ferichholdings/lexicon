 
<div class="col-md-5 shadow border p-md-5">
<h1 class="h3 mb-3 font-weight-normal border-bottom text-muted">Make changes to your profile info.</h1>
        <form id ="profileForm" class="" enctype ="multipart/form-data">
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" value ="<?php echo htmlentities($user->getMemberDetails($_SESSION["NL_USER_LIVE"])['fullName']); ?>" placeholder="Your Full Name">
                <small id="nameHelp" class="form-text text-muted">Your full name Eg. LastnName MiddleName FirstName</small>
            </div>


           
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="emailAddress">Email Address</label>
                <input type="email" class="form-control" id="emailAddress" value ="<?php echo htmlentities($user->getMemberDetails($_SESSION["NL_USER_LIVE"])['email']); ?>" name="email" placeholder="Your Email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group col-md-6">
                    <label for="dob">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" required />
            </div>
            </div>

            <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id ="gender" name="gender">
                        <option selected disabled>Default select</option>
                        <option value="Male"> Male </option>
                        <option value="Femal"> Female </option>
                    </select>
            </div>

            <div class="form-group">
                    <label for="profilePix">Upload Profile picture</label>
                    <input type="file" class="form-control" id="profilePix" name="profilePix" />
            </div>
            <input type="hidden" name="action" value="update">
             <div class="result"></div>
            <div class="img-holder">
                <img src="<?php  echo "./images/uploads/".$user->getMemberDetails($_SESSION["NL_USER_LIVE"])['profilePix'] ?? "./images/photo.jpg" ?>" id ="imagePreview" alt="profile Picture">
             </div>
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

    <div class="bankAccount">
        <h1 class="h3 mb-3 font-weight-normal border-bottom text-muted">Fill Your Bank Details </h1>
            <form id ="bankInfoForm"> 
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="AccName">Account Name</label>
                        <input type="text" class="form-control" id="AccName"  required name="AccName" value ="<?php echo $user->getBankInfo($_SESSION["NL_USER_LIVE"])['accountName'] ?? ""; ?>" placeholder="Account Name" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="BankName">Bank Name</label>
                        <input type="text" class="form-control" id="BankName"  required name="BankName" value ="<?php echo $user->getBankInfo($_SESSION["NL_USER_LIVE"])['bankName'] ?? ""; ?>" placeholder="Bank Name" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="AccNumber">Account Number </label>
                        <input type="text" class="form-control" id="AccNumber"  required name="AccNumber" value ="<?php echo $user->getBankInfo($_SESSION["NL_USER_LIVE"])['accountNumber'] ?? ""; ?>" placeholder="Account Number" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="AccountType">Account Type ~ <?php echo $user->getBankInfo($_SESSION["NL_USER_LIVE"])['accountType'] ?? ""; ?></label>
                        <select class="form-control" id ="AccountType" name="AccountType" required >
                            <option selected disabled>--Select Account type--</option>
                            <option value="Current"> Currennt </option>
                            <option value="Savings"> Savings </option>
                            <option value="Others"> Others  </option>
                    </select>
                    </div>
                </div>
            <div class="result_bank"></div>
            <input type="hidden" name="action" value ="bankInfo">
                <button type="submit" class="btn btn-primary my-4">Submit/Update</button>
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

<script>   
//============================================================================================= //
    let dob          = "<?php echo $user->getMemberDetails($_SESSION["NL_USER_LIVE"])['dob'] ?>";
    let gender       = "<?php echo $user->getMemberDetails($_SESSION["NL_USER_LIVE"])['gender'] ?>";
// ===========================================================================================  //
    //let accountType  = "<?php //echo $user->getBankInfo($_SESSION["NL_USER_LIVE"])['accountType'] ?>" ;
// ===========================================================================================  //

    $("#dob").val(dob);
    $("#gender").find('option[value='+gender+']').attr("selected","selected");
    //========================================================================// 




</script>