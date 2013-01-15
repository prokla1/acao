<?php

class ConversaoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	
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
    	$this->_helper->layout->setLayout('ajax');
    	$this->view->logged = $this->logged;
    	
    	$cortesiaTable = new Application_Model_DbTable_Cortesias();
    	$cortesiaModel = new Application_Model_Cortesias();
    	$cortesia = $cortesiaTable->byId($this->_getParam('id_cortesia'), $cortesiaModel);
	    //$this->_helper->json($data);
	    $this->view->cortesia = $cortesia;
	    
	    if(!$this->logged){
	    	$form = new Application_Form_Entrar();
	    	$this->view->form = $form;
	    }else {
	    	$this->view->usuario = $this->usuario;
	    }

    }

    public function converterAction()
    {
    	$this->_helper->layout->setLayout('ajax');
    	
    	$id_cortesia = $this->_getParam('id_cortesia');
    	$usuario = $this->usuario;
    	
    	$cortesiaTable = new Application_Model_DbTable_Cortesias();
    	$cortesiaModel = new Application_Model_Cortesias();
    	$cortesia = $cortesiaTable->byId($id_cortesia, $cortesiaModel);
    	
    	
    	$this->view->usuario = $usuario;
    	$this->view->cortesia = $cortesia;
    	 
    }

    
    
    public function conversaoAction()
    {
        // action body
    	$this->_helper->layout->setLayout('ajax');
    	 
    	$id_cortesia = $this->_getParam('id_cortesia');
    	$usuario = $this->usuario;
    	 
    	$cortesiaTable = new Application_Model_DbTable_Cortesias();
    	$cortesiaModel = new Application_Model_Cortesias();
    	$cortesia = $cortesiaTable->byId($id_cortesia, $cortesiaModel);
    	
    	if($cortesia->sexo == '3' || $cortesia->sexo == $usuario->sexo){
    		if($usuario->cpf > 0   &&   $cortesia->termino <= date('Y-m-d h:i:s')   &&   $cortesia->evento->realizacao >= date('Y-m-d')  &&  $cortesia->evento->ativo == '1'){
    			//pode converter
    			
    			$conversaoTable = new Application_Model_DbTable_Conversao();
    			$conversaoModel = new Application_Model_Conversao();
    			
    			$conversaoTable->converter($id_cortesia, $conversaoModel);
    			
    		}
    	}
    	
    }

    

}



