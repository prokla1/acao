	$(document).ready(function() {
		
		
		

		var esconde = true;
		$("#div_form_login").mouseenter(function(){	
			esconde = false;
		});
		$("#div_form_login").mouseleave(function(){
			esconde = true;
		});

		
		$('ul li a.login').click(function(event){
			event.preventDefault();
			esconde = false;
			$(".msg_error").empty();
			$("#div_form_login").show();
			
		});

		$('#id_cidade').click(function(event){
			event.preventDefault();
			esconde = false;

		});
		$('#id_cidade').mouseenter(function(event){
			event.preventDefault();
			esconde = false;

		});
		
		$(".global").click(function() {
			if(esconde){
				$("#div_form_login").hide();
				$(".msg_error").hide().empty();
			}    
		});

		
        $('#form_login_ajax').submit(function() {
        	$('.msg_error').show().html("Processando...");
        	ValidateAjax.login();
            return false;
        });

        

        $('#submit_news').click(function() {
        	$("#loading_news_form_msg").html('Processando...');
        	ValidateAjax.news();
        });			


		

	});
	
	


	ValidateAjax = {
		    login: function(){
		        $.post('/usuario/validateform',{ email: $('input[name="e"]').val(), senha: $('input[name="s"]').val() },function(response){
		            if(response.status == "sucesso"){
		            	$('.msg_error').show().html("Logado");
		            	$("#div_form_login").hide();
		            	$("#navigation_wrap").html(response.navigation);
		            }else{
		            	$('.msg_error').show().html("Falha no login! Preencha corretamente.");
		            }
		        },'json');
		    },

		    news: function(){
		        $.post('/news/entrar',$('#form_news_add').serialize(),function(r){
		            	$("#loading_news_form").html(r);
		        });
		    }


		};

	
	
	
	
	
