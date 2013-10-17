<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
    	
    	

    	$sessAdminEstab = new Zend_Session_Namespace('AdminParceiro');
    	if ($this->_getParam('parceiro'))
    	{
    		$this->parceiro = $this->_getParam('parceiro');
    		$sessAdminEstab->parceiro = $this->parceiro;
    	}else
    	{
    		if ($sessAdminEstab->parceiro)
    		{
    			$this->parceiro = $sessAdminEstab->parceiro;
    		}else
    		{
    			return $this->_helper->redirector->goToRoute( array('controller' => 'usuario', 'action' => 'entrar'), null, true);
    		}
    	}
    	 
    	

    	$admin = false;
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity())
    	{
    		$user = $auth->getIdentity();
    		$this->usuario = $user;
    	
    		$credencialTable = new Application_Model_DbTable_Credenciais();
    	
    		if( $credencialTable->permissao($user->id, $this->parceiro))
    		{
    			$admin = true;
    			$this->_helper->layout->setLayout('admin');
    		}else
    		{
    			return $this->_helper->redirector->goToRoute( array('controller' => 'usuario'), null, true);
    		}
    	}
    	if(!$admin)
    	{
    		return $this->_helper->redirector->goToRoute( array('controller' => 'usuario'), null, true);
    	}
    	
    	
    	 
    	 
    	 
    	$pareceirobTable = new Application_Model_DbTable_Parceiros();
    	$this->parceiro = $pareceirobTable->byId($this->parceiro, new Application_Model_Parceiro());
    	$this->view->parceiro = $this->parceiro;
    	
    }

    public function indexAction()
    {
    	// action body
    }

    


    public function eventoCadastrarAction()
    {
    		
    		$request = $this->getRequest();
    		$form    = new Application_Form_EventoCadastrar();
    		
    		if ($this->getRequest()->isPost()) {
    			if ($form->isValid($request->getPost())) {
	 
	    				
	    				if($_FILES['capa']['name'])  //Enviou foto
	    				{
    					
    					
		    					$path = APPLICATION_PATH . '/../public_html/img/eventos/';
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
    					}else{ //final qdo envia a foto
    						$actual_image_name = 'null.jpg';
    					}			
    			


    							$evento = new Application_Model_Evento($form->getValues());
    							$evento->setCapa($actual_image_name);
    							$eventoTable  = new Application_Model_DbTable_Eventos();
    							$id_evento = $eventoTable->save($evento);
    								
    								
    							$generos = $this->_getParam('id_genero');
    							$table = new Application_Model_DbTable_RelGeneros();
    							$table->saveGeneros($generos, $id_evento);
			    							
			    							
    							
    							return $this->_helper->redirector->goToRoute( array('controller' => 'admin', 'action' => 'eventos'), null, true);
	
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




    public function uploadAction()
    {
			    
	    $path = APPLICATION_PATH . '/../public_html/img/uploads/';
	    $valid_formats = array("jpg", "png", "JPG", "PNG", "jpeg", "JPEG");
	     
	    $name = $_FILES['file']['name'];
	    $tmp = $_FILES['file']['tmp_name'];
	    
	    // setting file's mysterious name
	    $filename = date('YmdHis').'.jpg';
	    $file = $path.$filename;
	    	
	    // copying
	    copy($_FILES['file']['tmp_name'], $file);
	    	
	    		$thumb500px = new Plugins_EasyThumbnail($file, $file, 500);
	    		if ($thumb500px) {
	    			$msg[] = array(
	    					'status'	=>	'ok',
	    					'url'		=>	$filename,
	    					'msg'		=>	'Sucesso 500px: '. $name
	    			);
	    			$thumb100px = new Plugins_EasyThumbnail($file, $path."/150px/".$filename, 150);
	    		}
	
	    // displaying file    
		$array = array(
			'filelink' => '/img/uploads/'.$filename
		);
		
		$this->_helper->json($array);
			 
    }

    public function uploadjsonAction()
    {

    	$imgs = array();

    	/**      ======= MOSTRA AS FOTOS DO DIRETÓRIO 'uploads'======  **/
    	$directoryUploads = APPLICATION_PATH . '/../public_html/img/uploads/';
    	$images = glob("" . $directoryUploads . "*.*");
    	foreach($images as $image)
    	{
    		$img = array();
    		$img['thumb'] = '/public_html/img/uploads/150px/'. basename($image); //$image;
    		$img['image'] = '/public_html/img/uploads/'. basename($image);
    		$img['title'] =  basename($image);
    		$img['folder'] = 'Uploads';
    		$imgs[] = $img;
    	}
    	 

    	/**      ======= MOSTRA AS FOTOS DO DIRETÓRIO 'parceiros'======  **/
    	/*
    	$directoryParceiros = APPLICATION_PATH . '/../public/img/parceiros/';
    	$images = glob("" . $directoryParceiros . "*.*");
    	foreach($images as $image)
    	{
    		$img = array();
    		$img['thumb'] = '/public/img/parceiros/150px/'. basename($image); //$image;
    		$img['image'] = '/public/img/parceiros/'. basename($image);
    		$img['title'] =  basename($image);
    		$img['folder'] = 'Parceiros';
    		$imgs[] = $img;
    	}
    	 */
    	 
    	$this->_helper->json($imgs);
    }


    public function estatisticasAction()
    {
    	$parceiros = new Application_Model_DbTable_Parceiros();
    	$this->view->parceiros = $parceiros->getParceirosList();
    }

    public function estatisticasShowAction()
    {
    	$this->_helper->layout->setLayout('ajax');
    	
    	$id_parceiros = $this->_getParam('id_parceiro');
    	$this->view->id_parceiros = $id_parceiros;
    	
    	$eventosTable = new Application_Model_DbTable_Eventos();
    	$this->view->eventosEstatisticas = $eventosTable->estatisticas($id_parceiros, $this->_getParam('from'), $this->_getParam('to'));
    	 
    }


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function imagemAction()
    {
    
    	$request = $this->getRequest();
    
    	if ($this->getRequest()->isPost())
    	{
    		
    		$path = APPLICATION_PATH . '/../public_html/img/parceiros/';
    		$valid_formats = array("jpg", "png", "JPG", "PNG", "jpeg", "JPEG");
    		 
    		if(!empty($_FILES['foto']['name']))
    		{
	    		$name = $_FILES['foto']['name'];
	    		$tmp = $_FILES['foto']['tmp_name'];
	    		
	    			
	    		@list($txt, $ext) = explode(".", $name);
	    		if(in_array($ext,$valid_formats))
	    		{
	    			$actual_image_name = $this->parceiro->getUrl_amigavel().'.'.strtolower($ext);
	    				
	    			if(move_uploaded_file($tmp, $path.$actual_image_name))
	    			{
	    		
	    				$thumb150px = new Plugins_EasyThumbnail($path.$actual_image_name, $path.$actual_image_name, 150);
	    				if ($thumb150px) {
	    					$msg = array(
	    							'status'	=>	'ok',
	    							'url'		=>	$actual_image_name,
	    							'msg'		=>	'Sucesso 150px: '. $name
	    					);
	    					
	    					$parceiroTable = new Application_Model_DbTable_Parceiros();
	    					$dados = array(
	    							'foto'	=> $actual_image_name
	    							);
	    					$parceiroTable->update($dados, array('id = ?' => $this->parceiro->getId()));
	    						
	    						
	    				}else {
	    					$msg = array(
	    							'status'	=>	'fail',
	    							'url'		=>	$actual_image_name,
	    							'msg'		=>	$thumb150px->getErrorMsg()
	    					);
	    				}
	    			}else {
	    				$msg = array(
	    						'status'	=>	'fail',
	    						'url'		=>	null,
	    						'msg'		=>	'Falha no envio de: '.$name
	    				);
	    			}
	    		
	    				
	    		}else{
	    			$msg = array(
	    					'status'	=>	'fail',
	    					'url'		=>	null,
	    					'msg'		=>	'Formato Inválido: '.$name
	    			);
	    		}
    		}else 
 	    	{
 	    		$msg = array(
 	    				'status'	=>	'fail',
 	    				'msg'		=>	'<h3>Imagem não enviada</h3>',
 	    		);
 	    	}
    		
    		
    		$this->_helper->json($msg);
    		
    		    
    	}
    	 
    }
    

    
    
    public function dadosAction()
    {
    	$request = $this->getRequest();
    	$form = new Application_Form_ParceiroCadastrar();
    	$form->removeElement('id');
    	$form->removeElement('status');
    	$form->removeElement('id_atividade');
    	$form->removeElement('funcionamento');
    	$form->removeElement('pagamento');
    	$form->removeElement('url_amigavel');
    	$form->getElement('submit')->setLabel('Atualizar');
    	$form->populate($this->parceiro->getArray());
    	$this->view->form = $form;
    
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    
    			$parceiroTable = new Application_Model_DbTable_Parceiros();
    			$id_parceiro = $parceiroTable->update($form->getValues(), array('id = ?' => $this->parceiro->getId()));
    
    			if($id_parceiro)
    			{
    				$msg = array(
    						'status' => 'ok',
    						'msg'	=>	'Atualizado com sucesso'
    				);
    				$this->view->id_estab = $id_parceiro;
    			}else {
    				$msg = array(
    						'status' => 'fail',
    						'msg'	=>	'Falha ao atualizar os dados'
    				);
    				 
    			}
    		}else {
    			$msg = array(
    					'status' => 'fail',
    					'msg'	=>	'Preencha os dados corretamente'
    			);
    			 
    		}
    		$this->view->msg = $msg;
    	}
    
    }
    
    
    
    

    public function pagamentosAction()
    {
    	$parceiro = $this->parceiro->getId();
    
    	$request = $this->getRequest();
    	if ($this->getRequest()->isPost())
    	{
    		if($this->_getParam('pagamento'))
    		{
    			$pagamentos = $this->_getParam('pagamento');
    			 
    			$tiposTable = new Application_Model_DbTable_ParceirosPagamento();
    			$save = $tiposTable->savePagamentos($pagamentos, $parceiro);
    			 
    			if($save)
    			{
    				$msg = array(
    						'status'	=>	'ok',
    						'msg'		=>	'<h3>Salvo com sucesso</h3>'
    				);
    			}else
    			{
    				$msg = array(
    						'status'	=>	'fail',
    						'msg'		=>	'<h3>Falha ao salvar, tente novamente.</h3>'
    				);
    			}
    		}else
    		{
    			$msg = array(
    					'status'	=>	'fail',
    					'msg'		=>	'<h3>Selecione os tipos de pagamento</h3>'
    			);
    			 
    		}
    
    		$this->_helper->json($msg);
    	}else
    	{
    		$tiposTable = new Application_Model_DbTable_PagamentosFormas();
    		$pagamentos = $tiposTable->getAll();
    		$this->view->pagamentos = $pagamentos;
    
    		$pagamentosativosTable = new Application_Model_DbTable_ParceirosPagamento();
    		$pagamentosativos = $pagamentosativosTable->byParceiro($parceiro);
    		$this->view->pagamentosativos = $pagamentosativos;
    	}
    	 
    }
    
    
    public function pagamentosDelAction()
    {
    	$pagamentosativosTable = new Application_Model_DbTable_ParceirosPagamento();
    	$msg = $pagamentosativosTable->del($this->_getParam('pagamento'), $this->parceiro->getId());
    	if($msg)
    	{
    		$msg = array(
    				'status'	=>	'ok',
    				'msg'		=>	'Deletado com sucesso'
    		);
    	}else
    	{
    		$msg = array(
    				'status'	=>	'fail',
    				'msg'		=>	'Falha ao deletar'
    		);
    	}
    	$this->_helper->json($msg);
    }
    
    
    public function pagamentosShowAction()
    {
    	$pagamentosativosTable = new Application_Model_DbTable_ParceirosPagamento();
    	$pagamentosativos = $pagamentosativosTable->byParceiro($this->parceiro->getId());
    	$this->_helper->json($pagamentosativos);
    }
    
    
    

    
    
    public function fotosDelAction()
    {
    	$parceirosFotos = new Application_Model_DbTable_ParceirosFotos();
    	$msg = $parceirosFotos->del($this->_getParam('foto'), $this->parceiro->getId());
    	if($msg)
    	{
    		$msg = array(
    				'status'	=>	'ok',
    				'msg'		=>	'Deletado com sucesso'
    		);
    	}else
    	{
    		$msg = array(
    				'status'	=>	'fail',
    				'msg'		=>	'Falha ao deletar'
    		);
    	}
    	$this->_helper->json($msg);
    }
    
    public function fotosShowAction()
    {
    	$parceirosFotos = new Application_Model_DbTable_ParceirosFotos();
    	$fotos = $parceirosFotos->fotosByParceiro($this->parceiro->getId());
    	$this->_helper->json($fotos);
    }
    
    
    public function fotosAction()
    {
    	$request = $this->getRequest();
    	 
    	if ($this->getRequest()->isPost()) {
    
    		$id_parceiro = $this->_getParam('id_parceiro');
    		$path = APPLICATION_PATH . '/../public_html/img/parceiros/';
    		$valid_formats = array("jpg", "png", "JPG", "PNG", "jpeg", "JPEG");
    
    		if(!empty($_FILES['url']['name']))
	    		{
	    		// 	    		print_r($_FILES);
	    		$files = array();
	    		$qts = @count($_FILES['url']['name']);
	    		for($i=0; $i < $qts; $i++)
	    		{
		    		$files[] = $_FILES['url']['name'][$i];
		    		$name = $_FILES['url']['name'][$i];
		    		$tmp = $_FILES['url']['tmp_name'][$i];
	    							
	    			@list($txt, $ext) = explode(".", $name);
	    				if(in_array($ext,$valid_formats))
	    				{
		    				$filename = date('YmdHis') . uniqid() . '.' . strtolower($ext);
		    				$file = $path.$filename;
		    							
		    				// copying
		    				copy($tmp, $file);
		    							
		    				$thumb500px = new Plugins_EasyThumbnail($file, $file, 500);
		    				if ($thumb500px) {
			    					$msg = array(
			    							'status'	=>	'ok',
			    							'url'		=>	$file,
			    							'msg'		=>	'Salvo com sucesso: '. $name
			    					);
			    					$thumb100px = new Plugins_EasyThumbnail($file, $path."150px/".$filename, 150);
			    							
			    					$data = array(
			    							'url' => $filename,
			    							'id_parceiro' => $this->parceiro->getId(),
			    					);
			    					$parceirofotosTable = new Application_Model_DbTable_ParceirosFotos();
			    					$parceirofotosTable->insert($data);
		    				}else
		    				{
		    					$msg = array(
		    							'status'	=>	'fail',
		    							'url'		=>	$file,
		    							'msg'		=>	'Falha ao salvar: '. $name
		    					);
		    				}
	    							
	    				}else {
	    					$msg = array(
	    							'status'	=>	'fail',
	    							'url'		=>	$file,
	    							'msg'		=>	'Extensão não permitida: '. $name
	    					);
	    				}
	    
	    			}
	    		}else
	    		{
	    			$msg = array(
	    					'status'	=>	'fail',
	    					'msg'		=>	'Foto não enviada'
	    			);
	    		}
    			$this->_helper->json($msg);
    
    	}else
    	{
    		$parceirosFotos = new Application_Model_DbTable_ParceirosFotos();
    		$fotos = $parceirosFotos->fotosByParceiro($this->parceiro->getId());
    		$this->view->fotos = $fotos;
    	}
    	 
    }
    

    
    

    public function atividadesShowAction()
    {
    	$atividadesativasTable = new Application_Model_DbTable_RelAtividades();
    	$atividadesativas = $atividadesativasTable->byParceiro($this->parceiro->getId());
    	$this->_helper->json($atividadesativas);
    }
    
    public function atividadesDelAction()
    {
    	$atividadesativasTable = new Application_Model_DbTable_RelAtividades();
    	$msg = $atividadesativasTable->del($this->_getParam('atividade'), $this->parceiro->getId());
    	if($msg)
    	{
    		$msg = array(
    				'status'	=>	'ok',
    				'msg'		=>	'Deletado com sucesso'
    		);
    	}else
    	{
    		$msg = array(
    				'status'	=>	'fail',
    				'msg'		=>	'Falha ao deletar'
    		);
    	}
    	$this->_helper->json($msg);
    }
    
    public function atividadesAction()
    {
    	$parceiro = $this->parceiro->getId();
    
    	$request = $this->getRequest();
    	if ($this->getRequest()->isPost())
    	{
    		if($this->_getParam('atividades'))
    		{
    			$atividades = $this->_getParam('atividades');
    			 
                            try {
                                $atividadesTable = new Application_Model_DbTable_RelAtividades();
                                $save = $atividadesTable->saveAtividades($atividades, $parceiro);
                                $msg = array(
    						'status'	=>	'ok',
    						'msg'		=>	'<h3>Salvo com sucesso</h3>'
    				);
                            } catch (Exception $exc) {
                                echo $exc->getTraceAsString();
                                $msg = array(
    						'status'	=>	'fail',
    						'msg'		=>	$exc->getMessage()
    				);
                            }
                          
    			 
    			
    		}else
    		{
    			$msg = array(
    					'status'	=>	'fail',
    					'msg'		=>	'<h3>Selecione os tipos</h3>'
    			);
    			 
    		}
    
    		$this->_helper->json($msg);
    	}else
    	{

    		
    		$atividadesTable = new Application_Model_DbTable_Atividades();
    		$atividades = $atividadesTable->getAll();
    		$this->view->atividades = $atividades;
    
    		$atividadesativasTable = new Application_Model_DbTable_RelAtividades();
    		$atividadesativas = $atividadesativasTable->byParceiro($parceiro);
    		$this->view->atividadesativas = $atividadesativas;
    	}
    	 
    }


    public function eventosAction()
    {
    	$parceiro = $this->parceiro->getId();                
    	$eventos = new Application_Model_DbTable_Eventos();
    	$this->view->eventos = $eventos->findByParceiroDate($parceiro, date('d/m/Y', time()), date('d/m/Y', time()));
    	 
    	
    }


    public function eventosShowAction()
    {

    	$this->view->doctype('XHTML1_RDFA');
    	$this->_helper->layout->setLayout('ajax');
    	$parceiro = $this->parceiro->getId();
    	$eventos = new Application_Model_DbTable_Eventos();
    	$this->view->eventos = $eventos->findByParceiroDate($parceiro, $this->_getParam('from'), $this->_getParam('to'));
    	 
    }
      
}



