<?php

class EventosController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	
    	$eventos = new Application_Model_DbTable_Eventos();
    	$this->view->eventos = $eventos->findAll();
    	
    }


}

