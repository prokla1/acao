// JavaScript Document

// EXIBE DETALHES EVENTO

$(document).ready(function(){
	$('#ct_cities').hide();
	$("#no_cities").hide();

	$('#btn_selcity').click(function(event){
		event.preventDefault();
		$("#ct_cities").toggle("slow");
});
	
$('#btn_nocity').click(function(event){
	event.preventDefault();
	$("#no_cities").toggle("slow");
	});

	
});

