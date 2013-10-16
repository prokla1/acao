<?php

class Application_Form_Usuario extends Zend_Form
{


    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
       // Set the method for the display form to POST
        $this->setMethod('post');
        
        $this->setAttrib('enctype', 'multipart/form-data');

        $this->addElement('text', 'nome', array(
        		'label'      => 'Nome:',
        		'required'   => true
        )); 
        
        $this->addElement('text', 'email', array(
            'label'      => 'Email:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                'EmailAddress',
            )
        )); 

        $this->addElement('text', 'cpf', array(
            'label'      => 'CPF:',
            'required'   => false,
            'filters'    => array('StringTrim'),
        ));


        // Add an email element
        $this->addElement('radio', 'sexo', array(
        		'label'      => 'Seu sexo:',
        		'inherit'	 => 'inherit',
        		'required'   => false,
        		'multiOptions'	=>	array(
        				'1'=>'Masculino', '2'=>'Feminino'
        				),
        		'separator' => '',
        		'value'		=> '0'
        ));

        // Add an email element
        $this->addElement('text', 'nascimento', array(
        		'label'      => 'Data de nascimento:',
        		'value'		=>	'1982-11-21',
        		'required'   => true,
        		'filters'    => array('StringTrim')
        ));
        

        
        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Cadastrar',
        ));
 
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }

}

