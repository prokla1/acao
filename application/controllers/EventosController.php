<?php

class EventosController extends Zend_Controller_Action
{

    public function init()
    {
    	
    	
    	$sess = new Zend_Session_Namespace('City');
  	
     	if($sess->cityId > 0) {
     		$this->cityId = $sess->id;
     		$this->cityNome = $sess->nome;
     		$this->view->cityNome = $this->cityNome;
    	}else {
    		return $this->_forward('index', 'localidade');
    	}
    }
    
    

    public function indexAction()
    {
    	$eventos = new Application_Model_DbTable_Eventos();
    	$this->view->eventos = $eventos->findByCity($this->cityId);
    	
    	$eventosTable = new Application_Model_DbTable_Eventos();
    	$this->view->destaques = $eventosTable->findDestaques();
    }

    

}

