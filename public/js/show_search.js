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
	
	
	
	$("#date_filter_view").datepicker({
	    dateFormat: "DD, d 'de' MM, yy",
	    //setDate:defaultDate,
	    //altField: "#d",
	    //altFormat: "@",
	    onSelect : function(dateText, inst)
	    {
	        var epoch = $.datepicker.formatDate('@', $(this).datepicker('getDate')) / 1000;

	        $('#d').val(epoch);
	    },
	    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'
	        ],
	    dayNamesMin: [
	    'D','S','T','Q','Q','S','S','D'
	    ],
	    dayNamesShort: [
	    'Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'
	    ],
	    monthNames: [  'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro',
	    'Outubro','Novembro','Dezembro'
	    ],
	    monthNamesShort: [
	    'Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set',
	    'Out','Nov','Dez'
	    ],
	    nextText: 'Próximo',
	    prevText: 'Anterior'
	    });
	
});
 