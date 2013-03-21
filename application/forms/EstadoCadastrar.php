<?php

class Application_Form_EstadoCadastrar extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	
    	$this->setMethod('post');
    	$this->setAttrib('id', 'form_estados');
    	
    	$this->setAttrib('enctype', 'multipart/form-data');
    	



    	$paises = new Application_Model_DbTable_LocalPais();
    	$paises_list = $paises->getPaisList();
    	$this->addElement('select','id_pais', array(
    			'label' => 'País: ',
    			'multiOptions' => $paises_list
    	));


    	$this->addElement('text', 'nome', array(
    			'label'      => 'Nome (100):',
    			'required'   => true,
    			//'rows'		=>	'2',
    			//'cols'		=> '35'
    	));
    	$this->getElement('nome')->addErrorMessage('Informe o nome do estado');
    	 

    	$this->addElement('text', 'sigla', array(
    			'label'      => 'Sigla (2) (em maiusculo):',
    			'required'   => true,
    	));
    	$this->getElement('sigla')->addErrorMessage('Informe a sigla do estado');
    	 
    	

    	$this->addElement('radio', 'ativo', array(
    			'label'      => 'Ativo?:',
    			'inherit'	 => 'inherit',
    			'required'   => true,
    			'multiOptions'	=>	array(
    					'0'=>'Não', '1'=>'Sim'
    			),
    			'separator' => '',
    			'value'		=> '1'
    	));
    	
    	
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => 'Cadastrar',
    	));
    	
    	
    }


}

