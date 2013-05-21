$(document).ready(function() {

	function getfotos() {
		$.getJSON("/admin/fotos-show", function(j){
			var options = '';
			for (var i = 0; i < j.length; i++) {
				console.log(j[i]);
				options += '<tr>' 
							+ '<td><a target="_blank" href="/img/parceiros/' + j[i].url + '"> <img src="/img/parceiros/150px/' + j[i].url + '"/> </a></td>'
							+ '<td><span class="foto_del" rel="' + j[i].id + '" style="cursor: pointer;"><img src="/img/bullet_delete.png" /></span></td>' 
						+ '</tr>';
				console.log('---------------');
				console.log(options);
						   
			}
			$("#table_fotos tbody").html(options);
		})
	}

	
	$(document).on("click", ".foto_del", function(){ 
		var id_foto = $(this).attr('rel');
        $.post('/admin/fotos-del',{ foto: id_foto },function(r){
            if(r.status == "ok"){
            	getfotos();
            }else{
            	console.log(r);
            }
        },'json');
	})
	



	
	// en/disable submit button
    var disableSubmit = function(val){
        $('#form_fotos_parceiro input[type=submit]').attr('disabled', val);
    };
	
	(function() {
	    
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
		   
		$('#form_fotos_parceiro').ajaxForm({
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
	            if(r.status == "ok"){
	            	$('#form_fotos_parceiro')[0].reset();
	            	getfotos();
	            }
	        }
		}); 

		})();  

});