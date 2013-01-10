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
 
