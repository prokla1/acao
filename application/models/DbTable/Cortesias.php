<?php

class Application_Model_DbTable_Cortesias extends Zend_Db_Table_Abstract
{

    protected $_name = 'cortesias';





    /**
     * Retorna todas as "CORTESIAS" de um evento
     * @return multitype:Application_Model_Cortesias
     */
    public function cortesiasByEvento($idEvento)
    {
    	$resultSet = $this->fetchAll("id_evento = '$idEvento'");
    	$cortesias   = array();
    	foreach ($resultSet as $result) {
    	  
    		$cortesia = new Application_Model_Cortesias();
    		$cortesia->setOptions($result->toArray());
    
    		$cortesias[] = $cortesia;
    	  
    	}
    	return $cortesias;
    }
    





    /**
     * Retorna todas as "CORTESIAS" de um ID
     * @return multitype:Application_Model_Cortesias
     */
    public function byId($id, Application_Model_Cortesias $cortesia)
    {
    	$result = $this->fetchRow('id = '.$id);
    	$cortesias = $result->toArray();
    	$cortesia->setOptions($cortesias);
    	$cortesia->setEvento($cortesia->getId_evento());
    	return $cortesia;
    }
    
    
    
      
}

