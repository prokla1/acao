	$(document).ready(function() {
		
		var esconde = true;
		$("#form_login").mouseover(function(){	
			esconde = false;
		});
		$("#form_login").mouseout(function(){
			esconde = true;
		});
		
		
		$('ul li a.login').click(function(event){
			event.preventDefault();
			esconde = false;
			$(".msg_error").empty();
			$("#form_login").show();
			console.log('clicou no ul li.login');
		});
		
		$("body").click(function() {
			if(esconde){
				$("#form_login").hide();
				$(".msg_error").hide().empty();
			}    
		});
		
		
        $('#form_login_ajax').submit(function() {
        	$('.msg_error').show().html("Processando...");
        	ValidateAjax.doValidate();
            return false;
        });
	});
	
	


	ValidateAjax = {
		    doValidate: function(){
		        $.post('/usuario/validateform',{ email: $('input[name="e"]').val(), senha: $('input[name="s"]').val() },function(response){
		            if(response.status == "sucesso"){
		            	$('.msg_error').show().html("Logado");
		            	$("#form_login").hide();
		            	$("#navigation_wrap").html(response.navigation);
		            }else{
		            	$('.msg_error').show().html("Falha no login! Preencha corretamente.");
		            }
		        },'json');
		    }
		};

	
	
	
	
	
