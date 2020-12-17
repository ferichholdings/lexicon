
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
            beforeSend:function(){
                $('.deleteName').attr('disabled', 'disabled');
                $('#progress').css('display', 'block');
            },
            data:{action:"delName",namesId:namesId},
            success: (res)=>{
                var percentage = 0;
                var timer     = setInterval(function(){  
                percentage    = percentage + 25; 
                $('.progress-bar').css('width', percentage + '%');
                if(percentage >= 100) {
                        clearInterval(timer);
                        $('#process, .progress').hide();
                        $('.progress-bar').css('width', '0%');
                        $('.deleteName').attr('disabled', "");
                       if(res==1){ 
                           $(".result").html(`<p class ="alert alert-success alert-dismissible fade show"> Name Successfully Deleted!   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="false">×</span>
                                </button></p>`);
                           setTimeout(() => {   $(".result").slideUp(3000); location.reload(); }, 2000);                 
                       }else{
                           $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
                           setTimeout(() => {   $(".result").slideUp(3000);}, 2000);  
                       }
                   }
               }, 1000); 
 
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
                       location.href ="?pg=viewNames";
                }, 2000);
                
            }else{
                $(".result").html(`<p class ="alert alert-danger">${res}</p>`);
            }
        }
    });
});
//  



///////////////////////// SEND MESSAGE //////////////////////////////////
//  Replying message
let $doc = $(document);
$doc.on('click', ".sendMsg", function(evt){
    evt.preventDefault(); 
    $doc.on("submit","#sendMessageForm", function(evt){
        evt.preventDefault();
        let data = $("#sendMessageForm").serialize();
        $(".result_msg").html('<i class="fa fa-spinner fa-spin fa-3x"></i> Sending...');
        $.ajax({
            url:lexiApi,
            method:"post",
            data:data,
            success: (res)=>{
                if(res==1){
                    $(".result_msg").html('<p class ="alert alert-success"> Message Sent! </p>');
                    setTimeout(function(){ $(".result_msg").slideUp(2000); $("#sendMessageForm").trigger('reset'); location.reload(); },1000);
                }else{
                    $(".result_msg").html('<p class ="alert alert-danger">'+res+'</p>');
                }
            }
        });
    });
});
///////////////////////// SEND MESSAGE </end>//////////////////////////////////


    
});