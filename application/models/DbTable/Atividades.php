<?php

class Application_Model_DbTable_Atividades extends Zend_Db_Table_Abstract
{

    protected $_name = 'atividades';


    

    public function byId($id, Application_Model_Atividades $atividade)
    {
    	$result = $this->fetchRow('id = '.$id);
    	$atividades = $atividade->setOptions($result->toArray());
    	return $atividades->getNome();
    }
    
    
}

