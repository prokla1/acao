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
            button       =   document.getElementById('fb-auth');
            userInfo     =   document.getElementById('user-info');
            
            console.log('function updateButton(response)');
            console.log(response);
            
            if (response.authResponse) {
                //user is already logged in and connected
                FB.api('/me', function(info) {
                    login(response, info);
                });
                
                button.onclick = function() {
//                    FB.logout(function(response) {
//                        logout(response);
//                    });
                };
            } else {
                //user is not connected to your app or logged out
                button.innerHTML = 'Login';
                button.onclick = function() {
                    FB.login(function(response) {
                        if (response.authResponse) {
                            FB.api('/me', function(info) {
                                login(response, info);
                            });	   
                        } else {
                            //user cancelled login or did not grant authorization
                        }
                    }, {scope:'email,user_birthday,publish_stream'}); //{scope:'email,user_birthday,status_update,publish_stream,user_about_me'});  	
                };
            }
        }
        
        // run once with current status and whenever the status changes
       
       $('#fb-auth').click(function(event){
	       	FB.getLoginStatus(updateButton);
	       	FB.Event.subscribe('auth.statusChange', updateButton);	
       });
           
               
    };
    

    (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol 
            + '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());
    

    
    function login(response, info){
    	console.log('function login(response, info)');
    	console.log(response);
    	console.log(info);
//        if (response.authResponse) {
//            var accessToken                                 =   response.authResponse.accessToken;
//            
//            userInfo.innerHTML                             = '<img src="https://graph.facebook.com/' + info.id + '/picture">' + info.name
//                                                             + "<br /> Token de acesso: " + accessToken;
//            button.innerHTML                               = 'Logout';
//            showLoader(false);
//            document.getElementById('other').style.display = "block";
    	
		        $.post('/usuario/facebook',{ user: info, r: response.authResponse },function(r){
		            if(r.status == "sucesso"){
		            	$("#content_top_menus").html(r.navigation);
		            }else{
		            	alert("Falha no login! Preencha corretamente.");
		            	console.log(r);
		            }
		        },'json');
//        }
    }

    function logout(response){
        userInfo.innerHTML                             =   "";
        document.getElementById('debug').innerHTML     =   "";
        document.getElementById('other').style.display =   "none";
    }