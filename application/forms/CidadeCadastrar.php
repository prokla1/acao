<?php

class Application_Form_CidadeCadastrar extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	
    	$this->setMethod('post');
    	
    	$this->setAttrib('enctype', 'multipart/form-data');
    	



    	$estados = new Application_Model_DbTable_LocalEstados();
    	$estados_list = $estados->getEstadosList();
    	$this->addElement('select','id_estado', array(
    			'label' => 'Estado: ',
    			'multiOptions' => $estados_list
    	));


    	$this->addElement('textarea', 'nome', array(
    			'label'      => 'Nome (100):',
    			'required'   => true,
    			'rows'		=>	'5'
    	));
    	

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
    	
    	$this->addElement('hash', 'csrf', array(
    			'ignore' => true,
    	));
    	
    }


}

