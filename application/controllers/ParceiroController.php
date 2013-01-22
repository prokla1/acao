<?php

class ParceiroController extends Zend_Controller_Action
{

    public function init()
    {

    }

    public function indexAction()
    {
    	$this->_helper->layout->setLayout('parceiro');
    	$parceirosTable = new Application_Model_DbTable_Parceiros();
    	$parceiroModel = new Application_Model_Parceiro();
    	$parceiro = $parceirosTable->byId($this->_getParam('id'), $parceiroModel);
    	
    	$this->view->parceiro = $parceiro;
    	
    	
    	
    	$eventos = new Application_Model_DbTable_Eventos();
    	$this->view->eventos = $eventos->findByParceiro($this->_getParam('id'));
    	    	  
    }

    public function ratingAction()
    {
        $dados = array();
        if($_POST['rating'] > 0 && $_POST['rating'] < 6){
        	
        	$id_parceiro = $_POST['id'];
        	$parceirosTable = new Application_Model_DbTable_Parceiros();
        	$parceiro = $parceirosTable->rating($id_parceiro, $_POST['rating']);
        	
        	$dados['status'] = "sucess";
        	$dados['rating'] = $parceiro->getRating();
        	
        }else{
        	$dados['status'] = "fail";
        	$dados['html']	= "Valor do voto incorreto";
        }
    	
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	
    	$this->_helper->json($dados);
    }


}



