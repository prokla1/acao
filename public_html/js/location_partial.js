$(document).ready(function(){
	scroll();

	$('.location_content a').click(function(event){
		event.preventDefault();
		$(".ajax_content_localidade").slideToggle("slow");
		scroll();

	});    
});

function scroll(){
    $('html, body').animate({
        scrollTop: $(".location").offset().top
    }, 400);
}