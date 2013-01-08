<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    	//return $this->_forward('index', 'eventos');  //carrega o conteudo do controller EVENTOS, na action INDEX
    	//$this->_helper->redirector->goToRoute( array('controller' => 'eventos', 'action'=> 'index'));  // faz o mesmo que o de cima, mas neste caso redireciona

    }


}

