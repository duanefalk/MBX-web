$( document ).ready(function() {
	
	//Homepage Sliders
	$('.bxslider').bxSlider({
		mode: 'fade',
		captions: false
	});
	
	$(document).ready(function() {
		$('.imagePopup').magnificPopup({
			type:'image',
			gallery:{enabled:true}
		});
	});
	
});