$(document).ready(function(){
	scroll();

	$('.location_content a').click(function(event){
		event.preventDefault();
		$(".ajax_content_localidade").slideToggle();
		scroll();
		console.log('clicou no link 2 location_partial.js');

	});    
});

function scroll(){
    $('html, body').animate({
        scrollTop: $(".location").offset().top
    }, 200);
    
}