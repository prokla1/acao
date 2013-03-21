<?php

class SettingsController extends Zend_Controller_Action
{

    public function init()
    {
		$admin = false;
    	
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity())
    	{
    		$user = $auth->getIdentity();
    		$this->usuario = $user;
    		if($user->admin == '1')
    		{
    			$admin = true;
    			$this->_helper->layout->setLayout('settings');
    		}
    	}
    	 
    	$this->admin = $admin;
    	
    	if(!$admin)
    	{
    		return $this->_forward('entrar','admin');
    	}
    	
    }

    public function indexAction()
    {
        // action body
    }


    /********************------------------------ ESTADOS -----------------******************/
    /********************------------------------ ESTADOS -----------------******************/
    /********************------------------------ ESTADOS -----------------******************/
    /********************------------------------ ESTADOS -----------------******************/
    /********************------------------------ ESTADOS -----------------******************/
    public function estadosShowAction()
    {
    	$estadosTable = new Application_Model_DbTable_LocalEstados();
    	$estados = $estadosTable->getAll();
    	$this->_helper->json($estados);
    }

    public function estadosDelAction()
    {
    	$estadosTable = new Application_Model_DbTable_LocalEstados();
    	$msg = $estadosTable->del($this->_getParam('estado'));
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

    public function estadosAction()
    {
    	$form    = new Application_Form_EstadoCadastrar();
    	$request = $this->getRequest();
    	
    	if ($this->getRequest()->isPost()) 
    	{      		
    		if ($form->isValid($request->getPost())) {
    			$estadoTable  = new Application_Model_DbTable_LocalEstados();
    			$insert = $estadoTable->insert($form->getValues());
    		    if($insert)
    			{
    				$msg = array(
    						'status'	=> 'ok',
    						'msg'		=> 'Salvo com sucesso'
    				);    				
    			} 
    		}else
    		{
    			$msg = array(
    					'status'	=> 'fail',
    					'msg'		=> $form->processAjax($request->getPost())
    			);    			
    		}
    		
    		$this->_helper->json($msg);
    	}else  //não é POST, mostra os dados pra criar as credenciais
    	{
    		$this->view->form = $form;
    		
    		$estadosTable = new Application_Model_DbTable_LocalEstados();
    		$estados = $estadosTable->getAll();
    		$this->view->estados = $estados;
    	}
    }

    
    

    /********************------------------------ CREDENCIAIS -----------------******************/
    /********************------------------------ CREDENCIAIS -----------------******************/
    /********************------------------------ CREDENCIAIS -----------------******************/
    /********************------------------------ CREDENCIAIS -----------------******************/
    /********************------------------------ CREDENCIAIS -----------------******************/
    public function credenciaisShowAction()
    {
    	$credenciaisTable = new Application_Model_DbTable_Credenciais();
    	$credenciais = $credenciaisTable->getCredenciais();
    	$this->_helper->json($credenciais);
    }

    public function credenciaisDelAction()
    {
    	$credenciaisTable = new Application_Model_DbTable_Credenciais();
    	$msg = $credenciaisTable->del($this->_getParam('credencial'));
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

    public function credenciaisAction()
    {
    	$request = $this->getRequest();
    	if ($this->getRequest()->isPost()) 
    	{  //se for POST salva as credenciais
    		$parceiro = $this->_getParam('parceiro', 0);
    		$usuario = $this->_getParam('usuario', 0);
    		
    		if($parceiro > 0 && $usuario > 0)
    		{
    			$data = array(
    					'parceiro'	=>	$parceiro,
    					'usuario'			=>	$usuario
    					);
    			$credenciaisTable = new Application_Model_DbTable_Credenciais();
    			$insert = $credenciaisTable->insert($data);
    			if($insert)
    			{
    				$msg = array(
    						'status'	=> 'ok',
    						'msg'		=> 'Salvo com sucesso'
    				);    				
    			}
    			
    		}else
    		{
    			$msg = array(
    					'status'	=> 'fail',
    					'msg'		=> 'Informe o estabelecimento e o usuario'
    					);
    		}

    		$this->_helper->json($msg);
    	}else  //não é POST, mostra os dados pra criar as credenciais
    	{
    		
    		$usuariosTable = new Application_Model_DbTable_Usuarios();
    		$usuarios = $usuariosTable->getEmails();
    		$this->view->emails = $usuarios;
    		
    		$parceirosTable = new Application_Model_DbTable_Parceiros();
    		$parceiros = $parceirosTable->getParceirosList();
    		$this->view->parceiros = $parceiros;
    		 
    		$credenciaisTable = new Application_Model_DbTable_Credenciais();
    		$credenciais = $credenciaisTable->getCredenciais();
    		$this->view->credenciais = $credenciais;
    	}
    	
    }

    


    /********************------------------------ CIDADES -----------------******************/
    /********************------------------------ CIDADES -----------------******************/
    /********************------------------------ CIDADES -----------------******************/
    /********************------------------------ CIDADES -----------------******************/
    /********************------------------------ CIDADES -----------------******************/
    public function cidadesShowAction()
    {
    	$cidadesTable = new Application_Model_DbTable_LocalCidades();
    	$cidades = $cidadesTable->getAll();
    	$this->_helper->json($cidades);
    }
    
    public function cidadesDelAction()
    {
    	$cidadesTable = new Application_Model_DbTable_LocalCidades();
    	if($cidadesTable->del($this->_getParam('cidade')))
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
    
    public function cidadesAction()
    {
    	$form    = new Application_Form_CidadeCadastrar();
    	$request = $this->getRequest();
    	 
    	if ($this->getRequest()->isPost())
    	{
    		if ($form->isValid($request->getPost())) 
    		{
    			$cidadeTable  = new Application_Model_DbTable_LocalCidades();
    			$insert = $cidadeTable->insert($form->getValues());
    			if($insert)
    			{
    				$msg = array(
    						'status'	=> 'ok',
    						'msg'		=> 'Salvo com sucesso'
    				);
    			}
    		}else
    		{
    			$msg = array(
    					'status'	=> 'fail',
    					'msg'		=> $form->processAjax($request->getPost())
    			);
    		}
    
    		$this->_helper->json($msg);
    	}else  //não é POST, mostra os dados pra criar as credenciais
    	{
    		$this->view->form = $form;
    
    		$cidadesTable = new Application_Model_DbTable_LocalCidades();
    		$cidades = $cidadesTable->getAll();
    		$this->view->cidades = $cidades;
    	}
    }
    
    


    /********************------------------------ ENDERECOS -----------------******************/
    /********************------------------------ ENDERECOS -----------------******************/
    /********************------------------------ ENDERECOS -----------------******************/
    /********************------------------------ ENDERECOS -----------------******************/
    /********************------------------------ ENDERECOS -----------------******************/
    public function enderecosShowAction()
    {
    	$enderecosTable = new Application_Model_DbTable_LocalEnderecos();
    	$enderecos = $enderecosTable->getAllList();
    	$this->_helper->json($enderecos);
    }
    
    public function enderecosDelAction()
    {
    	$enderecosTable = new Application_Model_DbTable_LocalEnderecos();
    	if($enderecosTable->del($this->_getParam('endereco')))
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
    
    public function enderecosAction()
    {
    	$form    = new Application_Form_EnderecoCadastrar();
    	$request = $this->getRequest();
    
    	if ($this->getRequest()->isPost())
    	{
    		if ($form->isValid($request->getPost()))
    		{
    			$enderecosTable  = new Application_Model_DbTable_LocalEnderecos();
    			$insert = $enderecosTable->insert($form->getValues());
    			if($insert)
    			{
    				$msg = array(
    						'status'	=> 'ok',
    						'msg'		=> 'Salvo com sucesso'
    				);
    			}
    		}else
    		{
    			$msg = array(
    					'status'	=> 'fail',
    					'msg'		=> $form->processAjax($request->getPost())
    			);
    		}
    
    		$this->_helper->json($msg);
    	}else  //não é POST, mostra os dados pra criar as credenciais
    	{
    		$this->view->form = $form;
    
    		$enderecosTable = new Application_Model_DbTable_LocalEnderecos();
    		$enderecos = $enderecosTable->getAllList();
    		$this->view->enderecos = $enderecos;
    		
    		$estadosTable = new Application_Model_DbTable_LocalEstados();
    		$estados = $estadosTable->getAll();
    		$this->view->estados = $estados;
    	}
    }
    
    
    


    /********************------------------------ PARCEIROS -----------------******************/
    /********************------------------------ PARCEIROS -----------------******************/
    /********************------------------------ PARCEIROS -----------------******************/
    /********************------------------------ PARCEIROS -----------------******************/
    /********************------------------------ PARCEIROS -----------------******************/
    public function parceirosShowAction()
    {
    	$parceirosTable = new Application_Model_DbTable_Parceiros();
    	$parceiros = $parceirosTable->getAll();
    	$this->_helper->json($parceiros);
    }
    
    public function parceirosDelAction()
    {
    	$parceirosTable = new Application_Model_DbTable_Parceiros();
    	if($parceirosTable->del($this->_getParam('parceiro')))
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
    
    public function parceirosAction()
    {
    	$form    = new Application_Form_ParceiroCadastrar();
    	
    	$request = $this->getRequest();
    
    	if ($this->getRequest()->isPost())
    	{
    		if ($form->isValid($request->getPost()))
    		{
    			$enderecosTable  = new Application_Model_DbTable_LocalEnderecos();
    			$insert = $enderecosTable->insert($form->getValues());
    			if($insert)
    			{
    				$msg = array(
    						'status'	=> 'ok',
    						'msg'		=> 'Salvo com sucesso'
    				);
    			}
    		}else
    		{
    			$msg = array(
    					'status'	=> 'fail',
    					'msg'		=> $form->processAjax($request->getPost())
    			);
    		}
    
    		$this->_helper->json($msg);
    	}else  //não é POST, mostra os dados pra criar as credenciais
    	{
    		$this->view->form = $form;
    		
    		$parceirosTable = new Application_Model_DbTable_Parceiros();
    		$parceiros = $parceirosTable->getAll();
    		$this->view->parceiros = $parceiros;
    		
    		
    		$estadosTable = new Application_Model_DbTable_LocalEstados();
    		$estados = $estadosTable->getAll();
    		$this->view->estados = $estados;
    	}
    }
    
    

}











