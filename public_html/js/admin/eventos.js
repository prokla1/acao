$(document).ready(function() {
	
    $( "#from" ).datepicker({
        //defaultDate: "+1w",
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
      

	function getEventos() {
		$.getJSON("/admin/eventos-show", function(j){
			var options = '';
			for (var i = 0; i < j.length; i++) {
				console.log(j[i]);
				options += '<tr>' 
							+ '<td>' + j[i].atividade_nome + '</td>' 
							+ '<td><span class="atividade_del" rel="' + j[i].id + '" style="cursor: pointer;"><img src="/img/bullet_delete.png" /></span></td>' 
						+ '</tr>';
				console.log('---------------');
				console.log(options);
						   
			}
			$("#table_atividades tbody").html(options);
		});
	}
	
	$(document).on("click", ".eventos_del", function(){ 
		var id_evento = $(this).attr('rel');
        $.post('/admin/eventos-del',{ evento: id_evento },function(r){
            if(r.status == "ok"){
            	getEventos();
            }else{
            	console.log(r);
            }
        },'json');
	});
	



	
	// en/disable submit button
    var disableSubmit = function(val){
        $('#form_eventos_data input[type=submit]').attr('disabled', val);
    };
	
	(function() {
	    
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
		   
		$('#form_eventos_data').ajaxForm({
			dataType:  'json',
			beforeSubmit: function(){
	            disableSubmit(true);
	        },
		    beforeSend: function() {
		        status.empty();
		        var percentVal = '0%';
		        bar.width(percentVal);
		        percent.html(percentVal);
		    },
		    uploadProgress: function(event, position, total, percentComplete) {
		        var percentVal = percentComplete + '%';
		        bar.width(percentVal);
		        percent.html(percentVal);
		    },
		    /*
			complete: function(xhr) {
				disableSubmit(false);
				var r = xhr.responseText;				
				status.html(r.imagem);
				console.log(r);
				console.log(r.imagem);
			},
			*/
			success: function(r){
	            status.html(r.msg);
	            disableSubmit(false);
	           
	            if(r.status == "ok"){
	            	 getEventos();
	            }
	        }
		}); 

		})();  

});