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