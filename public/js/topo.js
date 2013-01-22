	$(document).ready(function() {
		$('ul.navigation #menu-login_link').click(function(event){
			event.preventDefault();
			console.log('entrar');
			$("#div_form_ajax").toggle();
		});
		
		
        $('#form_login').submit(function() {
        	$('#div_msg_error_login').html("Processando...");
        	ValidateAjax.doValidate();
            return false;
        });
	});
	
	


	ValidateAjax = {
		    doValidate: function(){
		        $.post('/usuario/validateform',$('#form_login').serialize(),function(response){
		            if(response.status == "sucesso"){
		            	$('#div_msg_error_login').html("Logado");
		            	$("#div_form_ajax").toggle();
		            	$("#content_top_menus").html(response.navigation);
		            }else{
		            	$('#div_msg_error_login').html("Falha no login! Preencha corretamente.");
		            }
		        },'json');
		    }
		};
