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
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$result   = array();
		foreach ($resultSet as $row) {
			
			$eventos = new Application_Model_Evento($row->toArray()); //metodo __construct ->recebe os valores por ARRAY
			$result[] = $eventos;
		}
		return $result;
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

