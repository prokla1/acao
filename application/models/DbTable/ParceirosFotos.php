<?php

class Application_Model_DbTable_ParceirosFotos extends Zend_Db_Table_Abstract
{

    protected $_name = 'parceiros_fotos';

    
    

    /**
     * Retorna todas as "FOTOS" de um parceiro ID_PARCEIRO
     * @return multitype:Application_Model_ParceirosFotos
     */
    public function fotosByParceiro($id_parceiro)
    {
    	$resultSet = $this->fetchAll("id_parceiro = '$id_parceiro'");
    	$fotos   = array();
    	foreach ($resultSet as $result) {
    		 
    		$foto = new Application_Model_ParceirosFotos();
    		$foto->setOptions($result->toArray());
    
    		$fotos[] = $foto;
    		 
    	}
    	return $fotos;
    }
    

    public function del($id, $parceiro = null)
    {
    	$where = array(
    			$this->getAdapter()->quoteInto('id = ?', $id),
    			$this->getAdapter()->quoteInto('id_parceiro = ?', $parceiro)
    	);
    	return $this->delete($where);
    }
    

}

