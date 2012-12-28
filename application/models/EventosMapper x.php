<?php

class Application_Model_EventosMapper
{
	protected $_dbTable;
	
	
	
	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->_dbTable = new Application_Model_DbTable_Eventos();
		}
		return $this->_dbTable;
	}
	
	

	
	/**
	 * Retorna todos os "EVENTOS" no banco
	 * @return multitype:Application_Model_Evento
	 */
/*	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$result   = array();
		foreach ($resultSet as $row) {
			
			$eventos = new Application_Model_Evento($row->toArray()); //metodo __construct ->recebe os valores por ARRAY
			$result[] = $eventos;
		}
		return $result;
		
		
		
		
	}
	
*/	
	
	
public function fetchAll()
{
	$resultSet = $this->getDbTable()->select()
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
		$row['evento_fotos'] = array();
		$entries[] = $row;
	}
	return $entries;
}

	

	
	

	public function find($id, Application_Model_Evento $evento)
	{
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)) {
			return;
		}
		$row = $result->current();
	
		$evento->setOptions($row->toArray());
		/*
			$user->setId($row->id);
		$user->setEmail($row->email);
		$user->setNome($row->nome);
		$user->setSenha($row->senha);
		$user->setSexo($row->sexo);
		$user->setNascimento($row->nascimento);
		*/
	
		return $evento;
	}

}

