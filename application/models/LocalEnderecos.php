<?php

class Application_Model_LocalEnderecos
{
	protected $_id;
	protected $_id_cidade;
	protected $_rua;
	protected $_numero;
	protected $_complemento;
	
	protected $_cidade;
	
	




	/**
	 * @param field_type $_id_parceiro
	 */
	public function setCidade($id_endereco) {
		
		$cidadeTable = new Application_Model_DbTable_LocalCidades();
		$cidadeModel = new Application_Model_LocalCidades();
		$cidade = $cidadeTable->byId($id_endereco, $cidadeModel);
		
		$this->_cidade = $cidade;
	}
	
	/**
	 * @return the $_parceiro (objeto class Parceiros)
	 */
	public function getCidade() {
		return $this->_cidade;
	}
	
	
	
	
	


	/**
	 * Retorna os atributos protected em array
	 * @return array dos valores protected
	 */
	public function getArray(){
		$array = array();
		foreach ($this as $key => $value) {
			$array[substr($key, 1)] = $value;
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
			throw new Exception("Invalid Parceiro property {$name}");
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid Parceiro property {$name}");
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
		return $this->_id;
	}

	/**
	 * @param field_type $_id
	 */
	public function setId($_id) {
		$this->_id = $_id;
	}

	/**
	 * @return the $_id_cidade
	 */
	public function getId_cidade() {
		return $this->_id_cidade;
	}

	/**
	 * @param field_type $_id_cidade
	 */
	public function setId_cidade($_id_cidade) {
		$this->_id_cidade = $_id_cidade;
	}

	/**
	 * @return the $_rua
	 */
	public function getRua() {
		return $this->_rua;
	}

	/**
	 * @param field_type $_rua
	 */
	public function setRua($_rua) {
		$this->_rua = $_rua;
	}

	/**
	 * @return the $_numero
	 */
	public function getNumero() {
		return $this->_numero;
	}

	/**
	 * @param field_type $_numero
	 */
	public function setNumero($_numero) {
		$this->_numero = $_numero;
	}

	/**
	 * @return the $_complemento
	 */
	public function getComplemento() {
		return $this->_complemento;
	}

	/**
	 * @param field_type $_complemento
	 */
	public function setComplemento($_complemento) {
		$this->_complemento = $_complemento;
	}

	
	
	
	

}

