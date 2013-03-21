$(document).ready(function() {

	function getenderecos() {
		$.getJSON("/settings/enderecos-show", function(j){
			var options = '';
			for (var i = 0; i < j.length; i++) {
				options += '<tr>' 
							+ '<td>' + j[i].rua + ', ' + j[i].numero + '  ' + j[i].complemento + ' </td>' 
							+ '<td>' + j[i].cidade_nome + '</td>' 
							+ '<td>' + j[i].estado_nome + '</td>' 
							+ '<td>' + j[i].pais_nome + '</td>' 
							//+ '<td>' + j[i].ativo + ' </td>' 
							+ '<td><span class="endereco_del" rel="' + j[i].id + '" style="cursor: pointer;"><img src="/img/bullet_delete.png" /></span></td>' 
						+ '</tr>';
			}
			$("#table_enderecos tbody").html(options);
		});
	}

	
	$(document).on("click", ".endereco_del", function(){ 
		var id_endereco = $(this).attr('rel');
        $.post('/settings/enderecos-del',{ endereco: id_endereco },function(r){
            if(r.status == "ok"){
            	getenderecos();
            }else{
            	console.log(r);
            }
        },'json');
	})
	

	
	// en/disable submit button
    var disableSubmit = function(val){
        $('#form_enderecos input[type=submit]').attr('disabled', val);
    };
	
	(function() {
	    
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
		   
		$('#form_enderecos').ajaxForm({
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
	            getenderecos();
	            $('#form_enderecos')[0].reset();
	        }
		}); 

		})();  

});