<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->_helper->layout->setLayout('admin');
		$admin = false;
    	
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity())
    	{
    		$user = $auth->getIdentity();
    		$this->usuario = $user;
    		if($user->admin == '1')
    		{
    			$admin = true;
    		}
    	}
    	 
    	$this->admin = $admin;
    	
    	if(!$admin)
    	{
    		return $this->_forward('entrar', 'usuario');
    	}
    	
    }

    public function indexAction()
    {
    	// action body
    }

    public function entrarAction()
    {
    	return $this->_forward('entrar', 'usuario');
    }

    
    
    public function parceiroCadastrarAction()
    {
        // action body
    }

    public function parceiroDeletarAction()
    {
        // action body
    }

    public function eventoCadastrarAction()
    {
    		
    		$request = $this->getRequest();
    		$form    = new Application_Form_EventoCadastrar();
    		
    		if ($this->getRequest()->isPost()) {
    			if ($form->isValid($request->getPost())) {
	 

    					
		    					$path = APPLICATION_PATH . '/../public/img/eventos/';
		    					$valid_formats = array("jpg", "png", "JPG", "PNG", "jpeg", "JPEG");
		    					
		    							$name = $_FILES['capa']['name'];
		    							$tmp = $_FILES['capa']['tmp_name'];
		    								
		    							
		    							@list($txt, $ext) = explode(".", $name);
		    							if(in_array($ext,$valid_formats))
		    							{
		    								$actual_image_name = 'evento_' . uniqid() . '.'.strtolower($ext);
		    									
			    								if(move_uploaded_file($tmp, $path.$actual_image_name))
			    								{
			    					
			    									$thumb500px = new Plugins_EasyThumbnail($path.$actual_image_name, $path.$actual_image_name, 500);
			    									if ($thumb500px) {
			    										$msg[] = array(
			    												'status'	=>	'ok',
			    												'url'		=>	$actual_image_name,
			    												'msg'		=>	'Sucesso 500px: '. $name
			    										);
			    										$thumb100px = new Plugins_EasyThumbnail($path.$actual_image_name, $path."/150px/".$actual_image_name, 150);
			    										
			    										$evento = new Application_Model_Evento($form->getValues());
			    										$evento->setCapa($actual_image_name);
			    										$eventoTable  = new Application_Model_DbTable_Eventos();
			    										$eventoTable->save($evento);
			    										
			    										
			    									}else {
			    										$msg[] = array(
			    												'status'	=>	'fail',
			    												'url'		=>	$actual_image_name,
			    												'msg'		=>	$thumb500px->getErrorMsg()
			    										);
			    									}
			    								}else {
			    									$msg[] = array(
			    											'status'	=>	'fail',
			    											'url'		=>	null,
			    											'msg'		=>	'Falha no envio de: '.$name
			    									);
			    								}

			    								
			    							}else{
			    								$msg[] = array(
			    										'status'	=>	'fail',
			    										'url'		=>	null,
			    										'msg'		=>	'Formato Inválido: '.$name
			    								);
			    							}


    							
    								
    							echo "<pre>";
    							return print_r($evento);
    							echo "</pre>";
    							//return $this->_redirect($evento->getUrl_amigavel());
    							
    							//<a href="<?php echo $this->serverUrl() .'/' . $evento->parceiro->url_amigavel . '/' . $evento->url_amigavel
    		
    				 
    			}
    		}
    		
    		$this->view->form = $form;
    }

    public function eventoDeletarAction()
    {
        // action body
    }


}









