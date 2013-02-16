<?php

class Application_Form_News extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
    	$this->setAttrib('enctype', 'multipart/form-data');
    	$this->setAttrib('id', 'form_news_add');


    	$cidades = new Application_Model_DbTable_LocalCidades();
    	$cidades_list = $cidades->getCidadesList();
    	$this->addElement('select','id_cidade', array(
    			'label' => 'Cidade: ',
    			'multiOptions' => $cidades_list
    	));

    	$this->addElement('text', 'email', array(
    			'label'      => 'Email:',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					'EmailAddress',
    			)
    	));
    	$this->getElement('email')->addErrorMessage('Insira seu email corretamente');
    	 
    	
//     	$this->addElement('submit', 'submit', array(
//     			'ignore'   => true,
//     			'label'    => 'Cadastrar',
//     	));
    	
    	
    }


}

