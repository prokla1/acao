<?php

class Application_Model_DbTable_Parceiros extends Zend_Db_Table_Abstract
{

    protected $_name = 'parceiros';

    
    /**
     * Retorna lista de PARCEIROS com o KEY=ID e VALUE=NOME
     * @return Ambigous <multitype:, multitype:mixed Ambigous <string, boolean, mixed> >
     */
    public function getParceirosList()  //para popular o select no form de cadastro dos eventos
    {
    	$select  = $this->select()->from($this->_name,
    			array('key' => 'id','value' => 'nome'))
    			->order('nome');
    	$result = $this->getAdapter()->fetchAll($select);
    	return $result;
    }

    
    
    
    public function getAll()
    {
    	$resultSet = $this->select()
    	->setIntegrityCheck(false)
    	->from(
    			$this->_name,
    			array(
    					'nome'		=>	'parceiros.nome',
    					'url_amigavel'		=>	'parceiros.url_amigavel',
    					'foto'		=>	'parceiros.foto',
    					'id'		=>	'parceiros.id',
    				)
    			)
    			/*
    	->joinLeft(
    			array(
    					'local_enderecos'			=>	'local_enderecos'
    			),
    			'local_enderecos.id				=	parceiros.id_endereco',
    			array(
    					'endereco_id'			=>	'local_enderecos.id',
    					'endereco_rua'			=>	'local_enderecos.rua',
    					'endereco_numero'		=>	'local_enderecos.numero',
    					'endereco_complemento'		=>	'local_enderecos.complemento'
    			)
    	)
    	*/
    	->joinLeft(
    			array(
    					'local_cidades'			=>	'local_cidades'
    			),
    			'local_cidades.id				=	parceiros.id_cidade',
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
    	->order('parceiros.nome')
    	->query()
    	->fetchAll();
    	$parceiros = array();
    	foreach ($resultSet as $row) {
    		$parceiro = new Application_Model_Parceiro();
    		$parceiro->setOptions($row);
    		
    		$parceiro->setCidade_nome($row['cidades_nome']);
    		$parceiro->setEstado_nome($row['estados_nome']);
    		$parceiro->setPais_nome($row['pais_nome']);
    	
    		$parceiros[] = $parceiro;
    	}
    	return $parceiros;
    	
    }

    /**
     * Retorna o PARCEIRO pelo ID
     * @param unknown_type $id
     * @param Application_Model_Parceiro $parceiro
     * @return Ambigous <Application_Model_Parceiro, NULL>
     */
    public function byId($id, Application_Model_Parceiro $parceiro)
    {
    	$result = $this->fetchRow('id = '.$id);
    	
    	if(!$parceiro)
    		$parceiro = new Application_Model_Parceiro();
    	 
    	if($result)
    	{
    		$parceiros = $result->toArray();
    		$parceiro->setOptions($parceiros);
    		//$parceiro->setLocal($result->id_endereco);
    		$parceiro->setLocal($result->id_cidade);
    		$parceiro->setFotos($id);
    		$parceiro->setAtividades($id);
    	}else
    	{
    		$parceiro = null;
    	}
    
    
    	return $parceiro;
    }



    /**
     * Retorna o PARCEIRO pela URL
     * @param unknown_type $url
     * @param Application_Model_Parceiro $parceiro
     * @return Ambigous <Application_Model_Parceiro, NULL>
     */
    public function byUrl($url, Application_Model_Parceiro $parceiro)
    {
    	$result = $this->fetchRow($this->select()->where('url_amigavel = ?', $url));
    	 
    	if($result)
    	{
    		$parceiros = $result->toArray();
    		$parceiro->setOptions($parceiros);
    		$parceiro->setLocal($result->id_cidade);
    		$parceiro->setFotos($result->id);
    		$parceiro->setAtividades($result->id);
    	}else
    	{
    		$parceiro = null;
    	}
    
    
    	return $parceiro;
    }
    
    
    
    
    public function rating($id_parceiro, $nota)
    {
    	$this->update(array(
		    			'num_votos' => new Zend_Db_Expr('num_votos + 1'), 
		    			'total_pontos' =>  new Zend_Db_Expr('total_pontos + '.$nota),
    					'rating' => new Zend_Db_Expr('(total_pontos / num_votos)')
    				),    			 
    				'id = "'. $id_parceiro .'"');
    	 
    	return $this->byId($id_parceiro, new Application_Model_Parceiro());
    }
    
    
    
    
    

    public function save(Application_Model_Parceiro $parceiro)
    {
    	$data = array(
    			'url_amigavel' => $parceiro->getUrl_amigavel(),
    			'id_usuario' => null,
    			'nome' => $parceiro->getNome(),
    			'descricao' => $parceiro->getDescricao(),
    			'foto' => $parceiro->getFoto(),
    			'ativo' => $parceiro->getAtivo(),
    			'id_cidade' => $parceiro->getId_cidade(),
    			'endereco' => $parceiro->getEndereco(),
    			'complemento' => $parceiro->getComplemento(),
    			'foto' => $parceiro->getFoto(),
    			'funcionamento' => $parceiro->getFuncionamento(),
    			'pagamento' => $parceiro->getPagamento(),
    			'telefone' => $parceiro->getTelefone(),
    	);
    
    	// id == null -> insert
    	if (null === ($id = $parceiro->getId())) {
    		unset($data['id']);
    		return $this->insert($data);
    	} else {
    		return $this->update($data, array('id = ?' => $id));
    	}
    }

    
    
    


    public function del($parceiro)
    {
    	$where = array(
    			$this->getAdapter()->quoteInto('id = ?', $parceiro)
    	);
    	try {
    		$this->delete($where);
    		return true;
    	} catch (Exception $e) {
    		return false; //$e->getMessage();
    	}
    }
     
}


