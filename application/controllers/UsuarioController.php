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
    }

    public function indexAction()
    {
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity())
    	{
    		$user = $auth->getIdentity();
    		$this->view->usuario = $user;
    	}else{
    		//return $this->_helper->redirector('entrar');
    		return $this->_forward('entrar', 'usuario');
    		
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
    				$this->view->message = "Usuário foi salvo com sucesso!";
    			} catch (Exception $e) {
    				$this->view->assign('message', $e->getMessage());
    			}
    			
    			// get all users
    			return $this->_helper->redirector('index');
    		}
    	}
    	 
    	$this->view->form = $form;
    }
    


    
    
    
    public function sairAction()
    {
    	$auth = Zend_Auth::getInstance();
    	$auth->clearIdentity();
    	return $this->_helper->redirector('index');
    }
    
    
}





