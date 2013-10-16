<?php

class Application_Form_Contato extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	

    	$this->setAttrib('enctype', 'multipart/form-data');
    	
    	$this->addElement('text', 'nome', array(
    			'label'      => 'Seu Nome',
    			'required'   => true
    	));
    	$this->getElement('nome')->addErrorMessage('Insira seu nome');
    	
    	$this->addElement('text', 'email', array(
    			'label'      => 'Seu email',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'errormessage' => 'insira o email corretamente',
    			'validators' => array(
    					'EmailAddress',
    			)
    	));
    	$this->getElement('email')->addErrorMessage('Insira seu email corretamente');
    	
    	$this->addElement('text', 'telefone', array(
    			'label'      => 'Telefone',
    			'required'   => false
    	));

    	$this->addElement('select','assunto', array(
    			'label' => 'Assunto',
    			'required' => true,
    	));
    	$this->getElement('assunto')->addMultiOption('Contato', 'Contato');
    	$this->getElement('assunto')->addMultiOption('Divulgar Eventos', 'Divulgar Eventos');
    	$this->getElement('assunto')->addMultiOption('Trabalhe Conosco', 'Trabalhe Conosco');
    	$this->getElement('assunto')->addMultiOption('Dúvidas e reclamações', 'Dúvidas e reclamações');
    		 
    	
    	
    	
    	$this->addElement('textarea', 'mensagem', array(
    			'label'      => 'Mensagem',
    			'required'   => true,
    			'rows'		=>	'5'
    	));
    	$this->getElement('mensagem')->addErrorMessage('Crie uma mensagem');
    	 
    	 
    	
    	
    	// Add the submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => 'Enviar',
    	));
    }


}

