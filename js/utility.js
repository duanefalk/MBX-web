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
	
	
	//Search Models: Duplicate images display
	var moreThanOne = haveDuplicateImages();
	if (moreThanOne == true) {
		$('body.search_models #duplicateImages').css('opacity','1');
	} else {}
	
});

//Search Models: Duplicate images display function
function haveDuplicateImages() {
	var hasDupe = false;
	var imgArr = [];
	
	$("li.carGrid img").each(function(){
		if ($.inArray($(this).attr("src"),imgArr) > -1){
			//$(this).css("border","3px solid green");
			hasDupe = true;
		} else {
			imgArr.push($(this).attr("src"));   
		}
	});
	
	return hasDupe;
}