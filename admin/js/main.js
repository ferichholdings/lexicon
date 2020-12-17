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



// Activate tooltip
$('[data-toggle="tooltip"]').tooltip();
	
// Select/Deselect checkboxes
var checkbox = $('table tbody input[type="checkbox"]');
$("#selectAll").click(function(){
	if(this.checked){
		checkbox.each(function(){
			this.checked = true;                        
		});
	} else{
		checkbox.each(function(){
			this.checked = false;                        
		});
	} 
});
checkbox.click(function(){
	if(!this.checked){
		$("#selectAll").prop("checked", false);
	}
});


})(jQuery);
