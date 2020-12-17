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

});