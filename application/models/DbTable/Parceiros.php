<?php

class Application_Model_DbTable_Parceiros extends Zend_Db_Table_Abstract
{

    protected $_name = 'parceiros';

    


    public function byId($id, Application_Model_Parceiro $parceiro)
    {
    	$result = $this->fetchRow('id = '.$id);
    	 
    	$parceiros = $result->toArray();    	 
    	$parceiro->setOptions($parceiros);
    	$parceiro->setLocal($result->id_endereco);
    
    	return $parceiro;
    }
    
    
}

