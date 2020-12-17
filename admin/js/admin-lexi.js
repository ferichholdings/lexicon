
$(document).ready(function(){

    let lexiApi = "http://localhost/lexicon/api/adminCtrl.php";
    // Admin Login 
    $(document).on('submit',".form-signin", function(evt){
        evt.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            url:lexiApi,
            method:"post",
            data:data,
            success: (res)=>{
                if(res==1){ 
                    $(".result").html(`<p class ="alert alert-success"> Successful </p>`);
                     setTimeout(() => { 
                        $(".result").slideUp(3000); 
                        location.href = "./index.php";
                    }, 2000);
                    
                }else{
                    $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
                }
            }
        });
    });
    

    // Admin Login 
    $(document).on('submit',".form-Admin-form", function(evt){
        evt.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            url:lexiApi,
            method:"post",
            data:data,
            success: (res)=>{
                if(res==1){ 
                    $(".result").html(`<p class ="alert alert-success"> One Admin Addedd </p>`);
                     setTimeout(() => { 
                        $(".result").slideUp(3000); 
                        location.reload();
                    }, 2000);
                    
                }else{
                    $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
                }
            }
        });
    });

   // Show Admin TO EDIT
   $(document).on('click',".edit", function(evt){
        evt.preventDefault();
        let adminId  = $(this).attr('id');
        console.log(adminId);
        $.ajax({
            url:lexiApi,
            method:"post",
            data:{adminId:adminId,action:'show-admin'},
            success: (res)=>{
                $(".showAdminUser").html(res);
                console.log(res);
            }
        });
    });


    // Delet ADmin User
   $(document).on('click',".delAdmin", function(evt){
        evt.preventDefault();
        let adminId  = $(this).attr('id');
        $("#adminIdToDelete").val(adminId);  // Setting the ID of the ADmin unto the Confirm Delete Modal
   });
    // Confirming the delete
    $(document).on('submit',".adminConfirmDeleteform", function(evt){
        evt.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            url:lexiApi,
            method:"post",
            data:data,
            success: (res)=>{
                if(res==1){ 
                    $(".result").html(`<p class ="alert alert-success"> Successful </p>`);
                    setTimeout(() => { 
                        $(".result").slideUp(3000); 
                        location.reload();
                    }, 2000);
                    
                }else{
                    $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
                }
            }
        });
    });




////////////////// View User Details ///////////////////////////////////////
    $(document).on('click',".viewUserDetails", function(evt){
        evt.preventDefault();
        let userId  = $(this).attr('id');
        console.log(userId)
        $.ajax({
            url:lexiApi,
            method:"post",
            data:{action:"viewUserDetails",uid:userId},
            success: (res)=>{
                $(".userViewMoreDetails").html(res); 
                //console.log(res)
            }
        });
   });
 /////////////////////////////////////////////////////////////////////////////   


//////////////////// View Name Details//////////////////////////////////////////////
    $(document).on('click',".viewName", function(evt){
        evt.preventDefault();
        let userId  = $(this).attr('id');
        console.log(userId)
        $.ajax({
            url:lexiApi,
            method:"post",
            data:{action:"viewName",namesId:userId},
            success: (res)=>{
                $(".nameInfo").html(res); 
            // console.log(res)
            }
        });
    });

/////---==============//////////===========-----------==========//
// Assigning Lexipoints   :: npart  memId  namesId
let totalLexipoint = [];
$(document).on('click',".approveLexipoint", function(evt){
    evt.preventDefault();
    let $this      = $(this);
    let namesId    = $(this).attr('id');
    let addedById  = $(this).attr('data-id'); 
    let npart      = $(this).attr('name');   
    let LP         = $(this).attr('data-lxpoint'); 
    $this.html('<i class="fa fa-spinner fa-spin"></i>');
    $(".result_name").html('<i class="fa fa-spinner fa-spin"></i>');
    $.ajax({
        url:lexiApi,
        method:"post",
        data:{action:'approveName',npart:npart,memId:addedById,namesId:namesId},
        success: (res)=>{
            if(res==1 || res==11){ 
                $(".result_name").html(`<p class ="alert alert-success">Successful awarded lexi point(s)</p>`); 
                totalLexipoint.push(parseFloat(LP));
                sumLexiPointsEarned(totalLexipoint);
                $this.hide(1000);
            }else{
                $(".result_name").html(`<p class ="alert alert-danger">${res}</p>`);
            }
        }
    });
});

// calculate lexipoit on the fly
function sumLexiPointsEarned(arr){
    let totalLexi = arr.reduce((a,b)=>a+b,0);
    $(".lexiPointOutput").text(totalLexi);
}
//  <end/> Calculate lexipoint on the fly


// Approving All names properties
$(document).on('click',".approveAll", function(evt){
    evt.preventDefault();
    let $this      = $(this);
    let namesId    = $(this).attr('id');
    let addedById  = $(this).attr('data-id'); 
    let npart      = $(this).attr('name'); 
    $this.html('<i class="fa fa-spinner fa-spin"></i>');
    $(".result_name").html('<i class="fa fa-spinner fa-spin"></i>');
    $.ajax({
        url:lexiApi,
        method:"post",
        data:{action:'approveName',npart:npart,memId:addedById,namesId:namesId},
        success: (res)=>{
            if(res==1 || res==11){ 
                $(".result_name").html(`<p class ="alert alert-success">Successful awarded lexi point(s)</p>`);
                // setTimeout(() => { $(".result_name").slideUp(3000); }, 2000);
                $this.hide();
            }else{
                $(".result_name").html(`<p class ="alert alert-danger">${res}</p>`);
            }
        }
    });
});

// Mark name as approved --> When creding user with LEXIPOINTS
$(document).on("click",'.apprName',function() {
        let $this   = $(this);
        let namesId    = $(this).attr('id'); 
    $this.html('<i class="fa fa-spinner fa-spin"></i>');
    if(confirm("Are you sure you want to mark this name as approved ?")){
        $(".result_name").html('...approving name <i class="fa fa-spinner fa-spin"></i>'); 
            $.ajax({
                url:lexiApi,
                method:"post",
                data:{action:'approve',namesId:namesId},
                success: (res)=>{
                    if(res==1){ 
                        $(".result_name").html(`<p class ="alert alert-success">Successful approved name</p>`);
                        $this.hide(1000);
                        setTimeout(function(){ location.reload();},2000);
                    }else{
                        $(".result_name").html(`<p class ="alert alert-danger">${res}</p>`);
                    }
                }
            });
        }  
});
 


// Flag Name as waiting 
$(document).on("click",'.flagNameWaiting',function() {
    let $this   = $(this);
    let namesId    = $(this).attr('id'); 
    let addedById  = $(this).attr('data-id'); 
    $this.html('<i class="fa fa-spinner fa-spin"></i>');
    if(confirm("Are you sure you want to add this name to waiting list ?")){
        $(".result_name").html('...please wait<i class="fa fa-spinner fa-spin"></i>'); 
            $.ajax({
                url:lexiApi,
                method:"post",
                data:{action:'flagName',nId:namesId,memId:addedById},
                success: (res)=>{
                    if(res==1){ 
                        $(".result_name").html(`<p class ="alert alert-success">Successful added name to waiting list</p>`);
                        $this.hide(1000);
                        setTimeout(function(){ location.reload();},2000);
                    }else{
                        $(".result_name").html(`<p class ="alert alert-danger">${res}</p>`);
                    }
                }
            });
        }  
});


//////////=============//////////////////////////////////////////////////////////




// //////////////////////////////////  View Name details ////////////////////////////////
$(document).on('click',".approveName", function(evt){
    evt.preventDefault();
    let namesId = $(this).attr('id');
    if(namesId){
        $.ajax({
            url:lexiApi,
            method:"post",
            beforeSend:function(){
                $('.approveName').attr('disabled', 'disabled');
                $('#progress').css('display', 'block');
            },
            data:{action:"approve",namesId:namesId},
            success: (res)=>{
                var percentage = 0;
                var timer     = setInterval(function(){  
                percentage    = percentage + 20; 
                $('.progress-bar').css('width', percentage + '%');
                if(percentage > 100) {
                 clearInterval(timer);
                 $('#process').css('display', 'none');
                 $('.progress-bar').css('width', '0%');
                 $('.approveName').attr('disabled', "");
                       if(res==1){ 
                           $(".result").html(`<p class ="alert alert-success"> Name Successfully Approved! </p>`);
                           setTimeout(() => {   $(".result").slideUp(3000); location.reload(); }, 2000);                 
                       }else{
                           $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
                       }
                   }
               }, 1000);   
            }
        });
    }
});

//////////////////////////////////////////////////////////////////////////////////




///==========///////////////////////////////////////////////////////////////////
    // approve all at once
    // $(document).on('click',".approveAll", function(evt){
    //     evt.preventDefault();
    //     let namesId    = $(this).attr('id');
    //     let addedById  = $(this).attr('data-id');  
    //     let npart      = $(this).attr('name'); 
    //     // $.ajax({
    //     //     url:lexiApi,
    //     //     method:"post",
    //     //     data:data,
    //     //     success: (res)=>{
    //     //         if(res==1){ 
                    
    //     //         }else{
    //     //             $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
    //     //         }
    //     //     }
    //     // });
    // }); 
//////////////////////////////////////////////////////////////////////////////


////////////////////////////////////////// Block User ///////////////////////
$(document).on('click',".blockUser", function(evt){
    evt.preventDefault();
    let userId  = $(this).attr('id');
      if(userId){
            if(confirm("Are you sure you want to block this user ?")){
                $.ajax({
                    url:lexiApi,
                    method:"post",
                    data:{action:"blockUser",uid:userId},
                    success: (res)=>{
                         if(res==1){
                            $(".result").html('<p class ="alert alert-danger"> successfully blocked this user </p>');
                            setTimeout(function(){ location.reload();},3000);
                         }else{
                            alert(res);
                         }
                    }
                });
            }
      }

});
//////////////////////////////////////////////////////////////////////////////////////////


// Unblock User
$(document).on('click',".unblockUser", function(evt){
    evt.preventDefault();
    let userId  = $(this).attr('id');
      if(userId){
            if(confirm("Are you sure you want to block this user ?")){
                $.ajax({
                    url:lexiApi,
                    method:"post",
                    data:{action:"unblockUser",uid:userId},
                    success: (res)=>{
                         if(res==1){
                             $(".result").html('<p class ="alert alert-success"> successfully Unblocked this user </p>');
                            setTimeout(function(){ location.reload();},3000);
                         }else{
                            alert(res);
                         }
                    }
                });
            }
      }

});
 //   

    
    // Choose wether to change password aalong side or NOT
    $(document).on("change",'#myswitch',function() {
        if ($(this).is(':checked')) {
              $(".paswordSection").show();
        }else{
            $(".paswordSection").hide();
        } 
     });
    

    // Updating an Admin User Info  
    $(document).on('submit',".form-Edit-amdin", function(evt){
        evt.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            url:lexiApi,
            method:"post",
            data:data,
            success: (res)=>{
                if(res==1){ 
                    $(".result").html(`<p class ="alert alert-success"> Successful </p>`);
                     setTimeout(() => { 
                        $(".result").slideUp(3000); 
                        location.reload();
                    }, 2000);
                    
                }else{
                    $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
                }
            }
        });
    });


// Adding New Name
    $(document).on('submit',"#addNameForm", function(evt){
        evt.preventDefault();
        let data = $(this).serialize();
        $(".result").html("please wait...");
        $.ajax({
            url:lexiApi,
            method:"post",
            data:data,
            beforeSend:function(){
                $('.subBtnName').attr('disabled', 'disabled');
                $('#progress').css('display', 'block');
            },
            success: (res)=>{
                var percentage = 0;

                var timer = setInterval(function(){  percentage = percentage + 20;  progress_bar_process(percentage, timer,res); }, 1000);
                
            }
        });
    });


////////////////////////////////// USED TO SHOW PROGRESS BAR /////////////////////////////////////////////
    function progress_bar_process(percentage, timer,res) {
     $('.progress-bar').css('width', percentage + '%');
     if(percentage > 100) {
      clearInterval(timer);
      $('#process').css('display', 'none');
      $('.progress-bar').css('width', '0%');
      $('.subBtnName').attr('disabled', "");
            if(res==1){ 
                $(".result").html(`<p class ="alert alert-success"> Successfully Added </p>`);
                setTimeout(() => {   $(".result").slideUp(3000); location.reload(); }, 2000);                 
            }else{
                $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
            }
        }
    }
// //////////////////////////////////////////////////////////////////////////////////////



    $(document).on('submit',"#profileForm", function(evt){
        evt.preventDefault();
		let data = new FormData($(this)[0]);
        $.ajax({
            url:lexiApi,
            method:"post",
            data:data,
            contentType: false,
            processData: false,
            success: (res)=>{
                if(res==1){ 
                    $(".result").html(`<p class ="alert alert-success">Successfully Updated </p>`);
                     setTimeout(() => { 
                        $(".result").slideUp(2000); 
                        location.reload();
                    }, 2000);
                    
                }else{
                    $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
                }
            }
        });
    });
////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////
    $(document).on('submit',"#settingsForm", function(evt){
        evt.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            url:lexiApi,
            method:"post",
            data:data,
            success: (res)=>{
                if(res==1){ 
                    $(".result_paswd").html(`<p class ="alert alert-success"> Update Successful </p>`);
                     setTimeout(() => { 
                           $(".result_paswd").slideUp(3000); 
                           location.assign("?pg=logout");
                    }, 2000);
                    
                }else{
                    $(".result_paswd").html(`<p class ="alert alert-danger">${res}</p>`);
                }
            }
        });
    });
////////////////////////////////////////////////////////////////////////////////////////////


// Delete added name 
$(document).on('click',".deleteName", function(evt){
    evt.preventDefault();
    let namesId = $(this).attr('id');
    if(namesId){
       if(confirm("Are you sure you want to delete this names")){
        $.ajax({
            url:lexiApi,
            method:"post",
            data:{action:"delName",namesId:namesId},
            success: (res)=>{
                if(res==1){
                    alert("Successfully Deleted Name");
                    location.reload();
                }else{
                    alert(res);
                }
            }
        });
       }
    }
});

 
// Update/Edit name
$(document).on('submit',"#editNameForm", function(evt){
    evt.preventDefault();
    let data = $(this).serialize();
    $.ajax({
        url:lexiApi,
        method:"post",
        data:data,
        success: (res)=>{
            if(res==1){ 
                $(".result").html(`<p class ="alert alert-success"> Update Successful! </p>`);
                 setTimeout(() => { 
                       $(".result").slideUp(3000); 
                       history.go(-1);
                }, 2000);
                
            }else{
                $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
            }
        }
    });
});
// 


});