<?php

class Application_Model_DbTable_LocalEnderecos extends Zend_Db_Table_Abstract
{

    protected $_name = 'local_enderecos';


    

    public function byId($id, Application_Model_LocalEnderecos $localEndereco)
    {
    	$result = $this->fetchRow('id = '.$id);
    
    	$endereco = $result->toArray();
    	$localEndereco->setOptions($endereco);
    	$localEndereco->setCidade($result->id_cidade);
    	return $localEndereco;
    	
    }
}

