	$(document).ready(function() {
		/*
		$('div').each(function() {
			if(this.id.match('rate_')){
				$(this).load('rate-it-templatz-unlimited.php?id='+this.id.replace('rate_',''));
			}
		});
		*/
	});
	
	function addRating(div_id,rating){
	 $.ajax({
	   type: "GET",
	   url: "rate-it-templatz-unlimited.php",
	   data: "id="+div_id+"&rating="+rating,
	   success: function(data){
		 $('#rate_'+div_id).hide().html(data).fadeIn('slow');
	   }
	});
	}
	
	
	
	$('ul.star-rating li a').click(function(){
		var id_parceiro = $(this).attr('rel');
		$.ajax({
			type: "POST",
			url: "/rating",
			data: "rating="+$(this).text()+"&id="+id_parceiro,
			cache: false,
			async: false,
			success: function(result) {
				if(result.status == 'sucess'){
					
					$('#current-rating').width((result.rating * 20)+'%');
					$('#rate_'+id_parceiro).hide().fadeIn('slow');
				}else{
					alert('Erro, por favor tente novamente');
				}
				//$('#rate_'+id_parceiro).hide().html(result).fadeIn('slow');
			},
			error: function(result) {
				alert("Falha, por favor tente novamente.");
			}
		});
		
	});