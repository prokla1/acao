$(document).ready(function(){
	
	$(".cortesia_euquero").click(function(){
		var id = $(this).attr('id');
		idTemp = id.split("cortesia_");
		id_cortesia = idTemp[1];
		

		// Dialog  CONVERTER  =======================
		$('#dialog_cortesia').html('Carregando...')
		.dialog({
			modal: true,
			autoOpen: false,
			height: 300,
			title: "Adquirir ingresso",
			buttons: { "Eu quero": function() {
							
							},
						"Cancelar": function(){
							$(this).dialog("close");
						}
					}
		});
		
		$('#dialog_cortesia').dialog('open'); 
		

		$.getJSON("/conversao/test", { id_cortesia: id_cortesia }, function(data){
			console.log(data);
			
			var html = '';
	    	html = html + "<div>Deseja realmente adquirir o seguinte item?</div>";
	    	html = html + "<strong>"+ data.nome+ "</strong>";
	    	html = html + "<div>"+ data.descricao+ "</div>";
	    	 
	    	 
			$.each(data, function(key, value) {
			    	 //console.log(key + ": ->  " + value);
			    	 //html = html + key + ": ->  " + value + "<br />";


			});

			$('#dialog_cortesia').html(html);
			
			
		});	
		
		
		
	});
});
 
