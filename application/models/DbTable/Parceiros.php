<?php

class Application_Model_DbTable_Parceiros extends Zend_Db_Table_Abstract
{

    protected $_name = 'parceiros';

    


    public function byId($id, Application_Model_Parceiro $parceiro)
    {
    	$result = $this->fetchRow('id = '.$id);
    	 
    	//$row = $result->current();
    
    	//$eventoArray = $result->toArray();
    	$parceiros = $result->toArray();
    	 
    	$parceiro->setOptions($parceiros);
    	 
    	/*
    	 $evento->setId($result->id);
    	$evento->setId_parceiro($result->id_parceiro);
    	$evento->setNome($result->nome);
    	$evento->setDescricao($result->descricao);
    	$evento->setAtivo($result->ativo);
    	$evento->setRealizacao($result->realizacao);
    	$evento->setHora($result->hora);
    	*/
    	//$evento->setParceiro($result->id_parceiro);
    	 
    
    	//return $result;
    	 
    	echo "<pre>";
    	print_r($parceiro) ;//->getArray());
    	echo "</pre>";
    }
    
    
}

