<?php

class Application_Model_DbTable_LocalEstados extends Zend_Db_Table_Abstract
{

    protected $_name = 'local_estados';



    public function byId($id, Application_Model_LocalEstados $localEstados)
    {
    	$result = $this->fetchRow('id = '.$id);
    
    	$estado = $result->toArray();
    	$localEstados->setOptions($estado);
    	$localEstados->setPais($result->id_pais);
    	return $localEstados;
    }
    
    
}

