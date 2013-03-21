<?php

class Application_Model_DbTable_LocalEnderecos extends Zend_Db_Table_Abstract
{

    protected $_name = 'local_enderecos';


    
    


//     public function getEnderecosList()  //para popular o select no form de cadastro dos eventos
    
//     {
    
//     	$select  = $this->select()->from($this->_name,
//     			array('key' => 'id','value' => 'rua'))
//     			->order('rua');
    
//     	$result = $this->getAdapter()->fetchAll($select);
//     	return $result;
//     }
    
    
    public function getEnderecosList()  //para popular o select no form de cadastro dos eventos
    {
    	$resultSet = $this->select()
    	->setIntegrityCheck(false)
    	->from(  //seleciona tudo da tabela EVENTOS
    			array(
    					'local_enderecos' => 'local_enderecos'
    			),
    			array(
    					'local_enderecos_id'			=>	'local_enderecos.id',
    					'local_enderecos_id_cidade'		=>	'local_enderecos.id_cidade',
    					'local_enderecos_rua'			=>	'local_enderecos.rua',
    					'local_enderecos_numero'		=>	'local_enderecos.numero',
    					'local_enderecos_complemento'	=>	'local_enderecos.complemento'
    
    			)
    	)
    	->joinLeft(  //join na tabela PARCEIROS
    			array(
    					'local_cidades'					=>	'local_cidades'
    			),
    			'local_cidades.id						=	local_enderecos.id_cidade',
    			array(
    					'local_cidades_id'				=>	'local_cidades.id',
    					'local_cidades_nome'			=>	'local_cidades.nome',
    					'local_cidades_id_estado'		=>	'local_cidades.id_estado'
    			)
    	)
    	->joinLeft( //join na tabela RELACAO LOCAL DOS PARCEIROS
    			array(
    					'local_estados'				=>	'local_estados'
    			),
    			'local_estados.id					=	local_cidades.id_estado',
    			array(
    					'local_estados_sigla'		=>	'local_estados.sigla',
    					'local_estados_id_pais'		=>	'local_estados.id_pais'
    			)
    	)
    	->joinLeft( //join na tabela LOCAL PAIS
    			array(
    					'local_pais'			=>	'local_pais'
    			),
    			'local_pais.id					=	local_estados.id_pais',
    			array(
    					'local_nome_pais'		=>	'local_pais.nome',
    					'local_sigla_pais'		=>	'local_pais.sigla'
    			)
    	)
    	->order('local_enderecos_rua')
    	->query()
    	->fetchAll();
    	$entries = array();
    	foreach ($resultSet as $row) {
    		$array = array();
    		$array['key'] = $row['local_enderecos_id'];
    		$array['value'] = 
    				$row['local_enderecos_rua'] . ", " .
    				$row['local_enderecos_numero'] . " - " .
    				$row['local_enderecos_complemento'] . " - " .
    				$row['local_cidades_nome'] . ", " .
    				$row['local_estados_sigla'] . " " 
    				;
    		$entries[] = $array;
    	}
    	return $entries;
    }
        

    
    /**
     * Retorna todos ENDERECOS cadastrados em forma de OBJETO
     * @return multitype:NULL
     */
    public function getAll()
    {
    	$resultSet = $this->select()
    	->from($this->_name)
    	->order('id DESC');
    	$enderecos = array();
    	foreach ($resultSet->query() as $row)
    	{
    		 $enderecos[] = $this->byId($row['id'], new Application_Model_LocalEnderecos());
    	}
    	return $enderecos;
    }
    
     

    public function byId($id, Application_Model_LocalEnderecos $localEndereco)
    {
    	$result = $this->fetchRow('id = '.$id);
    
    	$endereco = $result->toArray();
    	$localEndereco->setOptions($endereco);
    	$localEndereco->setCidade($result->id_cidade);
    	return $localEndereco;
    	
    }
    
    
    

    /**
     * Retorna todos endereços e com nome da CIDADE, ESTADO e PAIS
     * @return multitype:Application_Model_LocalEnderecos
     */
    public function getAllList() 
    {
    	$resultSet = $this->select()
    	->setIntegrityCheck(false)
    	->from($this->_name)
    	->joinLeft( 
    			array(
    					'local_cidades'			=>	'local_cidades'
    			),
    			'local_cidades.id				=	local_enderecos.id_cidade',
    			array(
    					'cidades_id'			=>	'local_cidades.id',
    					'cidades_nome'			=>	'local_cidades.nome',
    					'cidades_id_estado'		=>	'local_cidades.id_estado'
    			)
    	)
    	->joinLeft( //join na tabela RELACAO LOCAL DOS PARCEIROS
    			array(
    					'local_estados'			=>	'local_estados'
    			),
    			'local_estados.id				=	local_cidades.id_estado',
    			array(
    					'estados_sigla'			=>	'local_estados.sigla',
    					'estados_nome'			=>	'local_estados.nome',
    					'estados_id_pais'		=>	'local_estados.id_pais'
    			)
    	)
    	->joinLeft( //join na tabela LOCAL PAIS
    			array(
    					'local_pais'			=>	'local_pais'
    			),
    			'local_pais.id					=	local_estados.id_pais',
    			array(
    					'pais_nome'			=>	'local_pais.nome',
    					'pais_sigla'		=>	'local_pais.sigla'
    			)
    	)
    	->order('local_pais.nome')
    	->order('local_estados.nome')
    	->order('local_cidades.nome')
    	->order('local_enderecos.rua')
    	->query()
    	->fetchAll();
    	$enderecos = array();
    	foreach ($resultSet as $row) {
    		$endereco = new Application_Model_LocalEnderecos();
    		$endereco->setOptions($row);
    		$endereco->setCidade_nome($row['cidades_nome']);
    		$endereco->setEstado_nome($row['estados_nome']);
    		$endereco->setPais_nome($row['pais_nome']);
    				
    		$enderecos[] = $endereco;
    	}
    	return $enderecos;
    }

    
    
    
    public function del($endereco)
    {
    	$where = array(
    			$this->getAdapter()->quoteInto('id = ?', $endereco)
    	);
    	try {
    		$this->delete($where);
    		return true;
    	} catch (Exception $e) {
    		return false; //$e->getMessage();
    	}
    }
    
}

