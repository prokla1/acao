<?php

class Application_Form_EventoCadastrar extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	
    	$this->setMethod('post');
    	
    	$this->setAttrib('enctype', 'multipart/form-data');
    	



    	$generos = new Application_Model_DbTable_Generos();
    	$generos_list = $generos->getGenerosList();
    	$this->addElement('multiCheckbox','id_genero', array(
    			'label' => 'Generos do Evento: ',
    			'required' => true,
    	));
    	foreach ($generos_list as $gen)
    	{
    		$this->getElement('id_genero')->addMultiOption($gen['id'], $gen['nome']);
    		 
    	}


    	$enderecos = new Application_Model_DbTable_LocalEnderecos();
    	$endereco_list = $enderecos->getEnderecosList();
    	$this->addElement('select','id_endereco',
    			array(
    					'label' => 'Endereço: ',
    					'multiOptions' => $endereco_list
    			));



    	$parceiros = new Application_Model_DbTable_Parceiros();
    	$parceiros_list = $parceiros->getParceirosList();
    	$this->addElement('select','id_parceiro',
    			array(
    					'label' => 'Parceiro: ',
    					'multiOptions' => $parceiros_list
    			));
    	 

    	// Add an email element
    	$this->addElement('text', 'realizacao', array(
    			'label'      => 'Data de realizaçào:',
    			'value'		=>	date('d/m/Y', strtotime("+1 days")),
    			'required'   => true,
    			'filters'    => array('StringTrim')
    	));


    	$this->addElement('text', 'nome', array(
    			'label'      => 'Nome do Evento:',
    			'required'   => true
    	));
    	
    	$this->addElement('text', 'url_amigavel', array(
    			'label'      => 'URL do evento:',
    			'required'   => true
    	));

    	$this->addElement('textarea', 'descricao', array(
    			'label'      => 'Descricao do Evento:',
    			'required'   => true,
    			'class'		=>	'ckeditor'
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
    	
    	$this->addElement('radio', 'destaque', array(
    			'label'      => 'Destaque?:',
    			'inherit'	 => 'inherit',
    			'required'   => true,
    			'multiOptions'	=>	array(
    					'0'=>'Não', '1'=>'Sim'
    			),
    			'separator' => '',
    			'value'		=> '0'
    	));
    	
    	


    	$this->addElement('file', 'capa', array(
    	        'label'      => 'Capa:',
    	        'required'   => true,
    	        'filters'    => array('StringTrim')
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

