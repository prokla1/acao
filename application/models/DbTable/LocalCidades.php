<?php

class Application_Model_DbTable_LocalCidades extends Zend_Db_Table_Abstract
{

    protected $_name = 'local_cidades';




    public function byId($id, Application_Model_LocalCidades $localCidades)
    {
    	$result = $this->fetchRow('id = '.$id);

    	$cidade = $result->toArray();
    	$localCidades->setOptions($cidade);
    	$localCidades->setEstado($result->id_estado);
    	return $localCidades;
    }
}

