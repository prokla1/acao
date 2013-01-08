<?php

class LocalidadeController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        

	     	$cidadesTable = new Application_Model_DbTable_LocalCidades();
	    	$this->view->localidades = $cidadesTable->cidadesName();

    	
    }

    public function setAction()
    {
        // action body
    }


}



