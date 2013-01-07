<?php

class Application_Model_DbTable_LocalPais extends Zend_Db_Table_Abstract
{

    protected $_name = 'local_pais';


    public function byId($id, Application_Model_LocalPais $localPais)
    {
    	$result = $this->fetchRow('id = '.$id);
    
    	$pais = $result->toArray();
    	$localPais->setOptions($pais);
    	return $localPais;
    }
    
}

