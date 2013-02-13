<?php

class SiteController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function contatoAction()
    {
    	$request = $this->getRequest();
    	$form    = new Application_Form_Contato();
    	 
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			
    			$msg = '<b>Contato</b>;' . json_encode($form->getValues());
    			$mail = new Zend_Mail('utf-8');
    			$mail->setBodyHtml($msg);
    			$mail->addTo('ju.impossivel@gmail.com', 'Juscelino');
    			$mail->addTo('gutoatk@gmail.com', 'Elias');
    			$mail->setSubject('eVenter - contato');
    			$mail->send();
    			
    			$form->removeElement('submit');
    			$this->view->msg = 'Contato enviado com sucesso';
    		}
    	}
    	$this->view->form = $form;
    }

    public function trabalheConoscoAction()
    {
    	$request = $this->getRequest();
    	$form    = new Application_Form_Contato();
    	 
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			
    			$msg = '<b>Contato</b>;' . json_encode($form->getValues());
    			$mail = new Zend_Mail('utf-8');
    			$mail->setBodyHtml($msg);
    			$mail->addTo('ju.impossivel@gmail.com', 'Juscelino');
    			$mail->addTo('gutoatk@gmail.com', 'Elias');
    			$mail->setSubject('eVenter - contato');
    			$mail->send();
    			
    			$form->removeElement('submit');
    			$this->view->msg = 'Contato enviado com sucesso';
    		}
    	}
    	$this->view->form = $form;
    }

    public function divulgueSeuEventoAction()
    {

    }

    public function divulgarEventoAction()
    {
    	$request = $this->getRequest();
    	$form    = new Application_Form_Contato();
    	 
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			
    			$msg = '<b>Contato</b>;' . json_encode($form->getValues());
    			$mail = new Zend_Mail('utf-8');
    			$mail->setBodyHtml($msg);
    			$mail->addTo('ju.impossivel@gmail.com', 'Juscelino');
    			$mail->addTo('gutoatk@gmail.com', 'Elias');
    			$mail->setSubject('eVenter - contato');
    			$mail->send();
    			
    			$form->removeElement('submit');
    			$this->view->msg = 'Contato enviado com sucesso';
    		}
    	}
    	$this->view->form = $form;
    }

    public function comoFuncionaAction()
    {
        // action body
    }

    public function politicaDePrivacidadeAction()
    {
        // action body
    }

    public function termosDeUsoAction()
    {
        // action body
    }


}















