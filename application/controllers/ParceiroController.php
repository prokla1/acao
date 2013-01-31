<?php

class ParceiroController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->_helper->layout->setLayout('parceiro');
    	$parceirosTable = new Application_Model_DbTable_Parceiros();
    	$parceiroModel = new Application_Model_Parceiro();
    	$parceiro = $parceirosTable->byId($this->_getParam('idP'), $parceiroModel);
    	$this->parceiro = $parceiro;
    	if($parceiro)
    		$this->view->parceiro = $parceiro;
    	else
    		return $this->_helper->redirector('index', 'eventos');
    	   
    	 
    }

    public function indexAction()
    {
    	return $this->_forward('agenda', 'parceiro');
    }
    

    public function agendaAction()
    {
    	$eventos = new Application_Model_DbTable_Eventos();
    	$this->view->eventos = $eventos->findByParceiro($this->parceiro->id, $this->parceiro);
    }

    public function eventoAction()
    {
    	$eventosTable = new Application_Model_DbTable_Eventos();
    	$eventoModel = new Application_Model_Evento();
    	$evento = $eventosTable->byId($this->_getParam('idE'), $eventoModel);
    	//$evento = $eventosTable->byId($this->_getParam('idE'), $eventoModel, $this->parceiro);
    	 
    	if($evento)
    		$this->view->evento = $evento;
    	else
    		return $this->_helper->redirector('index', 'eventos');
    	
    }
    
    
    public function fotosAction()
    {
        // action body
    }

    public function localizacaoAction()
    {
        // action body
    }

    public function contatoAction()
    {
        // action body
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













