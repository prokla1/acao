$(document).ready(function() {

	function getestados() {
		$.getJSON("/settings/estados-show", function(j){
			var options = '';
			for (var i = 0; i < j.length; i++) {
				options += '<tr>' 
							+ '<td>' + j[i].pais.nome + ' </td>' 
							+ '<td>' + j[i].nome + ' (' + j[i].sigla + ')</td>' 
							//+ '<td>' + j[i].ativo + ' </td>' 
							+ '<td><span class="estado_del" rel="' + j[i].id + '" style="cursor: pointer;"><img src="/img/bullet_delete.png" /></span></td>' 
						+ '</tr>';
			}
			$("#table_estados tbody").html(options);
		});
	}

	
	$(document).on("click", ".estado_del", function(){ 
		var id_estado = $(this).attr('rel');
        $.post('/settings/estados-del',{ estado: id_estado },function(r){
            if(r.status == "ok"){
            	getestados();
            }else{
            	console.log(r);
            }
        },'json');
	})
	

	
	// en/disable submit button
    var disableSubmit = function(val){
        $('#form_estados input[type=submit]').attr('disabled', val);
    };
	
	(function() {
	    
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
		   
		$('#form_estados').ajaxForm({
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
	            getestados();
	            $('#form_estados')[0].reset();
	        }
		}); 

		})();  

});