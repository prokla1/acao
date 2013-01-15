<?php

class ConversaoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	
    	$logged = false;
    	if ( Zend_Auth::getInstance()->hasIdentity() ) // se tiver logado
    		$logged = true;
    	
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
	    }

    }

    public function converterAction()
    {
    	//$this->_helper->layout()->disableLayout();
    	//$this->_helper->viewRenderer->setNoRender(true);
    	$this->_helper->layout->setLayout('ajax');
    	
    	
    	 
    }


}



