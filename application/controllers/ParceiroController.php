<?php

class ParceiroController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->_helper->layout->setLayout('parceiro');
    }

    public function indexAction()
    {

    	$parceirosTable = new Application_Model_DbTable_Parceiros();
    	$parceiroModel = new Application_Model_Parceiro();
    	$parceiro = $parceirosTable->byId($this->_getParam('id'), $parceiroModel);
    	
    	$this->view->parceiro = $parceiro;
    	
    	
    	
    	$eventos = new Application_Model_DbTable_Eventos();
    	$this->view->eventos = $eventos->findByParceiro($this->_getParam('id'));
    	    	  
    }


}

