
//JavaScript Document


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

//EXIBE INGRESSOS

$(document).ready(function(){
	$('.evento_promotions').hide();

$('.evento_description_button_promotions').click(function(){
	var id_evento = $(this).attr('id');
	idTemp = id_evento.split("btnbonus_");
	id_evento = idTemp[1];
	$("#showpromo_"+id_evento).slideToggle("slow");
});

$('#ocultar_filtro').click(function(event){
	event.preventDefault();
	$(".ct_desc_event").hide("slow");
	});


//JavaScript Document

//EXIBE DETALHES EVENTO

	$('.ct_desc_event').hide();

$('.evento_description_button_details').click(function(event){
	event.preventDefault();
	var id_evento = $(this).attr('id');
	idTemp = id_evento.split("btndetails_");
	id_evento = idTemp[1];
	$("#show_"+id_evento).slideToggle("slow");
});

$('#ocultar_filtro').click(function(event){
	event.preventDefault();
	$(".ct_desc_event").hide("slow");
	});
});
