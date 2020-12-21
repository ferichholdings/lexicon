$(document).ready(function(){

    let lexiApi = "http://localhost/lexicon/api/userCtrl.php";
    // Registration
    $(document).on('submit',".form-register", function(evt){
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
                        location.href = "./login.html";
                    }, 2000);
                    
                }else{
                    $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
                }
            }
        });
    });
    
    // Login
    $(document).on('submit',".form-signin", function(evt){
        evt.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            url:lexiApi,
            method:"post",
            data:data,
            success: (res)=>{
                if(res==1){ 
                    $(".result").html(`<p class ="alert alert-success">Successfully LoggedIn </p>`);
                     setTimeout(() => { 
                        $(".result").slideUp(3000); 
                        location.href = "./user/";
                    }, 2000);
                    
                }else{
                    $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
                }
            }
        });
    });

    // Contact Us  
    $(document).on('submit',"#contactForm", function(evt){
        evt.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            url:lexiApi,
            method:"post",
            data:data,
            beforeSend:()=>{
                $(".result_contact").html(`<div class ="alert"> <i class ="fa fa-spinner fa-spin"></i> </div>`);
            },
            success: (res)=>{
                if(res==1){ 
                    $(".result_contact").html(`<div class ="alert-success"> Thanks for contacting us. We will get back to you in a hort while.</div>`);
                     setTimeout(() => { 
                        $(".result_contact").slideUp(3000); 
                        location.reload();
                    }, 3000);
                    
                }else{
                    $(".result_contact").html(`<div class ="alert-danger">${res}</div>`);
                }
            }
        });
    });




});