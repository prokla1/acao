<?php

class Application_Form_Cadastrar extends Zend_Form
{


    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
       // Set the method for the display form to POST
        $this->setMethod('post');
        
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

        // Add an email element
        $this->addElement('text', 'senha', array(
        		'label'      => 'Crie uma Senha:',
        		'required'   => true,
        		'filters'    => array('StringTrim'),
        		'value'		=> 'senha qualquer'
        ));

        // Add an email element
        $this->addElement('radio', 'sexo', array(
        		'label'      => 'Seu sexo:',
        		'inherit'	 => 'inherit',
        		'required'   => true,
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
        

//         // Add an email element
//         $this->addElement('file', 'foto', array(
//         		'label'      => 'Foto:',
//         		'required'   => true,
//         		'filters'    => array('StringTrim')
//         ));
        
        
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

