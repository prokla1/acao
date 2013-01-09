<?php

class LocalidadeController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	if ($this->_getParam('id') > 0)
    	{
    		 $sess = new Zend_Session_Namespace('City');
    		 $sess->id = $this->_getParam('id');
    		 $sess->nome = $this->getParam('nome');
    		 
    		 
    		 header("Location: /eventos");
    		 //return $this->_forward('index', 'eventos');
    	}
    }

    public function indexAction()
    {
        //print_r($this->_getAllParams());
    	$cidadesTable = new Application_Model_DbTable_LocalCidades();
    	$localidades = $cidadesTable->cidadesName();
    	$this->view->localidades = $localidades;
    	
    	/*
    	$estadoTable = new Application_Model_DbTable_LocalEstados();
    	$estados = $estadoTable->fetchAll();
    	$this->view->localidades = $estados;
    	*/

    	
    }

    public function setAction()
    {
        // action body
    }


}



