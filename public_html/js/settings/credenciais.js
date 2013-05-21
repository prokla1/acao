$(document).ready(function() {

	function getCredenciais() {
		$.getJSON("/settings/credenciais-show", function(j){
			var options = '';
			for (var i = 0; i < j.length; i++) {
				options += '<tr>' 
							+ '<td>' + j[i].parceiro_nome + ' (<a target="_blank" href="/' + j[i].parceiro_url + '">/' + j[i].parceiro_url + '</a>)</td>' 
							+ '<td>' + j[i].usuario_nome + ' (' + j[i].usuario_email + ')</td>' 
							+ '<td><span class="credencial_del" rel="' + j[i].id + '" style="cursor: pointer;"><img src="/img/bullet_delete.png" /></span></td>' 
						+ '</tr>';
			}
			$("#table_credenciais tbody").html(options);
		});
	}

	
	$(document).on("click", ".credencial_del", function(){ 
		var id_credencial = $(this).attr('rel');
        $.post('/settings/credenciais-del',{ credencial: id_credencial },function(r){
            if(r.status == "ok"){
            	getCredenciais();
            }else{
            	console.log(r);
            }
        },'json');
	})
	

	
	// en/disable submit button
    var disableSubmit = function(val){
        $('#form_credenciais input[type=submit]').attr('disabled', val);
    };
	
	(function() {
	    
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
		   
		$('#form_credenciais').ajaxForm({
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
	            getCredenciais();
	        }
		}); 

		})();  

});