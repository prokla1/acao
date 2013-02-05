<?php

class ParceiroController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->_helper->layout->setLayout('parceiro');
    	
    	if($this->_getParam('url'))
    	{
    		$parceirosTable = new Application_Model_DbTable_Parceiros();
    		$parceiroModel = new Application_Model_Parceiro();
    		$parceiro = $parceirosTable->byUrl($this->_getParam('url'), $parceiroModel);
    	}else {
    	
	    	$parceirosTable = new Application_Model_DbTable_Parceiros();
	    	$parceiroModel = new Application_Model_Parceiro();
	    	$parceiro = $parceirosTable->byId($this->_getParam('idP'), $parceiroModel);
    	}
	    	$this->parceiro = $parceiro;
	    	if($parceiro)
	    		$this->view->parceiro = $parceiro;
	    	else
	    		return $this->_helper->redirector('index', 'eventos');
	    	
	    	
	    	
	    	
	    	$action = $this->getRequest()->getActionName();
	    	if($action == 'fotos' || $action == 'localizacao' || $action == 'contato' || $action == 'agenda' )
	    	{
	    		//$this->_forward($action);
// 	    		return print_r($this->_getAllParams());
	    	}else
	    	{
// 	    		print_r($this->_getAllParams());
// 	    		print_r("<hr>");
	    		
	    		// forward to an action in another controller:
	    		// FooController::bazAction(),
	    		// in the current module:
	    		$this->_forward('evento', null, null, array('urlE' => $action));
	    		
	    	}
    	   
    	 
    }

    public function urlAction()  //para url amigável, envia direto do library/Helpers/ShowParceiro.php pra cá
    {
    	//$controller = $this->getRequest()->getControllerName();
    	$action = $this->getRequest()->getActionName();
    	
    	if($action == 'fotos' || $action == 'localizacao' || $action == 'contato' || $action == 'agenda' )
    	{
    		$this->_forward($action);
    	}else 
    	{
    		//return print_r($this->_getAllParams());
    	}
//     		if($action == 'evento')
//     		{
//     			//$this->_forward($action);
//     			//return print_r($this->_getAllParams());
//     		}
    		//print_r($this->_getAllParams());
    		//return $this->_forward($action);
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
    	
    	//print_r($this->_getAllParams());
    	
    	if($this->_getParam('urlE'))
    	{
    		$eventosTable = new Application_Model_DbTable_Eventos();
    		$eventoModel = new Application_Model_Evento();
    		$evento = $eventosTable->byUrl($this->_getParam('urlE'), $eventoModel);    		
    	}else
    	{
    		print_r($this->_getAllParams());
    		
    		if(is_numeric($this->_getParam('idE')))
    		{
    			$eventosTable = new Application_Model_DbTable_Eventos();
    			$eventoModel = new Application_Model_Evento();
    			$evento = $eventosTable->byId($this->_getParam('idE'), $eventoModel);
    			//$evento = $eventosTable->byId($this->_getParam('idE'), $eventoModel, $this->parceiro);
    			 
    			if(empty($evento))
    			{
    				$eventosTable = new Application_Model_DbTable_Eventos();
    				$eventoModel = new Application_Model_Evento();
    				$evento = $eventosTable->byNext($this->parceiro->id, $eventoModel);
    			}
    		}else
    		{
    			$eventosTable = new Application_Model_DbTable_Eventos();
    			$eventoModel = new Application_Model_Evento();
    			$evento = $eventosTable->byNext($this->parceiro->id, $eventoModel);
    		}    		
    	}
    	

    	
    	if($evento)
    		$this->view->evento = $evento;
    	else
    		return $this->_forward('agenda', 'parceiro');
    	
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













