<?php

class Application_Model_DbTable_LocalEstados extends Zend_Db_Table_Abstract
{

    protected $_name = 'local_estados';

    
    public function getAll()
    {
    	$resultSet = $this->select()
    	->from($this->_name)
    	->order('nome');
    	$estados = array();
    	foreach ($resultSet->query() as $row)
    	{
    		//print_r($row);
    		$estadosModel = new Application_Model_LocalEstados();
    		$estadosModel->setOptions($row);
    		$estadosModel->setPais($row['id_pais']);
    		$estados[] = $estadosModel;
    		/*
    		$estados[] = $this->byId($row['id'], new Application_Model_LocalEstados());
    		*/
    	}
    	return $estados;
    }
    
    
    

    public function getEstadosList()  //para popular o select no form de cadastro das cidades
    {
    	$resultSet = $this->select()
    	->setIntegrityCheck(false)
    	->from(
    			array(
    					'local_estados'				=>	'local_estados'
    			),
    			array(
    					'local_estados_id'			=>	'local_estados.id',
    					'local_estados_sigla'		=>	'local_estados.sigla',
    					'local_estados_nome'		=>	'local_estados.nome',
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
    	->order('local_estados_nome')
    	->query()
    	->fetchAll();
    	$entries = array();
    	foreach ($resultSet as $row) {
    		$array = array();
    		$array['key'] = $row['local_estados_id'];
    		$array['value'] =
	    		$row['local_estados_sigla'] . ", " .
	    		$row['local_estados_nome'] . " - " .
	    		$row['local_sigla_pais']
	    		;
    		$entries[] = $array;
    	}
    	return $entries;
    }
    
    
    
    

    /**
     * Retorna o ESTADO conforme o ID
     * @param unknown_type $id
     * @param Application_Model_LocalEstados $localEstados
     * @return Application_Model_LocalEstados
     */
    public function byId($id, Application_Model_LocalEstados $localEstados)
    {
    	$result = $this->fetchRow('id = '.$id);
    
    	$estado = $result->toArray();
    	$localEstados->setOptions($estado);
    	$localEstados->setPais($result->id_pais);
    	return $localEstados;
    }
    

    
    /**
     * Deleta o ESTADO conforme o ID
     * @param unknown_type $credencial
     */
    public function del($estado)
    {
    	$where = array(
    			$this->getAdapter()->quoteInto('id = ?', $estado)
    	);
    	return $this->delete($where);
    }
    
       

    
}

