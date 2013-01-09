<?php

class EventoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	$sess = new Zend_Session_Namespace('City');
    	$this->cityId = $sess->id;
    	$this->cityNome = $sess->nome;
    	$this->view->cityNome = $this->cityNome;
    }

    
    
    /**
     * Exibe o EVENTO
     */
    public function indexAction()
    {
    	
    	$eventosTable = new Application_Model_DbTable_Eventos();
    	$eventoModel = new Application_Model_Evento();
    	$evento = $eventosTable->byId($this->_getParam('id'), $eventoModel);
    	
    	$this->view->evento = $evento;

    }

    

}

