<?php

class Application_Form_ParceirofotosCadastrar extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	
    	$this->setMethod('post');

    	$this->setAttrib('enctype', 'multipart/form-data');
    	$this->setAttrib('id', 'form_fotos_parceiro');
    	



    	$parceiros = new Application_Model_DbTable_Parceiros();
    	$parceiros_list = $parceiros->getParceirosList();
    	$this->addElement('select','id_parceiro',
    			array(
    					'label' => 'Parceiro: ',
    					'multiOptions' => $parceiros_list
    			));
    	
    	 
    	 

    	$this->addElement('file', 'url[]', array(
    			'label'			=> 'Fotos do parceiro:',
    			'multiple'		=> true,
    			//'setIsArray'	=>	true,
    			'filters' 		=> array('StringTrim')
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

