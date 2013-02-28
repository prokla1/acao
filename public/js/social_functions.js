

function share(id) {
	$.each(events, function(key, value) {
	     if(value.id == id){
	    	 var event = value;
	    	 shareEvent(event);
	     }
	});
	
}


function shareEvent(event) {
	
	streamShare(event.url);
//	graphStreamPublishFB(event);  // nao abre o modal
//	streamPublish(event);
//	sendFB(event);
//	feedFB(event);
//	appRequestsFB(event);
	
}


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
    	   $('#fb-auth-button').hide();
    	   $('#fb-auth-loading').show();
	       	FB.getLoginStatus(updateButton);
	       	FB.Event.subscribe('auth.statusChange', updateButton);	
       });
           
               
    };
    

    
	function feedFB(evento){
		var publish = {
				  method: 'feed',
				  message: 'Vamos?',
				  name: evento.nome,
				  caption: evento.data,
				  description: (
				      evento.descricao
				  ),
				  link: evento.url,
				  picture: evento.imagem,
				  actions: [
				    { name: evento.nome, link: evento.url }
				  ],
				  properties: [
				    { text: 'Quero ir', href: evento.url},
				    { text: 'Outos eventos', href: 'http://eventer.com.br/'}
				  ],
				  user_message_prompt: 'Compartilhe este evento com seus amigos'
				};
				 
				FB.ui(publish, function(response) { 
//					  console.log(response);
				  });
	}
	 
	function streamPublish(evento){
		FB.ui({
			  method: "stream.publish",
			  display: "iframe",
			  user_message_prompt: "Convide os amigos para este evento!",
			  message: "Eu vou!! VAMOS?? ",
			  attachment: {
			     name: "Altas festas, vamos?",
			     caption: evento.nome,
			     description: evento.descricao,
			     href: evento.url,
			     media:[{"type":"image","src":evento.imagem,"href":evento.url}],
			     properties:{
			       "1)":{"text":"Quero ir","href":evento.url},
			       "2)":{"text":"Ver outros eventos","href":"http://eventer.com.br/"},
			     }
			  },
			  action_links: [{ text: 'eVenter.com.br', href: 'http://eventer.com.br' }]
			 },
			 function(response) {
			   if (response && response.post_id) {
			     //alert('Post was published.');
//				   console.log(response);
			   } else {
			     //alert('Post was not published.');
//				   console.log(response);
			   }
			 }
			);
	}


	function appRequestsFB(evento){
		
		FB.ui({
			  method: 'apprequests',
			  message: (evento.nome).substring(0,250),
			  data: evento.nome,
			  title: 'Convide seus amigos para ' + evento.nome
			});
	}
	


	function sendFB(evento){
		FB.ui({
		    method: "send",
		    name: evento.nome,
		    link: evento.url,
		    description: evento.descricao
		  }, 
		  function(response) { 
//			  console.log(response);
		  }
		 );
	}

    function streamShare(url){
        var share = {
            method: 'stream.share',
            u: url,
        };

        FB.ui(share, function(response) { 
//            console.log(response); 
        });
    }
    
    

    function graphStreamPublishFB(evento){
        
        FB.api('/me/feed', 'post', 
            {
                message     : "Aproveite!",
                link        : evento.url,
                picture     : evento.imagem,
                name        : evento.nome,
                description : evento.descricao
                
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
            		alert( 'Erro  2500' );
            	}else{
                    alert('Erro');
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
    
    
    
    
    
    
    /* **** ===== FACEBOOK ====== **** */
    (function(d){
        var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=240996152682246";
        d.getElementsByTagName('head')[0].appendChild(js);
      }(document));
    
    
    
    
    /* **** ===== TWITTER ====== **** */   
	 !function(d,s,id){
		 var js,fjs=d.getElementsByTagName(s)[0];
		 if(!d.getElementById(id)){
			 js=d.createElement(s);
			 js.id=id;
			 js.src="//platform.twitter.com/widgets.js";
			 fjs.parentNode.insertBefore(js,fjs);
			 }
	 }(document,"script","twitter-wjs");

	 
	 
    /* **** ===== G+ ====== **** */ 
	  window.___gcfg = {lang: 'pt-BR'};
	  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();

	  
	  
	  /* ******** NUMBER OF FOLLOW TWITTER ******* */
	  if($('#followers').length)
		  {
		  $(function() {
			    function m(n, d) {
			        P = Math.pow;
			        R = Math.round;
			        d = P(10, d);
			        i = 7;
			        while(i) {
			            (s = P(10, i-- * 3)) <= n && (n = R(n * d / s) / d + "KMGTPE"[i])
			        }
			        return n;
			    }

			    $.ajax({
			        url: 'http://api.twitter.com/1/users/show.json',
			        data: {
			            screen_name: 'eVenter_oficial'
			        },
			        dataType: 'jsonp',
			        success: function(data) {
			           count = data.followers_count;
			           $('#followers').html(m(count, 1));
			        }
			    });
			});		  
		  }

