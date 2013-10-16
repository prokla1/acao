<?php

class SourcesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function getCidadesAction()
    {
        $this->_helper->layout->setLayout('ajax');
        if($this->_getParam('id_estado'))
        {
        	$cidades = new Application_Model_DbTable_LocalCidades();
        	$cidades_list = $cidades->cidadesEstado($this->_getParam('id_estado', 0));
        	$this->_helper->json($cidades_list);        	
        }
    }

    public function getEnderecosAction()
    {
        $this->_helper->layout->setLayout('ajax');
        if($this->_getParam('id_cidade'))
        {
        	$enderecosTable = new Application_Model_DbTable_LocalEnderecos();
        	$enderecos = $enderecosTable->enderecosCidade($this->_getParam('id_cidade', 0));
        	$this->_helper->json($enderecos);        	
        }
    }


}





