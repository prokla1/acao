<?php

class Application_Model_DbTable_Atividades extends Zend_Db_Table_Abstract
{

    protected $_name = 'atividades';




    public function getAtividadesList()  //para popular o select no form de cadastro dos parceiros
    
    {
    	$select  = $this->select()->from($this->_name)
    			->order('nome');
    	$result = $this->getAdapter()->fetchAll($select);
    	return $result;
    	
    }
    
    

    public function byId($id, Application_Model_Atividades $atividade)
    {
    	$result = $this->fetchRow('id = '.$id);
    	$atividades = $atividade->setOptions($result->toArray());
    	return $atividades->getNome();
    }
    




    public function getAll()
    {
    	$resultSet = $this->select()
    	->from($this->_name)
    	->order('nome');
    	$atividades = array();
    	foreach ($resultSet->query() as $row)
    	{
    		$atividadesModel = new Application_Model_Atividades($row);
    		$atividades[] = $atividadesModel;
    	}
    	return $atividades;
    }
    
    
    
}

