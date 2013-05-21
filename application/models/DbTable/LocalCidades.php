<?php

class Application_Model_DbTable_LocalCidades extends Zend_Db_Table_Abstract
{

    protected $_name = 'local_cidades';


    
    

    public function getCidadesList()  //para popular o select no form de cadastro dos endereços
    {
    	$resultSet = $this->select()
    	->setIntegrityCheck(false)
    	->from(  
    			array(
    					'local_cidades' => 'local_cidades'
    			),
    			array(
    					'local_cidades_id'			=>	'local_cidades.id',
    					'local_cidades_nome'		=>	'local_cidades.nome',
    					'local_cidades_id_estado'	=>	'local_cidades.id_estado'
    			)
    	)
    	->joinLeft( 
    			array(
    					'local_estados'				=>	'local_estados'
    			),
    			'local_estados.id					=	local_cidades.id_estado',
    			array(
    					'local_estados_sigla'		=>	'local_estados.sigla',
    					'local_estados_id_pais'		=>	'local_estados.id_pais'
    			)
    	)
    	->joinLeft( 
    			array(
    					'local_pais'			=>	'local_pais'
    			),
    			'local_pais.id					=	local_estados.id_pais',
    			array(
    					'local_nome_pais'		=>	'local_pais.nome',
    					'local_sigla_pais'		=>	'local_pais.sigla'
    			)
    	)
    	->order('local_cidades_nome')
    	->query()
    	->fetchAll();
    	$entries = array();
    	foreach ($resultSet as $row) {
    		$array = array();
    		$array['key'] = $row['local_cidades_id'];
    		$array['value'] =
    		$row['local_cidades_nome'] . ", " .
    		$row['local_estados_sigla'] . " - " .
    		$row['local_sigla_pais']  
    				;
    				$entries[] = $array;
    	}
    	return $entries;
    }
    


    public function byId($id, Application_Model_LocalCidades $localCidades)
    {
    	$result = $this->fetchRow('id = '.$id);

    	if($result)
    	{
    		$cidade = $result->toArray();
    		$localCidades->setOptions($cidade);
    		$localCidades->setEstado($result->id_estado);    		
    	}else
    	{
    		$localCidades = null;
    	}

    	return $localCidades;
    }

    
    /**
     * Tras todas cidades
     * @return multitype:Application_Model_LocalEstados
     */
    public function getAll()
    {
    	$resultSet = $this->select()
    	->from($this->_name)
    	->order('nome');
    	$cidades = array();
    	foreach ($resultSet->query() as $row)
    	{
    		//print_r($row);
    		$localCidades = new Application_Model_LocalCidades();
    		$localCidades->setOptions($row);
    		$localCidades->setEstado($row['id_estado']);
    		$cidades[] = $localCidades;
    		/*
    		 $cidades[] = $this->byId($row['id'], new Application_Model_LocalCidades());
    		*/
    	}
    	return $cidades;
    }
    
     

    

    /**
     * Retorna todas as cidades de um estado ($id_estado)
     * @param unknown_type $id_estado
     * @return multitype:Application_Model_LocalCidades
     */
    public function cidadesEstado($id_estado)
    {
    	$resultSet = $this->select()
    	->from('local_cidades')
    	->where('id_estado = ?', $id_estado)
    	->where('ativo = ?', '1')
    	->order('nome')
    	->query();
    	$cidades = array();
    	foreach ($resultSet as $row) 
    	{
    		$cidadeModel = new Application_Model_LocalCidades();
    		$cidadeModel->setOptions($row);
    		 
    		$cidades[] = $cidadeModel;
    	}
    	return $cidades;
    }
    
    
    
    
    /**
     * Retorna as CIDADES ativas
     * @return multitype:Application_Model_LocalCidades
     */
    public function cidadesName()
    {
    	$resultSet = $this->select()
	    	->from('local_cidades')
	    	->where('ativo = ?', '1')
	    	->order('nome')
	    	->query();
    	 
    	$cidades = array();
    	foreach ($resultSet as $row) {
    
    		$cidadeModel = new Application_Model_LocalCidades();
    		$cidadeModel->setOptions($row);
    
    		$cidades[] = $cidadeModel;
    	}
    	return $cidades;
    }

    
    
    /**
     * Deleta a CIDADE conforme o ID
     * @param unknown_type $credencial
     * @return number
     */
    public function del($cidade)
    {
    	$where = array(
    			$this->getAdapter()->quoteInto('id = ?', $cidade)
    	);
    	try {
    		$this->delete($where);
    		return true;
    	} catch (Exception $e) {
    		return false; //$e->getMessage();
    	}
    }
    
    
}

