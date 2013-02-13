$(document).ready(function() {
	
	
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