<?php

class ConversaoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        
    	/*
    	 *     
     	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	$this->_helper->json($msg);
    	 */
    }

    
    
    public function testAction()
    {
    	$data = array(
    			'result' => true,
    			'data' => array()
    	);
    	//$data = $this->_getAllParams();
     	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	//$this->_helper->json($data);
    	
    	$cortesiaTable = new Application_Model_DbTable_Cortesias();
    	$cortesiaModel = new Application_Model_Cortesias();
    	$cortesia = $cortesiaTable->byId($this->_getParam('id_cortesia'), $cortesiaModel);
    	
    	//$this->view->evento = $cortesia;
    	$this->_helper->json($cortesia->getArray());
    }

}

