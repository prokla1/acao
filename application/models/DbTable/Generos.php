<?php

class Application_Model_DbTable_Generos extends Zend_Db_Table_Abstract
{

    protected $_name = 'generos';




    public function getGenerosList()  //para popular o select no form de cadastro dos EVENTOS
    
    {
    	$select  = $this->select()->from($this->_name)
    			->order('nome');
    	$result = $this->getAdapter()->fetchAll($select);
    	return $result;
    	
    }
    
    

    public function byId($id, Application_Model_Generos $genero)
    {
    	$result = $this->fetchRow('id = '.$id);
    	$generos = $genero->setOptions($result->toArray());
    	return $generos->getNome();
    }
    
    
}

