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

    	$eventos = new Application_Model_EventosMapper();
        $evento = new Application_Model_Evento();
    	$showEvento = $eventos->find($this->_getParam('id'), $evento);
    	        
        if (!$showEvento)
        	return $this->_forward('find', 'eventos');

        
    	$this->view->evento = $showEvento;
    }

    

}

