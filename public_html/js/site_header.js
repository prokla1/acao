$(document).ready(function() {
	scroll();
});



function scroll(){
    $('html, body').animate({
        scrollTop: $(".site_menu").offset().top
    }, 800);
}