function toggleChecked(status) {
	$("#id_parceiro-element input").each( function() {
		$(this).attr("checked",status);
	});
}



$('#form_parceiros').submit(function() {
	$('#estatisticas_show').html("Processando...");
	Statistics.show();
    return false;
});



Statistics = {
	    show: function(){
	        $.post('/admin/estatisticas-show',$('#form_parceiros').serialize(),function(r){
	            	$("#estatisticas_show").html(r);
	        });
	    }
	};




$(function() {
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });