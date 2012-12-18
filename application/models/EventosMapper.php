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
	
	/**
	 * Retorna todos os EVENTOS no banco, para paginacao
	 * @return Ambigous <Zend_Db_Select, Zend_Db_Select>
	 */
	public function findAllEventos() {
		return $this->getDbTable()->select()->order(array('id DESC'));
	}
	

}

