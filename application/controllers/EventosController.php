<?php

class EventosController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
       // $eventos = "array com os eventos";
    	
    	
    	/*
    	$eventosModel = new Application_Model_EventosMapper();
    	$eventos = $eventosModel->fetchAll();
    	//$eventos = $eventosModel->findAllEventos();
		$this->view->eventos = $eventos;
		*/
    	
    	$eventosModel = new Application_Model_Evento();
    	$eventos = new Application_Model_DbTable_Eventos();
    	$this->view->eventos = $eventos->findAll();
    	
    }


}

