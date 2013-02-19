function str_to_slug(str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();
  
  // remove accents, swap ñ for n, etc
  var from = "àáäãâèéëêìíïîòóöôùúüûñç·/_,:;";
  var to   = "aaaaaeeeeiiiioooouuuunc------";
  for (var i=0, l=from.length ; i<l ; i++) {
    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return str;
}





$(document).ready( function() {
	
	
	
	
//	CKEDITOR.replaceAll('ckeditor', {
//		// Load the German interface.
//		language: 'pt-br'
//	});
	
	
	$('.ckeditor').redactor({
		imageUpload: '/admin/upload',
		imageGetJson: '/admin/uploadjson'
	});
		
		
	
	
	
	
	

//	$("#nome").stringToSlug({
//		setEvents: 'keyup keydown blur keypress',
//		getPut: '#url_amigavel',
//		space: '-'
//	});
	
	
//	
//	$("#nome").keydown(function() {
//		$("#url_amigavel").val(str_to_slug($("#nome").val()));
//	});	
	
	if($("#realizacao").length)
	{
		$("#nome").keydown(function() {
			$("#url_amigavel").val(str_to_slug($("#nome").val()) + "-" + str_to_slug($("#realizacao").val()));
		});		
		
		$( "#realizacao" ).datepicker({
			dateFormat: "dd/mm/yy",
			numberOfMonths: 2,
			showOtherMonths: true,
			selectOtherMonths: true,
		    showAnim: 'slideDown',
		    onSelect : function(dateText, inst)
		    {
		        $("#url_amigavel").val(str_to_slug($("#nome").val()) + "-" + str_to_slug($("#realizacao").val()));
		    },
		    dayNames: [
		    'Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'
		    ],
		    dayNamesMin: [
		    'D','S','T','Q','Q','S','S','D'
		    ],
		    dayNamesShort: [
		    'Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'
		    ],
		    monthNames: [  
		    'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'
		    ],
		    monthNamesShort: [
		    'Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set',
		    'Out','Nov','Dez'
		    ],
		    nextText: 'Próximo',
		    prevText: 'Anterior'
		});
	}
	else
	{
		$("#nome").keydown(function() {
			$("#url_amigavel").val(str_to_slug($("#nome").val()));
		});			
	}


});