$(document).ready(function() {
//	scroll();
	
	$('ul.star-rating li a').click(function(){
		var id_parceiro = $(this).attr('rel');
		
		
        $.post('/rating',{ rating:$(this).text(), id: id_parceiro },function(r){
            if(r.status == "sucess"){
            	$('#current-rating').width((r.rating * 20)+'%');
				$('#rate_'+id_parceiro).hide().fadeIn('slow');
				
				
            }else{
            	alert(r.msg);
            }

			
        },'json');
        
	});
	
	

});



function scroll(){
    $('html, body').animate({
        scrollTop: $(".parceiro_menu").offset().top
    }, 800);
}