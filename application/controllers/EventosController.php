<?php

class EventosController extends Zend_Controller_Action
{

    public function init()
    {
    	$sess = new Zend_Session_Namespace('City');
    	$this->cityId = $sess->id;
     	$this->cityNome = $sess->nome;
     	$this->view->cityNome = $this->cityNome;
    }
    
    

    public function indexAction()
    {

    	if(empty($this->cityId))
    	{
    		return $this->_forward('index', 'localidade');
    	}
    	
    	
    	$eventos = new Application_Model_DbTable_Eventos();
    	$this->view->eventos = $eventos->findByCity($this->cityId);
    	
    	$eventosTable = new Application_Model_DbTable_Eventos();
    	$this->view->destaques = $eventosTable->findByCityDestaques($this->cityId);
    }

    

}

