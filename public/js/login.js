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

	
	
	
	
	

	/**     ----------------------------------------  login with facebook ----------------------- **/
    var button;
    var userInfo;
    
    window.fbAsyncInit = function() {
        FB.init({	
	    			appId: '240996152682246', //change the appId to your appId
		            status: true, 
		            cookie: true,
		            xfbml: true,
		            oauth: true
        		});

       
       function updateButton(response) {
    	   $('#fb-auth_button').hide();
    	   $('#fb-auth_loading').show();
            
            if (response.authResponse) {
                //user is already logged in and connected
                FB.api('/me', function(info) {
                    login(response, info);
                });
                
//                button.onclick = function() {
//                    FB.logout(function(response) {
//                        logout(response);
//                    });
//                };
            } else {
                //user is not connected to your app or logged out
                    FB.login(function(response) {
                        if (response.authResponse) {
                            FB.api('/me', function(info) {
                                login(response, info);
                            });	   
                        } else {
                            //user cancelled login or did not grant authorization
                        	alert('Não foi possível conectrar através do Facebook');
    		            	$('#fb-auth-loading').hide();
    		            	$('#fb-auth-button').show();
                        }
                    }, {scope:'email,user_birthday,publish_stream'}); //{scope:'email,user_birthday,status_update,publish_stream,user_about_me'});  	
            }
        }
        
        // run once with current status and whenever the status changes
       $('#fb-auth').click(function(){
    	   console.log('clicou');
    	   $('#fb-auth-button').hide();
    	   $('#fb-auth-loading').show();
	       	FB.getLoginStatus(updateButton);
	       	FB.Event.subscribe('auth.statusChange', updateButton);	
       });
           
               
    };
    

    (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol 
            + '//connect.facebook.net/pt_BR/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());
    

    
    function login(response, info){
		        $.post('/usuario/facebook',{ user: info, r: response.authResponse },function(r){
		            if(r.status == "sucesso"){
		            	$("#navigation_wrap").html(r.navigation);
		            }else{
		            	$('#fb-auth-loading').hide();
		            	$('#fb-auth-button').show();
		            	alert(r.msg);
		            }
		        },'json');
    }

    function logout(response){
        userInfo.innerHTML                             =   "";
        document.getElementById('debug').innerHTML     =   "";
        document.getElementById('other').style.display =   "none";
    }