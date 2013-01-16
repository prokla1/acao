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
    	
    	$dia_base = $this->_getParam('dia');
    	if(empty($dia_base)){
    		$dia_base = time(); //+86400*50;  //86400 = 1 dia
    	}
    	
    	$eventos = new Application_Model_DbTable_Eventos();
    	//$this->view->eventos = $eventos->findByCity($this->cityId);
    	$this->view->eventos = $eventos->findByCityAndDate($this->cityId, $dia_base);
    	
    	$eventosTable = new Application_Model_DbTable_Eventos();
    	$this->view->destaques = $eventosTable->findByCityDestaques($this->cityId);
    }

    

}

