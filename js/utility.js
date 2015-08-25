$( document ).ready(function() {
	
	// ---- LOCAL SITE WARNING ---------------------------------------- //
	if (window.location.href.indexOf("localhost") > -1 || window.location.href.indexOf("dev") > -1) {
	    $('#warningLocal').css("display","block");
	}
	
	
	// ---- HOME: BANNERS -------------------------------------------- //
	setInterval(fadeBanners, 7000); //call it every 7 seconds
	
	
	// ---- IMAGE POPUP ---------------------------------------------- //
	$(document).ready(function() {
		$('.imagePopup').magnificPopup({
			type:'image',
			gallery:{enabled:true}
		});
	});
	
	
	// ---- SEARCH MODELS: DUPLICATE IMAGES DISPLAY ------------------ //
	var moreThanOne = haveDuplicateImages();
	if (moreThanOne == true) {
		$('body.search_models #duplicateImages').css('opacity','1');
	} else {}
	
});

// ---- FUNCTIONS ---- //



// ---- HOME: BANNERS -------------------------------------------- //
function fadeBanners() {
    var visibleDiv = $('.banner:visible:first'); //find first visible div
	console.log(visibleDiv);
    
    visibleDiv.fadeOut(400, function () {  //fade out first visible div
       var allDivs = visibleDiv.parent().children(); //all divs to fade out / in
       var nextDivIndex = (allDivs.index(visibleDiv) + 1) % allDivs.length;  //index of next div that comes after visible div
       var nextdiv = allDivs.eq(nextDivIndex); //find the next visible div
       nextdiv.fadeIn(400); //fade it in
    });
};


// ---- SEARCH MODELS: DUPLICATE IMAGES DISPLAY ------------------ //
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