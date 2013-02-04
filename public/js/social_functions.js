
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
    

    
    (function(d){
        var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/pt_BR/all.js";
        d.getElementsByTagName('head')[0].appendChild(js);
      }(document));
 
 
    

    function share(url, picture, name){
        var share = {
//            method: 'stream.share',
//            u: url,
            
            method: 'stream.share',
            u: url,
            picture: picture,
            name: name,
            caption: 'Ingressos free',
            description: 'Aproveite, consiga entradas gratis'
        };

        FB.ui(share, function(response) { 
            console.log(response); 
        });
    }
    
    
    
    function graphStreamPublish(url, picture, name){
        
        FB.api('/me/feed', 'post', 
            {
                message     : "Aproveite!",
                link        : url,
                picture     : picture,
                name        : name,
                description : 'Veja os eventos de sua cidade e consiga convites gratuitos'
                
        }, 
        function(response) {
            
            if (!response || response.error) {
            	if(response.error.code == "200"){
            		//permissão
            		alert('faltou permissao');
                    FB.login(function(response) {
                        if (response.authResponse) {
                        	graphStreamPublish(url, picture, name);  
                        } else {
                            //user cancelled login or did not grant authorization
                        	alert('Não foi possível conectrar através do Facebook');
                        }
                    }, {scope:'email,user_birthday,publish_stream'}); //{scope:'email,user_birthday,status_update,publish_stream,user_about_me'});  	

            	}else if (response.error.code == "2500") {
            		//FB.Event.subscribe('auth.statusChange', updateButton);
            		alert( 'erro  2500' );
            	}else{
                    alert('deu algum erro');
            	}
            } else {
                alert('ID do post : ' + response.id);
            }
        });
    }
    
    
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