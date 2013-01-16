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
	    $this->view->cortesia = $cortesia;
	    
	    $conversaoTable = new Application_Model_DbTable_Conversao();
	    $conversoes = $conversaoTable->byIdCortesia($this->_getParam('id_cortesia'));
	    $this->view->conversoes = $conversoes;

	    
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

    
    
   

}



