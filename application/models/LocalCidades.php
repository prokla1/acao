<?php

class Application_Model_LocalCidades
{
	public $id;
	public $nome;
	public $id_estado;
	public $ativo;
	
	
	public $estado;
	

	


	/**
	 * @param field_type $_id_parceiro
	 */
	public function setEstado($id_estado) {
	
		$estadoTable = new Application_Model_DbTable_LocalEstados();
		$estadoModel = new Application_Model_LocalEstados();
		$estado = $estadoTable->byId($id_estado, $estadoModel);
	
		$this->estado = $estado;
	}
	
	/**
	 * @return the $_parceiro (objeto class Parceiros)
	 */
	public function getEstado() {
		return $this->estado;
	}
	
	
	
	
	



	/**
	 * Retorna os atributos protected em array
	 * @return array dos valores protected
	 */
	public function getArray(){
		$array = array();
		foreach ($this as $key => $value) {
			$array[$key] = $value;
		}
		return $array;
	}
	
	
	/**
	 * metodo contrutor, chama a classe e envia um array com
	 * os dados, ex:  new User(array())
	 * @param array $options
	 */
	public function __construct(array $options = null)
	{
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}
	
	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid Application_Model_LocalCidades property {$name}");
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid Application_Model_LocalCidades property {$name}");
		}
		return $this->$method();
	}
	
	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}
	
	
	
	
	
	
	
	/**
	 * @return the $_id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param field_type $_id
	 */
	public function setId($_id) {
		$this->id = $_id;
	}

	/**
	 * @return the $_nome
	 */
	public function getNome() {
		return $this->nome;
	}

	/**
	 * @param field_type $_nome
	 */
	public function setNome($_nome) {
		$this->nome = $_nome;
	}

	/**
	 * @return the $_id_estado
	 */
	public function getId_estado() {
		return $this->id_estado;
	}

	/**
	 * @param field_type $_id_estado
	 */
	public function setId_estado($_id_estado) {
		$this->id_estado = $_id_estado;
	}

	/**
	 * @return the $_ativo
	 */
	public function getAtivo() {
		return $this->ativo;
	}

	/**
	 * @param field_type $_ativo
	 */
	public function setAtivo($_ativo) {
		$this->ativo = $_ativo;
	}

	
	
	

}

