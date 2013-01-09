// JavaScript Document

// EXIBE FILTRO

$(document).ready(function(){
 $('#search_adv').hide();

 $('#search').click(function(event){
 event.preventDefault();
 $("#search_adv").toggle("slow");
 });

 $('#ocultar_filtro').click(function(event){
 event.preventDefault();
 $("#search_adv").hide("slow");
 });
 });
 