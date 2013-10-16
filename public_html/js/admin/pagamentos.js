$(document).ready(function() {

	function getpagamentos() {
		$.getJSON("/admin/pagamentos-show", function(j){
			var options = '';
			for (var i = 0; i < j.length; i++) {
				console.log(j[i]);
				options += '<tr>' 
							+ '<td><img src="/img/pgto/' + j[i].pagamento_imagem + '" /></td>'
							+ '<td>' + j[i].pagamento_nome + '</td>' 
							+ '<td><span class="pagamento_del" rel="' + j[i].id + '" style="cursor: pointer;"><img src="/img/bullet_delete.png" /></span></td>' 
						+ '</tr>';
				console.log('---------------');
				console.log(options);
						   
			}
			$("#table_pagamentos tbody").html(options);
		})
	}
	
	
	$(document).on("click", ".pagamento_del", function(){ 
		var id_pagamento = $(this).attr('rel');
        $.post('/admin/pagamentos-del',{ pagamento: id_pagamento },function(r){
            if(r.status == "ok"){
            	getpagamentos();
            }else{
            	console.log(r);
            }
        },'json');
	})
	



	
	// en/disable submit button
    var disableSubmit = function(val){
        $('#form_pagamentos input[type=submit]').attr('disabled', val);
    };
	
	(function() {
	    
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
		   
		$('#form_pagamentos').ajaxForm({
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
	            status.html(r.msg);
	            disableSubmit(false);
	            getpagamentos();
	            if(r.status == "ok"){
	            	$('#form_pagamentos')[0].reset();
	            }
	        }
		}); 

		})();  

});