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
    		$data = array(
    				'id_atividade'	=>	$atividade, 
    				'id_parceiro'	=>	$id_parceiro,
    				'ativo'			=>	'1'
    				);
    		$this->insert($data);
    	}
    	return $this;
    }
    
    
    
    
    
    /**
     * Retorna todas as "ATIVIDADES" de um parceiro ID_PARCEIRO
     * @return multitype:Application_Model_Atividades
     */
    public function byParceiro($parceiro)
    {
    	$atividades = array();
    
    	$resultSet = $this->select()
    	->setIntegrityCheck(false)
    	->from($this->_name)
    	->joinRight(
    			array(
    					'atividades'		=>	'atividades'
    			),
    			'atividades.id			=	rel_atividade_parceiro.id_atividade',
    			array(
    					'atividade_nome'	=>	'atividades.nome',
    			)
    	)
    	->where("rel_atividade_parceiro.id_parceiro = ?", $parceiro)
    	->order('atividades.nome');
    
    	foreach($resultSet->query() as $row)
    	{
    		$atividade = new Application_Model_RelAtividades($row);
    		$atividades[] = $atividade;
    	}
    	return $atividades;
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

