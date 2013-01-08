<?php

class EventosController extends Zend_Controller_Action
{

    public function init()
    {
    	
    	$sess = new Zend_Session_Namespace('City');
     	if(($sess->cityId) > 0 || $sess->cityId == null || !isset($sess->cityId) || $_SESSION['City']['id'] == null) {
     		
     		//print_r($sess);
     		
     		$this->cityId = $sess->id;
     		$this->cityNome = $sess->nome;
     		$this->view->cityNome = $this->cityNome;
    	}else {
    		return $this->_forward('index', 'localidade');
    		header("Location: /localidade");
    		exit;
    	}
    }
    
    

    public function indexAction()
    {
    	
    	if($this->cityId == null)
    	{
    		return $this->_forward('index', 'localidade');
    	}else{
    	
    	$eventos = new Application_Model_DbTable_Eventos();
    	$this->view->eventos = $eventos->findByCity($this->cityId);
    	
    	$eventosTable = new Application_Model_DbTable_Eventos();
    	$this->view->destaques = $eventosTable->findDestaques();
   		 }
    }

    

}

