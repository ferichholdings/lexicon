
$(document).ready(function(){

    const lexiApi = "http://localhost/lexicon/api/userCtrl.php";
    // Login
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

    $(document).on('submit',"#addNameForm", function(evt){
        evt.preventDefault();
        let data = $(this).serialize();
        $(".result").html("please wait...");
        $.ajax({
            url:lexiApi,
            method:"post",
            data:data,
            success: (res)=>{
                if(res==1){ 
                    $(".result").html(`<p class ="alert alert-success"> Successfully Added </p>`);

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

// Add or Update account Number
    $(document).on('submit',"#bankInfoForm", function(evt){
        evt.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            url:lexiApi,
            method:"post",
            data:data,
            success: (res)=>{
                if(res==1){ 
                    $(".result_bank").html(`<p class ="alert alert-success"> Update Successful </p>`);
                     setTimeout(() => { 
                           $(".result_bank").slideUp(3000); 
                           location.reload();
                    }, 2000);
                    
                }else{
                    $(".result_bank").html(`<p class ="alert alert-danger">${res}</p>`);
                }
            }
        });
    });



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


// View Name details 
$(document).on('click',".viewName", function(evt){
    evt.preventDefault();
    let namesId = $(this).attr('id');
    if(namesId){
        $.ajax({
            url:lexiApi,
            method:"post",
            data:{action:"viewName",namesId:namesId},
            success: (res)=>{
               setTimeout(()=>{
                $(".nameInfo").html(res);
               },3000);
            }
        });
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
                       location.reload();
                }, 2000);
                
            }else{
                $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
            }
        }
    });
});
//      
    
});