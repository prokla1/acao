<?php

class UsuarioController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	$sess = new Zend_Session_Namespace('City');
    	$this->cityId = $sess->id;
    	$this->cityNome = $sess->nome;
    	$this->view->cityNome = $this->cityNome;
    	
    	
    	$logged = false;
    	
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity())
    	{
    		$user = $auth->getIdentity();
    		$this->usuario = $user;
    		$logged = true;
    	}
    	 
    	$this->logged = $logged;
    }

    public function indexAction()
    {
    	if($this->logged)
    	{
    		$user = Zend_Auth::getInstance()->getIdentity();
    		$this->view->usuario = $user;
    	}else
    	{
    		//return $this->_helper->redirector('entrar');
    		return $this->_forward('entrar', 'usuario');
    	}
    		
    	
    }

    public function entrarAjaxAction()
    {
    	$this->_helper->layout->setLayout('ajax');
    
    	if(!$this->logged)
    	{
    		$form = new Application_Form_Entrar();
    		$this->view->form = $form;
    	}else
    	{
    		$this->view->usuario = $this->usuario;
    	}
    	
    }

    public function validateformAction()
    {
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	
    	$form = new Application_Form_Entrar();
    	
    	if ( $form->isValid($this->getRequest()->getPost()) ) {
    		
    		$email = $form->getValue('email');
    		$senha = $form->getValue('senha');
    		
    		$dbAdapter = Zend_Db_Table::getDefaultAdapter();
    		
    		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
    		$authAdapter->setTableName('usuarios')
    		->setIdentityColumn('email')
    		->setCredentialColumn('senha')
    		->setCredentialTreatment('MD5(?)');
    		
    		$authAdapter->setIdentity($email)
    		->setCredential($senha);
    		
    		$auth = Zend_Auth::getInstance();
    		$result = $auth->authenticate($authAdapter);
    		
    		$dados = array();
    		if ( $result->isValid() ) {
    		
    			$info = $authAdapter->getResultRowObject();
    			$storage = $auth->getStorage();
    				
    			$user = new Application_Model_Usuario(get_object_vars($info));
    			$user->setSenha($senha);
    			$storage->write($user);
    				
    			$dados['status'] = "sucesso";
    			
    			    
    			$navigation = $this->view->navigation()->menu()->renderMenu(Zend_Registry::get('logged'));
    			$dados['navigation'] = $navigation;
    			
    		} else {
    			$dados['status'] = "erro";
    		}
    		$this->_helper->json($dados);
    		
    		
    	}else{
    		$dados['status'] = "erro";
    		$dados['msg'] = $form->getMessages();
    		$this->_helper->json($dados);
    	}
    	
    }

    public function entrarAction()
    {
    	 
    	$form = new Application_Form_Entrar();
    	$this->view->form = $form;
    	 
    	//Verifica se existem dados de POST
    	if ( $this->getRequest()->isPost() ) {
    		$data = $this->getRequest()->getPost();
    		 
    		//Formulário corretamente preenchido?
    		if ( $form->isValid($data) ) {
    
    			$email = $form->getValue('email');
    			$senha = $form->getValue('senha');
    
    			$dbAdapter = Zend_Db_Table::getDefaultAdapter();
    			 
    			//Inicia o adaptador Zend_Auth para banco de dados
    			$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
    			$authAdapter->setTableName('usuarios')
    				->setIdentityColumn('email')
    				->setCredentialColumn('senha')
    				->setCredentialTreatment('MD5(?)');
    			//->setCredentialTreatment('SHA1(?)');
    			 
    			//Define os dados para processar o login
    			$authAdapter->setIdentity($email)
    					->setCredential($senha);
    			 
    			//Efetua o login
    			$auth = Zend_Auth::getInstance();
    			$result = $auth->authenticate($authAdapter);
    			 
    			//Verifica se o login foi efetuado com sucesso
    			// is the user a valid one?
    			if ( $result->isValid() ) {
    
    				//Armazena os dados do usuário em sessão, apenas desconsiderando
    				//a senha do usuário
    				//$info = $authAdapter->getResultRowObject(null, 'senha');
    				 
    				$info = $authAdapter->getResultRowObject();
    				$storage = $auth->getStorage();
    				 
    				// http://php.net/manual/pt_BR/function.get-object-vars.php
    				// retorna um objet em array, que é usado no __construct do USER
    				$user = new Application_Model_Usuario(get_object_vars($info));
    				$user->setSenha($senha);
    				$storage->write($user);
    				 
    				//Redireciona para o Controller protegido
    				return $this->_helper->redirector->goToRoute( array('controller' => 'usuario'), null, true);
    				 
    			} else {
    
    				//Dados inválidos
    				$this->_redirect('/usuario/entrar');
    
    			}
    		} else {
    
    			//Formulário preenchido de forma incorreta
    			$form->populate($data);
    			 
    		}
    	}
    	 
    	 
    }

    public function cadastrarAction()
    {
    	$request = $this->getRequest();
    	$form    = new Application_Form_Cadastrar();
    	 
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			 
    			// model
    			$user = new Application_Model_Usuario($form->getValues());
    			
    			// mapper
    			$mapper  = new Application_Model_DbTable_Usuarios();    			
    			
    			try {
    				// insert user
    				$mapper->save($user);
    				
    				$auth = Zend_Auth::getInstance();
    				$storage = $auth->getStorage();
    				$storage->write($user);
    				
    				$this->view->msg = "Usuário foi salvo com sucesso!";
    				$this->view->user = $user;
    				
    			} catch (Exception $e) {
    				$this->view->assign('msg', $e->getMessage());
    			}
    			
    		}
    	}
    	 
    	$this->view->form = $form;
    }

    public function sairAction()
    {
    	$auth = Zend_Auth::getInstance();
    	$auth->clearIdentity();
    	//return $this->_helper->redirector('index');
    	return $this->_redirect('/eventos');
    }

    public function dadosAction()
    {
        // action body
    }

    public function facebookAction()
    {
    	$dados = array();
    	
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	
    	$user_post = $this->_getParam('user');
        
        if($user_post)
        {
        	
        	$response = $this->_getParam('r');
        	$token = $response['accessToken'];
        	
        	$user_get = json_decode(file_get_contents('https://graph.facebook.com/me?access_token='.$token), true);
        	
        	if($user_get && $user_get['email'] == $user_post['email']) //se no get encontrou as permissoes para o token postado
        	{
        		 
        		$userTable = new Application_Model_DbTable_Usuarios();
        		$user = $userTable->byEmailFace( $user_get, new Application_Model_Usuario());
        		
        		if($user)
        		{
        			$dados['status'] = 'sucesso';
        			$dados['msg'] = 'Cadastrado com sucesso';
        			
        			$auth = Zend_Auth::getInstance();
        			$storage = $auth->getStorage();
        			$storage->write($user);
        			//$dados['user'] = $user->getArray();
        			
        			$navigation = $this->view->navigation()->menu()->renderMenu(Zend_Registry::get('logged'));
        			$dados['navigation'] = $navigation;
        		
        		}else //if($user)
        		{
        			$dados['status'] = 'falha';
        			$dados['msg'] = 'Não foi possível efetuar seu cadastro ou os dados estão incompletos';
        		}       		
        		
        	}else  //if($user_get)
        	{
        		$dados['status'] = 'falha';
        		$dados['msg'] = 'Os dados enviados estão incorretos ou você não permitiu o login pelo Facebook';
        	}

        }else //if($user_post)
        {
        	$dados['status'] = 'falha';
        	$dados['msg'] = 'Falha na requisição';
        }

  
        
        $this->_helper->json($dados);
    }


}









