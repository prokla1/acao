
//JavaScript Document

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
});


//JavaScript Document

//EXIBE DETALHES EVENTO

$(document).ready(function(){
	$('.ct_desc_event').hide();

$('.show_details_event').click(function(event){
	event.preventDefault();
	var id_evento = $(this).attr('id');
	idTemp = id_evento.split("btndetails_");
	id_evento = idTemp[1];
	$("#show_"+id_evento).toggle("slow");
});

$('#ocultar_filtro').click(function(event){
	event.preventDefault();
	$(".ct_desc_event").hide("slow");
	});
});
