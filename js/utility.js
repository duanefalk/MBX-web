$( document ).ready(function() {
	
	//Local only: show "Local Only" message
	if (window.location.href.indexOf("localhost") > -1) {
	    $('#warningLocal').css("display","block");
	}
	
	
	//Homepage Sliders
	$('.bxslider').bxSlider({
		mode: 'fade',
		captions: false
	});
	
	
	//Image Popup
	$(document).ready(function() {
		$('.imagePopup').magnificPopup({
			type:'image',
			gallery:{enabled:true}
		});
	});
	
});