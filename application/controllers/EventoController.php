<?php

class EventoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    
    
    /**
     * Exibe o EVENTO
     */
    public function indexAction()
    {
		/*
    	$evento = new Application_Model_Evento();  //o objeto EVENTO
    	$eventos = new Application_Model_EventosMapper();  //o MAPPER EVENTO -> faz operação no banco
    	$showEvento = $eventos->find($this->_getParam('id'), $evento);
    	
    	$parceiro = $showEvento->findDependentRowSet("Application_Model_Evento");
    	*/
    	/*
    	 if (!$showEvento)
    		return $this->_forward('find', 'eventos');
    	
    	
    	$this->view->evento = $showEvento;
    	*/


    	/*
    	$eventosTable = new Application_Model_DbTable_Eventos();
    	$eventosRowset = $eventosTable->find($this->_getParam('id'));
    	$evento = $eventosRowset->current();
    	$parceiro = $evento->findApplication_Model_DbTable_Parceiros();
    	 
    	$this->view->evento = $evento;
    	$this->view->parceiro = $parceiro;
    	*/
    	
    	$eventosTable = new Application_Model_DbTable_Eventos();
    	$eventoModel = new Application_Model_Evento();
    	$evento = $eventosTable->byId($this->_getParam('id'), $eventoModel);
    	//$parceiro = $evento->findApplication_Model_DbTable_Parceiros();
    	
    	$this->view->evento = $evento;
    	//$this->view->parceiro = $parceiro;
    	        

    }

    

}

