<?php

class Application_Form_EnderecoCadastrar extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	
    	$this->setMethod('post');
    	
    	$this->setAttrib('enctype', 'multipart/form-data');
    	



    	$cidades = new Application_Model_DbTable_LocalCidades();
    	$cidades_list = $cidades->getCidadesList();
    	$this->addElement('select','id_cidade', array(
    			'label' => 'Cidade: ',
    			'multiOptions' => $cidades_list
    	));


    	$this->addElement('textarea', 'rua', array(
    			'label'      => 'Rua (100):',
    			'required'   => true,
    			'rows'		=>	'5'
    	));
    	
    	$this->addElement('textarea', 'numero', array(
    			'label'      => 'Numero (100 char):',
    			'required'   => true,
    			'rows'		=>	'1'
    	));

    	$this->addElement('textarea', 'complemento', array(
    			'label'      => 'Complemento (50 char):',
    			'required'   => true,
    			'rows'		=>	'5'
    	));
    	 
    	 
    	 
    	
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => 'Cadastrar',
    	));
    	
    	$this->addElement('hash', 'csrf', array(
    			'ignore' => true,
    	));
    	
    }


}

