$(document).ready(function(){
	
	$(".cortesia_euquero").click(function(){
		var id = $(this).attr('id');
		idTemp = id.split("cortesia_");
		id_cortesia = idTemp[1];
		
		
		


		// Dialog  CONVERTER  =======================
		
		$('#dialog_cortesia').dialog({
			modal: true,
			autoOpen: false,
			height: 300,
			title: "Adquirir ingresso",
			buttons: { "Ok": function() {
				$(this).dialog("close");
				}}
		});
		$('#dialog_cortesia').dialog('open'); 
		
		
		
	});
});


//JavaScript Document

//EXIBE INGRESSOS

$(document).ready(function(){
$('.ct_promo_event').hide();

$('.show_details_bonus').click(function(event){
event.preventDefault();
var id_evento = $(this).attr('id');
	idTemp = id_evento.split("btnbonus_");
	id_evento = idTemp[1];
$("#showpromo_"+id_evento).toggle("slow");
});

$('#ocultar_filtro').click(function(event){
event.preventDefault();
$(".ct_desc_event").hide("slow");
});
});
