<?php

class EventosController extends Zend_Controller_Action
{

    public function init()
    {
    	
    	
    	$session = new Zend_Session_Namespace('city');
  	
     	if(empty($_SESSION['city'])) {

    		//header("Location: /localidade");
    		//return $this->_helper->redirector->goToRoute( array('controller' => 'localidade', 'action'=> 'index'));
    		return $this->_forward('index', 'localidade');  //carrega o conteudo do controller LOCALIDADE, na action INDEX
    		//$this->_helper->redirector->goToRoute( array('controller' => 'localidade', 'action'=> 'index'));
    		//return;
    	}else {
    		echo "Cidade:".$_SESSION['city']['id'];
    	}
    }
    
    

    public function indexAction()
    {
    	$eventos = new Application_Model_DbTable_Eventos();
    	$this->view->eventos = $eventos->findAll();
    	
    	$eventosTable = new Application_Model_DbTable_Eventos();
    	$this->view->destaques = $eventosTable->findDestaques();
    }

    

}

