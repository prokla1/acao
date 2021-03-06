<?php

class Application_Model_DbTable_Eventos extends Zend_Db_Table_Abstract
{

    protected $_name = 'eventos';
    

    
    public function save(Application_Model_Evento $evento)
    {
    	$p_dt = explode('/',$evento->getRealizacao());
    	$data = $p_dt[2].'-'.$p_dt[1].'-'.$p_dt[0];
    	$data = array(
    			'url_amigavel' => $evento->getUrl_amigavel(),
    			'id_parceiro' => $evento->getId_parceiro(),
    			'id_cidade' => $evento->getId_cidade(),
    			'nome' => $evento->getNome(),
    			'descricao' => $evento->getDescricao(),
    			'capa' => $evento->getCapa(),
    			'ativo' => $evento->getAtivo(),
    			'destaque' => $evento->getDestaque(),
    			'realizacao' => date('Y-m-d', strtotime($data)), //muda de formato pt-BR para DB
    	);

    	
    	// id == null -> insert
    	if (null === ($id = $evento->getId())) {
    			unset($data['id']);
    			return $this->insert($data);
    		} else {
    			return $this->update($data, array('id = ?' => $id));
    		}
    	}
    	
    	
    
    /**
     * Retorna todos os "EVENTOS" ativos no banco
     * @return multitype:Application_Model_Evento
     */
    /*
	public function findAll()
     {
	    $resultSet = $this->fetchAll("ativo = '1'");
	    $eventos   = array();
	    foreach ($resultSet as $result) {

	    	$evento = new Application_Model_Evento();
	    	$evento->setOptions($result->toArray());
		    $evento->setParceiro($result->id_parceiro);
	     		    		    
		    $eventos[] = $evento;
		    
//  		    echo "<pre>";
//  		    print_r($evento);
//  		    echo "</pre>";
    	}	
    	 
    	return $eventos;            
    }
*/


    
    /**
     * Retorna os eventos de um parceiro ID_PARCEIRO
     */
    public function findByParceiro($id_parceiro, Application_Model_Parceiro $parceiro = null)
    {
    	$resultSet = $this->select()
	    	->from('eventos')
	    	->where('eventos.id_parceiro = ?', $id_parceiro)
	    	->where('eventos.ativo = ?', '1')
	    	->where('eventos.realizacao >= ?', date('Y-m-d', time()))
	    	->order('eventos.realizacao')
    		->limit(10,0);
    	
    	//Zend_Debug::dump($resultSet->query());
    	$eventos = array();
    	foreach ($resultSet->query() as $row) {
    	
    		$eventoModel = new Application_Model_Evento();
    		$eventoModel->setOptions($row);
    			if($parceiro)
    				$eventoModel->setParceiroObj($parceiro);
    			else 
    				$eventoModel->setParceiro($row['id_parceiro']);
    			
    		//$eventoModel->setEndereco($row['id_endereco']);
    		$eventoModel->setCortesias($row['id']);
    		$eventoModel->setGeneros($row['id']);
    	
    		$eventos[] = $eventoModel;
    	}
    	return $eventos;    	
    }

    public function findByParceiroDate($id_parceiro, $inicio = null, $fim = null, Application_Model_Parceiro $parceiro = null)
    {
    	$p_dt = explode('/',$inicio);
    	$inicio = $p_dt[2].'-'.$p_dt[1].'-'.$p_dt[0];
    	$p_dt2 = explode('/',$fim);
    	$fim = $p_dt2[2].'-'.$p_dt2[1].'-'.$p_dt2[0];
    	
    	$resultSet = $this->select()
    	->from('eventos')
    	->where('eventos.id_parceiro = ?', $id_parceiro)
    	//->where('eventos.ativo = ?', '1')
    	->where('eventos.realizacao >= ?', date('Y-m-d', strtotime($inicio)))
    	->where('eventos.realizacao <= ?', date('Y-m-d', strtotime($fim)))
    	->order('eventos.realizacao');
    	 
    	//Zend_Debug::dump($resultSet->query());
    	$eventos = array();
    	foreach ($resultSet->query() as $row) {
    		 
    		$eventoModel = new Application_Model_Evento();
    		$eventoModel->setOptions($row);
    		if($parceiro)
    			$eventoModel->setParceiroObj($parceiro);
    		else
    			$eventoModel->setParceiro($row['id_parceiro']);
    		 
    		//$eventoModel->setEndereco($row['id_endereco']);
    		$eventoModel->setCortesias($row['id']);
    		$eventoModel->setGeneros($row['id']);
    		 
    		$eventos[] = $eventoModel;
    	}
    	return $eventos;
    }
    
    

    /**
     * Retorna os eventos em DESTAQUE
     * @return multitype:Application_Model_Evento
     */
    /*
    public function findDestaques()
    {
    	$resultSet = $this->select()
    	->from('eventos')
    	->where('destaque = ?', '1')
    	->limit(3, 0)
    	->order('realizacao')
    	->query();
    
    	$eventosDestaque = array();
    	foreach ($resultSet as $row) {
    
    		$eventoModel = new Application_Model_Evento();
    		$eventoModel->setOptions($row);
    		$eventoModel->setParceiro($row['id_parceiro']);
    
    		$eventosDestaque[] = $eventoModel;
    	}
    	return $eventosDestaque;
    }
    */
    
    
    

    /**
     * Retorna os eventos em DESTAQUE por cidade
     * @return multitype:Application_Model_Evento
     */
    public function findByCityDestaques($idCity)
    {
    	$resultSet = $this->select()
    	->setIntegrityCheck(false) // allows joins
    	->from('eventos')
    	->joinRight( //join na tabela LOCAL ENDERECOS
    			array(
    					'local_cidades'		=>	'local_cidades'
    			),
    			'local_cidades.id				=	eventos.id_cidade',
    			array( //foi preciso setar os dados a serem importados, pois as duas tabelas possuem coluna ID
    					'id_cidade'		=>	'local_cidades.id',
    					'cidade_nome'				=>	'local_cidades.nome',
    					'cidade_estado'			=>	'local_cidades.id_estado',
    			)
    	)
    	->where('eventos.ativo = ?', '1')
    	->where('eventos.destaque = ?', '1')
    	->where('realizacao >= ?', date('Y-m-d', time()))
    	->where('eventos.id_cidade = ?', $idCity)
    	->order('realizacao');
    	
    	//Zend_Debug::dump($resultSet->query());
    	$eventos = array();
    	foreach ($resultSet->query() as $row) {
    
    		$eventoModel = new Application_Model_Evento();
    		$eventoModel->setOptions($row);
    		$eventoModel->setParceiro($row['id_parceiro']);
    		//$eventoModel->setEndereco($row['id_endereco']);
    
    		$eventos[] = $eventoModel;
    	}
    	return $eventos;
    }





    /**
     * Retorna os eventos por CIDADE e DIA
     * @return multitype:Application_Model_Evento
     */
    public function findByCityAndDate($idCity, $dia_base)
    {
    	$resultSet = $this->select()
    	->setIntegrityCheck(false) // allows joins
    	->from('eventos')
    	/*
    	->joinRight( //join na tabela LOCAL ENDERECOS
    			array(
    					'local_enderecos'		=>	'local_enderecos'
    			),
    			'local_enderecos.id				=	eventos.id_endereco',
    			array( 
    					'id_cidade'		=>	'local_enderecos.id_cidade',
    					'rua'				=>	'local_enderecos.rua',
    					'numero'			=>	'local_enderecos.numero',
    					'complemento'		=>	'local_enderecos.complemento'
    			)
    	)
    	*/
    	->joinRight( //join na tabela LOCAL ENDERECOS
    			array(
    					'local_cidades'		=>	'local_cidades'
    			),
    			'local_cidades.id				=	eventos.id_cidade',
    			array( //foi preciso setar os dados a serem importados, pois as duas tabelas possuem coluna ID
    					'cidade_id'		=>	'local_cidades.id',
    					'cidade_nome'				=>	'local_cidades.nome',
    					'cidade_estado'			=>	'local_cidades.id_estado',
    			)
    	)
    	->where('eventos.ativo = ?', '1')
    	->where('eventos.id_cidade = ?', $idCity)
    	//->where('local_enderecos.id_cidade = ?', $idCity)
    	->where('eventos.realizacao = ?', date('Y-m-d', $dia_base))  //alterar para '>=' para trazer os proximos
    	->order('eventos.realizacao');
    
    	//Zend_Debug::dump($resultSet->query());
    	$eventos = array();
    	foreach ($resultSet->query() as $row) {
    
    		$eventoModel = new Application_Model_Evento();
    		$eventoModel->setOptions($row);
    		
    		$eventoModel->setParceiro($row['id_parceiro']);
    		//$eventoModel->setEndereco($row['id_endereco']);
    		$eventoModel->setCortesias($row['id']);
    		$eventoModel->setGeneros($row['id']);
    
    		$eventos[] = $eventoModel;
    	}
    	return $eventos;
    }
    
    
    





    /**
     * Retorna os eventos por CIDADE e DIA
     * @return multitype:Application_Model_Evento
     */
    public function findByCityDateType($idCity, $dia_base, $tipo)
    {
    	$resultSet = $this->select()
    	->setIntegrityCheck(false) // allows joins
    	->from('eventos')
    	->joinRight( //join na tabela LOCAL ENDERECOS
    			array(
    					'local_cidades'		=>	'local_cidades'
    			),
    			'local_cidades.id				=	eventos.id_cidade',
    			array( //foi preciso setar os dados a serem importados, pois as duas tabelas possuem coluna ID
    					'id_cidade'		=>	'local_cidades.id',
    					'cidade_nome'				=>	'local_cidades.nome',
    					'cidade_estado'			=>	'local_cidades.id_estado',
    			)
    	)/*
    	->joinRight( //join na tabela LOCAL ENDERECOS
    			array(
    					'local_enderecos'		=>	'local_enderecos'
    			),
    			'local_enderecos.id				=	eventos.id_endereco',
    			array(
    					'id_cidade'			=>	'local_enderecos.id_cidade',
    					'rua'				=>	'local_enderecos.rua',
    					'numero'			=>	'local_enderecos.numero',
    					'complemento'		=>	'local_enderecos.complemento'
    			)
    	)*/
    	->joinRight( //join na tabela REL_ATIVIDADES_PARCEIROS
    			array(
    					'rel_atividade_parceiro'		=>	'rel_atividade_parceiro'
    			),
    			'rel_atividade_parceiro.id_parceiro	=	eventos.id_parceiro',
    			array(
    					'rel_id_atividade'		=>	'rel_atividade_parceiro.id_atividade',
    					'rel_id_parceiro'		=>	'rel_atividade_parceiro.id_parceiro',
    			)
    	)
    	->joinRight( //join na tabela ATIVIDADES
    			array(
    					'atividades'		=>	'atividades'
    			),
    			'atividades.id	=	rel_atividade_parceiro.id_atividade',
    			array( 
    					'atividade_id'		=>	'atividades.id',
    					'atividade_nome'	=>	'atividades.nome',
    					'atividade_url'		=>	'atividades.url'
    			)
    	)
    	->where('eventos.ativo = ?', '1')
    	->where('atividades.url IN (?)', $tipo)
    	->where('eventos.id_cidade = ?', $idCity)
    	->where('eventos.realizacao = ?', date('Y-m-d', $dia_base))  //alterar para '>=' para trazer os proximos
    	->order('eventos.realizacao');
    
//     	return Zend_Debug::dump($resultSet->__toString());
//     	exit;
    	$eventos = array();
    	foreach ($resultSet->query() as $row) {
    
    		$eventoModel = new Application_Model_Evento();
    		$eventoModel->setOptions($row);
    		$eventoModel->setParceiro($row['id_parceiro']);
    		//$eventoModel->setEndereco($row['id_endereco']);
    		$eventoModel->setCortesias($row['id']);
    		$eventoModel->setGeneros($row['id']);
    
    		$eventos[] = $eventoModel;
    	}
    	return $eventos;
    }
    
    



    /**
     * Retorna os eventos por CIDADE
     * @return multitype:Application_Model_Evento
     */
    public function findByCity($idCity)
    {
    	$resultSet = $this->select()
    	->setIntegrityCheck(false) // allows joins
    	->from('eventos')
    	->joinRight( //join na tabela LOCAL ENDERECOS
    			array(
    					'local_cidades'		=>	'local_cidades'
    			),
    			'local_cidades.id				=	eventos.id_cidade',
    			array( //foi preciso setar os dados a serem importados, pois as duas tabelas possuem coluna ID
    					'id_cidade'		=>	'local_cidades.id',
    					'cidade_nome'				=>	'local_cidades.nome',
    					'cidade_estado'			=>	'local_cidades.id_estado',
    			)
    	)/*
    	->joinRight( //join na tabela LOCAL ENDERECOS
    			array(
    					'local_enderecos'		=>	'local_enderecos'
    			),
    			'local_enderecos.id				=	eventos.id_endereco',
    			array( //foi preciso setar os dados a serem importados, pois as duas tabelas possuem coluna ID
    					'id_cidade'		=>	'local_enderecos.id_cidade',
    					'rua'				=>	'local_enderecos.rua',
    					'numero'			=>	'local_enderecos.numero',
    					'complemento'		=>	'local_enderecos.complemento'
    			)
    	)*/
    	->where('eventos.ativo = ?', '1')
    	->where('eventos.id_cidade = ?', $idCity)
    	->order('realizacao');
    	 
    	//Zend_Debug::dump($resultSet->query());
    	$eventos = array();
    	foreach ($resultSet->query() as $row) {
    
    		$eventoModel = new Application_Model_Evento();
    		$eventoModel->setOptions($row);
    		$eventoModel->setParceiro($row['id_parceiro']);
    		//$eventoModel->setEndereco($row['id_endereco']);
    		$eventoModel->setCortesias($row['id']);
    		$eventoModel->setGeneros($row['id']);
    
    		$eventos[] = $eventoModel;
    	}
    	return $eventos;
    }
    



    /*
     *Pega o EVENTO pelo ID, sem o PARCEIRO
    *Parceiro já esta no controller
    */
    public function byId($id, Application_Model_Evento $evento)
    {
    	$result = $this->fetchRow('id = '.$id);
    
    
    	if($result)
    	{
    		$eventos = $result->toArray();
    		$evento->setOptions($eventos);
    		$evento->setCortesias($id);
    		$evento->setGeneros($id);
    	}else
    	{
    		$evento = null;
    	}
    
    
    	return $evento;
    }
    
    



    /*
     *Pega o EVENTO pelo URL AMIGAVEL, sem o PARCEIRO
    *Parceiro já esta no controller
    */
    public function byUrl($url, Application_Model_Evento $evento)
    {
    	$result = $this->fetchRow($this->select()->where('url_amigavel = ?', $url));
    
    	if($result)
    	{
    		$eventos = $result->toArray();
    		$evento->setOptions($eventos);
    		$evento->setCortesias($evento->id);
    		$evento->setGeneros($evento->id);
    	}else
    	{
    		$evento = null;
    	}
    
    
    	return $evento;
    }
    
    
    /**
     * Retorna os eventos de um parceiro ID_PARCEIRO
     */
    public function byNext($id_parceiro, Application_Model_Evento $evento)
    {
    	$resultSet = $this->select()
    	->from('eventos')
    	->where('eventos.id_parceiro = ?', $id_parceiro)
    	->where('eventos.ativo = ?', '1')
    	->where('eventos.realizacao >= ?', date('Y-m-d', time()))
    	->order('eventos.realizacao')
    	->limit(1);
    	//->query();
    	if($this->fetchRow($resultSet))
    	{
	    	$evento->setOptions($resultSet->query()->fetch());
	    	$evento->setCortesias($evento->id);
    		$evento->setGeneros($evento->id);
    	}else
    	{
    		$evento = null;
    	}
    	return $evento;
    }
    
    

/*
 * pega o evento pelo ID e ja add o objeto PARCEIRO
 */
    /*
    public function byId($id, Application_Model_Evento $evento, Application_Model_Parceiro $parceiro)
    {
    	$result = $this->fetchRow('id = '.$id);
    
    	 
    	if($result)
    	{
    		$eventos = $result->toArray();
    		$evento->setOptions($eventos);
    		//$evento->setParceiro($result->id_parceiro);
    		$evento->setParceiroObj($parceiro);
    		$evento->setCortesias($id);
    	}else
    	{
    		$evento = null;
    	}
    
    
    	return $evento;
    }
 */   
    
    
 /*   
    public function fetchAll()
    {
    	$resultSet = $this->select()
    	->setIntegrityCheck(false)
    	->from(  //seleciona tudo da tabela EVENTOS
    			array(
    					'eventos' => 'eventos'
    			),
    			array(
    					'evento_id'					=>	'id',
    					'evento_nome'				=>	'nome',
    					'evento_descricao'			=>	'descricao',
    					'evento_realizacao'			=>	'realizacao'
    
    			)
    	)
    	->joinLeft(  //join na tabela PARCEIROS
    			array(
    					'parceiros'					=>	'parceiros'
    			),
    			'parceiros.id						=	eventos.id_parceiro',
    			array(
    					'parceiro_nome'				=>	'parceiros.nome',
    					'parceiro_id'				=>	'parceiros.id',
    					'parceiro_foto'				=>	'parceiros.foto'
    			)
    	)
    	->joinLeft( //join na tabela RELACAO LOCAL DOS PARCEIROS
    			array(
    					'rel_local'				=>	'rel_local_parceiro'
    			),
    			'rel_local.id_parceiro			=	parceiros.id',
    			array(
    					'local_id'				=>	'rel_local.id_local'
    			)
    	)
    	->joinLeft( //join na tabela LOCAL ENDERECOS
    			array(
    					'local_enderecos'		=>	'local_enderecos'
    			),
    			'local_enderecos.id				=	rel_local.id_local',
    			array(
    					'local_id_cidade'		=>	'local_enderecos.id_cidade',
    					'local_rua'				=>	'local_enderecos.rua',
    					'local_numero'			=>	'local_enderecos.numero',
    					'local_complemento'		=>	'local_enderecos.complemento'
    			)
    	)
    	->joinLeft(	//join na tabela LOCAL CIDADES
    			array(
    					'local_cidades'			=>	'local_cidades'
    			),
    			'local_cidades.id				=	local_enderecos.id_cidade',
    			array(
    					'local_nome_cidade'		=>	'local_cidades.nome',
    					'local_id_estado'		=>	'local_cidades.id_estado'
    			)
    	)
    	->joinLeft(	//join na tabela LOCAL ESTADOS
    			array(
    					'local_estados'			=>	'local_estados'
    			),
    			'local_estados.id				=	local_cidades.id_estado',
    			array(
    					'local_nome_estado'		=>	'local_estados.nome',
    					'local_sigla_estado'	=>	'local_estados.sigla',
    					'local_id_pais'			=>	'local_estados.id_pais'
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
    	->query()
    	->fetchAll();
    	$entries = array();
    	foreach ($resultSet as $row) {
    		$row['evento_fotos'] = array();/v
    		$entries[] = $row;
    	}
    	return $entries;
    }
    
    
 */   

    
    public function estatisticas($id_parceiros, $from, $to)
    {
    	$result = array();
    	
    	foreach ($id_parceiros as $id_parceiro) {
    		
    		
    		$resultSet = $this->select()
    		->setIntegrityCheck(false)
    		->from(  //seleciona tudo da tabela EVENTOS
    				array(
    						'eventos' => 'eventos'
    				),
    				array(
    						'evento_id'					=>	'id',
    						'evento_nome'				=>	'nome',
    						'evento_realizacao'			=>	'realizacao',
    						'evento_realizacao'			=>	'realizacao',
    						'evento_idparceiro'			=>	'id_parceiro'
    				)
    		)
    		->joinLeft(  //join na tabela PARCEIROS
    				array(
    						'parceiros'					=>	'parceiros'
    				),
    				'parceiros.id						=	eventos.id_parceiro',
    				array(
    						'parceiro_nome'				=>	'parceiros.nome',
    						'parceiro_id'				=>	'parceiros.id',
    						'parceiro_foto'				=>	'parceiros.foto'
    				)
    		)
    		->where('eventos.id_parceiro = ?', $id_parceiro)
    		->where('eventos.ativo = ?', '1')
    		->where('eventos.realizacao >= ?', date('Y-m-d', strtotime($from)))
    		->where('eventos.realizacao <= ?', date('Y-m-d', strtotime($to)))
    		->order('eventos.realizacao')
    		->limit(10,0)
    		
    		->query()
    		->fetchAll();
    		$entries = array();
    		foreach ($resultSet as $row) {
    			$entries[] = $row;
    		}
    		
    		$result[$id_parceiro] = $entries;
    	}
    	

    	return $result;
    }   
    

}

