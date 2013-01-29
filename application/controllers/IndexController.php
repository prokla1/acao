<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    	$sess = new Zend_Session_Namespace('City');
    	$this->cityId = $sess->id;
     	$this->cityNome = $sess->nome;
     	$this->view->cityNome = $this->cityNome;
    }
    
    

    public function indexAction()
    {

    	if(empty($this->cityId))
    	{
    		return $this->_forward('index', 'localidade');
    	}
    	
        // action body
    	return $this->_forward('index', 'eventos');  //carrega o conteudo do controller EVENTOS, na action INDEX
    	//$this->_helper->redirector->goToRoute( array('controller' => 'eventos', 'action'=> 'index'));  // faz o mesmo que o de cima, mas neste caso redireciona

    }


}

