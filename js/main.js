$(document).ready(function(){ 

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

 
 function readURL(input) {
	if (input.files && input.files[0]) {
	  var reader    = new FileReader();
	  reader.onload = function(e) { $('#imagePreview').attr('src', e.target.result);  }	  
	  reader.readAsDataURL(input.files[0]); // convert to base64 string
	}
  }
  
  $("#profilePix").change(function() { readURL(this); });

    //   For Products Menu and Settings
	  let product_menu      = $(".product_menu");
	  let settings_menu     = $(".settings_menu"); 
		$(document).on('click',".show_product_menu", function(evt){
			evt.preventDefault();
			product_menu.toggleClass("off");  
		});
		$(document).on('click',".settings", function(evt){
			evt.preventDefault(); 
			settings_menu.toggleClass("off");
		});


}) ;

