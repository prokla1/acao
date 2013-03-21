<?php

class Application_Form_ParceiroCadastrar extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	
    	$this->setMethod('post');
    	$this->setAttrib('id', 'form_parceiros');
    	
    	$this->setAttrib('enctype', 'multipart/form-data');
    	



    	$enderecos = new Application_Model_DbTable_LocalEnderecos();
    	$endereco_list = $enderecos->getEnderecosList();
    	$this->addElement('select','id_endereco', array(
    			'label' => 'Endereço: ',
    			'multiOptions' => $endereco_list
    	));
    	



    	$atividades = new Application_Model_DbTable_Atividades();
    	$atividades_list = $atividades->getAtividadesList();
    	$this->addElement('multiCheckbox','id_atividade', array(
    			'label' => 'Atividades do parceiro: ',
    			'required' => false,
    	));
	    	foreach ($atividades_list as $atv)
	    	{
	    		$this->getElement('id_atividade')->addMultiOption($atv['id'], $atv['nome']);
	    		
	    	}
    	
    	 
    	$this->addElement('text', 'nome', array(
    			'label'      => 'Nome do Parceiro (100):',
    			'required'   => true
    	));
    	$this->addElement('text', 'telefone', array(
    			'label'      => 'Telefone do Parceiro (15 char):',
    			'required'   => false
    	));
    	
    	$this->addElement('text', 'url_amigavel', array(
    			'label'      => 'URL do Parceiro:',
    			'required'   => true
    	));

    	$this->addElement('textarea', 'descricao', array(
    			'label'      => 'Descricao do Parceiro:',
    			'required'   => false,
    			'rows'		=>	'20',
    			'class'		=>	'ckeditor'
    	));
    	 


    	$this->addElement('textarea', 'funcionamento', array(
    			'label'      => 'Horários de Funcionamento:',
    			'required'   => false,
    			'rows'		=>	'10',
    			'class'		=>	'ckeditor'
    	));
    	
    	 


    	$this->addElement('textarea', 'pagamento', array(
    			'label'      => 'Sobre o pgto',
    			'required'   => false,
    			'rows'		=>	'10',
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
    	 
    	 
    	
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => 'Cadastrar',
    	));
    	
    	
    }


}

