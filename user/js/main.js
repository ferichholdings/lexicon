(function($) {

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

//  setInterval(function(){
	 //let st = document.readyState; 
	 //console.log(st);
//  },1000);
 //  imagePreview
 function readURL(input) {
	if (input.files && input.files[0]) {
	  var reader    = new FileReader();
	  reader.onload = function(e) { $('#imagePreview').attr('src', e.target.result);  }	  
	  reader.readAsDataURL(input.files[0]); // convert to base64 string
	}
  }
  
  $("#profilePix").change(function() { readURL(this); });

})(jQuery);
