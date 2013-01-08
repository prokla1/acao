<?php

class Application_Model_DbTable_Eventos extends Zend_Db_Table_Abstract
{

    protected $_name = 'eventos';
    
    
    
    /**
     * Retorna todos os "EVENTOS" no banco
     * @return multitype:Application_Model_Evento
     */
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

    
    

       
    /**
     * Retorna os eventos em DESTAQUE
     * @return multitype:Application_Model_Evento 
     */
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
    
    
   
    public function byId($id, Application_Model_Evento $evento)
    {
    	$result = $this->fetchRow('id = '.$id);
    	$eventos = $result->toArray();
    	
    	$evento->setOptions($eventos);
    	$evento->setParceiro($result->id_parceiro);
    
    	return $evento;
    }
    
}

