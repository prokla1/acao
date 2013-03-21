$(document).ready(function() {

	function getcidades() {
		$.getJSON("/settings/cidades-show", function(j){
			var options = '';
			for (var i = 0; i < j.length; i++) {
				options += '<tr>' 
							+ '<td>' + j[i].nome + ' </td>' 
							+ '<td>' + j[i].estado.nome + ' (' + j[i].estado.sigla + ')</td>' 
							+ '<td>' + j[i].estado.pais.nome + ' (' + j[i].estado.pais.sigla + ')</td>' 
							//+ '<td>' + j[i].ativo + ' </td>' 
							+ '<td><span class="cidade_del" rel="' + j[i].id + '" style="cursor: pointer;"><img src="/img/bullet_delete.png" /></span></td>' 
						+ '</tr>';
			}
			$("#table_cidades tbody").html(options);
		});
	}



	
	$(document).on("click", ".cidade_del", function(){ 
		var id_cidade = $(this).attr('rel');
        $.post('/settings/cidades-del',{ cidade: id_cidade },function(r){
            if(r.status == "ok"){
            	getcidades();
            }else{
            	console.log(r);
            }
        },'json');
	})
	

	
	// en/disable submit button
    var disableSubmit = function(val){
        $('#form_cidades input[type=submit]').attr('disabled', val);
    };
	
	(function() {
	    
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
		   
		$('#form_cidades').ajaxForm({
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
	            getcidades();
	        }
		}); 

		})();  

});