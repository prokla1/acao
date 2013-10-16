$(document).ready(function() {
	
	// en/disable submit button
    var disableSubmit = function(val){
        $('#form_imagem_parceiro input[type=submit]').attr('disabled', val);
    };
	
	(function() {
	    
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
		   
		$('#form_imagem_parceiro').ajaxForm({
			dataType:  'json',
			beforeSubmit: function(){
	            disableSubmit(true);
	        },
		    beforeSend: function() {
		        status.empty();
		        var percentVal = '0%';
		        bar.width(percentVal)
		        percent.html(percentVal);
		    },
		    uploadProgress: function(event, position, total, percentComplete) {
		        var percentVal = percentComplete + '%';
		        bar.width(percentVal)
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
	            if(r.status == 'ok'){
					status.html(r.msg);
					status.append('<br /><img src="/img/parceiros/'+r.url+'" />');	            	
	            }else{
	            	status.html(r.msg);
	            }
	            disableSubmit(false);
	        }
		}); 

		})();  

});