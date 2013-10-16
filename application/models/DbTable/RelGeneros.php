<?php

class Application_Model_DbTable_RelGeneros extends Zend_Db_Table_Abstract
{

    protected $_name = 'rel_genero_evento';


    /**
     * salva os "GENEROS" de um evento ID_EVENTO
     */
    public function saveGeneros(array $generos, $id_evento)
    {
    	foreach ($generos as $genero)
    	{
    		$data = array('id_genero' => $genero, 'id_evento' => $id_evento);
    		$this->insert($data);
    	}
    }
    
    
    
    
    
    /**
     * Retorna todas os "GENEROS" de um evento ID_EVENTO
     * @return Application_Model_DbTable_Generos
     */
    public function generosByEvento($id_evento)
    {
    	$resultSet = $this->fetchAll("id_evento = '$id_evento'");
    	$generos   = array();
    	foreach ($resultSet as $result) {
    		 
    		$generoTable = new Application_Model_DbTable_Generos();
    		$genero = $generoTable->byId($result['id_genero'], new Application_Model_Generos());
    
    		$generos[] = $genero;
    		 
    	}
    	return $generos;
    }

}

