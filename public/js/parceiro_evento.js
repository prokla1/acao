//ZOOOOOOMMMMMM
$('.li_zoom').click(function(){
	var flyer = $(this).attr('rel');
	$('#'+flyer).dialog({
		resizable: false,
		position: ['center', 'center'],
		modal: true,
		autoOpen: true, //já é criado aberto
		width: 'auto',
		buttons: {"X": function() {
			$(this).dialog("close");
		}
}
	});
	$(".ui-dialog-titlebar").hide() ;
});



$(document).ready(function() {
	
    $(window).scroll(function (event) {
    	var window_top = $(window).scrollTop();
    	
    	var evento_content_topo = ( $(".evento_content").offset().top  - window_top );
    	var evento_content_end_topo = ( $("#evento_content_end").offset().top  - window_top );
    	var height_evento_flyer_wrapper = $(".evento_flyer_wrapper").height();
    	
        if(evento_content_topo < 20){
        	if(evento_content_end_topo > (height_evento_flyer_wrapper + 10)){
            	$('.evento_flyer_wrapper').addClass('evento_flyer_wrapper_fixed');
        	}else {
        		$('.evento_flyer_wrapper').removeClass('evento_flyer_wrapper_fixed');
        		if(evento_content_end_topo < height_evento_flyer_wrapper){
            		$('.evento_flyer_wrapper').removeClass('evento_flyer_wrapper_fixed');
            		$('.evento_flyer_wrapper').addClass('evento_flyer_wrapper_fixed_button');
        		}else{
            		$('.evento_flyer_wrapper').addClass('evento_flyer_wrapper_fixed');
            		$('.evento_flyer_wrapper').removeClass('evento_flyer_wrapper_fixed_button');
        		}
			}
        }else {
    		$('.evento_flyer_wrapper').removeClass('evento_flyer_wrapper_fixed');
    		$('.evento_flyer_wrapper').removeClass('evento_flyer_wrapper_fixed_button');
		}

    });
    
});

