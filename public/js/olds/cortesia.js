$(document).ready(function(){
	
	$(".cortesia_euquero").click(function(){
		var id = $(this).attr('id');
		idTemp = id.split("cortesia_");
		id_cortesia = idTemp[1];
		
		converter(id_cortesia);

	});
	
	

});
 


function converter(id_cortesia){
	

	// Dialog  CONVERTER  =======================
	
	$('#dialog_cortesia').html('Carregando...')
	.dialog({
		resizable: true,
		position: ['center', 'center'],
		modal: true,
		autoOpen: true, //já é criado aberto
		width: 'auto',
		title: "Adquirir ingresso"
	});
	
	 
	$.ajax({
		url: "/conversao", 
		type: "POST", 
		contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
		data: { id_cortesia: id_cortesia },
		success: function (r) {
			$("#dialog_cortesia").html(r);

		}
	});		


}




