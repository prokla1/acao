<?php

class Application_Form_ContatoParceiro extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	

    	$this->setAttrib('enctype', 'multipart/form-data');

    	$this->addElement('hidden', 'id_parceiro', array(
    			'required'   => false
    	));
    	 

    	$this->addElement('text', 'nome', array(
    			'label'      => 'Seu Nome',
    			'required'   => true
    	));
    	$this->getElement('nome')->addErrorMessage('Insira seu nome');
    	 
    	 
    	$this->addElement('text', 'email', array(
    			'label'      => 'Seu email',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					'EmailAddress',
    			)
    	));
    	$this->getElement('email')->addErrorMessage('Informe seu email corretamente');

    	
    	$this->addElement('text','assunto', array(
    			'label' => 'Assunto',
    			'required' => true,
    	));
    	$this->getElement('assunto')->addErrorMessage('Informe o assunto');
    		 
    	
    	$this->addElement('textarea', 'mensagem', array(
    			'label'      => 'Mensagem',
    			'required'   => true,
    			'rows'		=>	'5',
    			'cols'		=> '25'
    	));
    	$this->getElement('mensagem')->addErrorMessage('Crie uma mensagem');
    	 
    	 
    	
    	
    	// Add the submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => 'Enviar',
    	));
    }


}

