<?php

class EventoController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->_helper->layout->setLayout('parceiro');
    	/*
    	$sess = new Zend_Session_Namespace('City');
    	$this->cityId = $sess->id;
    	$this->cityNome = $sess->nome;
    	$this->view->cityNome = $this->cityNome;
    	*/
    }

    
    
    /**
     * Exibe o EVENTO
     */
    public function indexAction()
    {
    	
    	$eventosTable = new Application_Model_DbTable_Eventos();
    	$eventoModel = new Application_Model_Evento();
    	$evento = $eventosTable->byId($this->_getParam('id'), $eventoModel);
    	
    	if($evento)
    		$this->view->evento = $evento;
    	else
    		return $this->_helper->redirector('index', 'eventos');
    	 
    	
    	$this->view->parceiro = $evento->getParceiro();
    	
    	/*
    	$parceirosTable = new Application_Model_DbTable_Parceiros();
    	$parceiroModel = new Application_Model_Parceiro();
    	$parceiro = $parceirosTable->byId($evento->id_parceiro, $parceiroModel);
    	 
    	$this->view->parceiro = $parceiro;
    	*/

    }

    

}

