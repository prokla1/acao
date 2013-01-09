<?php

class Application_Form_Contato extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	

    	$this->setAttrib('enctype', 'multipart/form-data');
    	
    	// Add an nome element
    	$this->addElement('text', 'nome', array(
    			'label'      => 'Seu Nome:',
    			'required'   => true
    	));
    	// Add an email element
    	$this->addElement('text', 'email', array(
    			'label'      => 'Seu email:',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					'EmailAddress',
    			)
    	));
    	

    	// Add the submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => 'Enviar',
    	));
    }


}

