$(document).ready(function() {
	
	

	$("select#id_estado").change(function(){
		$("#id_cidade").html('<option value="0">Carregando...</option>');
		$.getJSON("/sources/get-cidades",{id_estado: $(this).val()}, function(j){
			var options = '';
			options += '<option value="0">Selecione a cidade</option>';
			for (var i = 0; i < j.length; i++) {
				options += '<option value="' + j[i].id + '" label="' + j[i].nome + '">' + j[i].nome + '</option>';
			}
			$("#id_cidade").html(options);
			$('#id_cidade option:first').attr('selected', 'selected');
		});
	});
	

	

	$("select#id_cidade").change(function(){
		$("#id_endereco").html('<option value="0">Carregando...</option>');
		$.getJSON("/sources/get-enderecos",{id_cidade: $(this).val()}, function(j){
			var options = '';
			options += '<option value="0">Selecione o endereço</option>';
			for (var i = 0; i < j.length; i++) {
				options += '<option value="' + j[i].id + '" label="' + j[i].rua + ', ' + j[i].numero + ' ' + j[i].complemento + '">' + j[i].rua + ', ' + j[i].numero + ' ' + j[i].complemento + '</option>';
			}
			$("#id_endereco").html(options);
			$('#id_endereco option:first').attr('selected', 'selected');
		});
	});
	


	
	
	

	function getparceiros() {
		$.getJSON("/settings/parceiros-show", function(j){
			var options = '';
			for (var i = 0; i < j.length; i++) {
				options += '<tr>' 
							+ '<td>' + j[i].nome + ' </td>' 
							+ '<td>' + j[i].cidade_nome + '</td>' 
							+ '<td>' + j[i].estado_nome + '</td>' 
							+ '<td>' + j[i].pais_nome + '</td>' 
							//+ '<td>' + j[i].ativo + ' </td>' 
							+ '<td><span class="parceiro_del" rel="' + j[i].id + '" style="cursor: pointer;"><img src="/img/bullet_delete.png" /></span></td>' 
						+ '</tr>';
			}
			$("#table_parceiros tbody").html(options);
		});
	}

	
	
	$(document).on("click", ".parceiro_del", function(){ 
		var id_parceiro = $(this).attr('rel');
        $.post('/settings/parceiros-del',{ parceiro: id_parceiro },function(r){
            if(r.status == "ok"){
            	getparceiros();
            }else{
            	console.log(r);
            }
        },'json');
	})
	

	
	// en/disable submit button
    var disableSubmit = function(val){
        $('#form_parceiros input[type=submit]').attr('disabled', val);
    };
	
	(function() {
	    
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
		   
		$('#form_parceiros').ajaxForm({
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
			complete: function(xhr) {
				disableSubmit(false);
			},
			success: function(r){
	            status.html(r.msg);
	            disableSubmit(false);
	            getparceiros();
	            $('#form_parceiros')[0].reset();
	        }
		}); 

		})();  

});