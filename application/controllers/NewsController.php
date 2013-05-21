<?php

class NewsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	$this->_helper->layout->setLayout('ajax');
    }

    public function indexAction()
    {
//         	$form = new Application_Form_News();
//     		$this->view->form = $form;
    }

    public function entrarAction()
    {
    	$msg = array();
    	if ( $this->getRequest()->isPost() ) {
    		$form = new Application_Form_News();
    		$data = $this->getRequest()->getPost();
    		
    		if ( $form->isValid($data) ) {
    			 
    			try {
	    			$newsTable = new Application_Model_DbTable_News();
	    			$newsTable->insert($data);
	    			$msg[] = "Cadastrado com sucesso <p>Aguarde as novidades no seu email</p>";
	    			$msg[] = "<script>$('#submit_news').hide()</script>";
    			} catch (Exception $e) {
    				$form->populate($data);
    				$this->view->form = $form;
    				$msg[] = $e->getMessage();
    			}
    			 
    		} else {
    			$form->populate($data);
    			$this->view->form = $form;
    			$msg[] = 'Dados incorretos, verifique';
    		}
    	}else {
    		$msg[] = 'Dados enviados incorretamente';
    	}
    	$this->view->msg = $msg;
    	//$this->_helper->json($dados);
    	
    }


}



