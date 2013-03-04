<?php

class Application_Model_DbTable_RelAtividades extends Zend_Db_Table_Abstract
{

    protected $_name = 'rel_atividade_parceiro';


    /**
     * salva as "ATIVIDADES" de um parceiro ID_PARCEIRO
     */
    public function saveAtividades(array $atividades, $id_parceiro)
    {
    	foreach ($atividades as $atividade)
    	{
    		$data = array('id_atividade' => $atividade, 'id_parceiro' => $id_parceiro);
    		$this->insert($data);
    	}
    }
    
    
    
    
    
    /**
     * Retorna todas as "ATIVIDADES" de um parceiro ID_PARCEIRO
     * @return multitype:Application_Model_Atividades
     */
    public function atividadesByParceiro($id_parceiro)
    {
    	$resultSet = $this->fetchAll("id_parceiro = '$id_parceiro'");
    	$atividades   = array();
    	foreach ($resultSet as $result) {
    		 
    		$atividadeTable = new Application_Model_DbTable_Atividades();
    		$atividade = $atividadeTable->byId($result['id_atividade'], new Application_Model_Atividades());
    
    		$atividades[] = $atividade;
    		 
    	}
    	return $atividades;
    }

}

