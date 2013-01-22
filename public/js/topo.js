	$(document).ready(function() {
		$('ul.navigation #menu-login_link').click(function(event){
			event.preventDefault();
			$("#div_form_ajax").toggle();
		});
		
		
        $('#form_login_ajax').submit(function() {
        	$('#msg_error_login').html("Processando...");
        	ValidateAjax.doValidate();
            return false;
        });
	});
	
	


	ValidateAjax = {
		    doValidate: function(){
		        $.post('/usuario/validateform',{ email: $('input[name="e"]').val(), senha: $('input[name="s"]').val() },function(response){
		            if(response.status == "sucesso"){
		            	$('#div_msg_error_login').html("Logado");
		            	$("#div_form_ajax").toggle();
		            	$("#content_top_menus").html(response.navigation);
		            }else{
		            	$('#msg_error_login').html("Falha no login! Preencha corretamente.");
		            }
		        },'json');
		    }
		};
