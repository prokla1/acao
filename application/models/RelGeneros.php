<?php

class Application_Model_RelGeneros
{

	protected $_id;
	protected $_id_evento;
	protected $_id_genero;
	protected $_ativo;
	protected $_hora;

	
	
	
	
	

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
	 * @return the $_id_evento
	 */
	public function getId_evento() {
		return $this->_id_evento;
	}

	/**
	 * @param field_type $_id_evento
	 */
	public function setId_evento($_id_evento) {
		$this->_id_evento = $_id_evento;
	}

	/**
	 * @return the $_id_genero
	 */
	public function getId_genero() {
		return $this->_id_genero;
	}

	/**
	 * @param field_type $_id_genero
	 */
	public function setId_genero($_id_genero) {
		$this->_id_genero = $_id_genero;
	}

	/**
	 * @return the $_ativo
	 */
	public function getAtivo() {
		return $this->_ativo;
	}

	/**
	 * @param field_type $_ativo
	 */
	public function setAtivo($_ativo) {
		$this->_ativo = $_ativo;
	}

	/**
	 * @return the $_hora
	 */
	public function getHora() {
		return $this->_hora;
	}

	/**
	 * @param field_type $_hora
	 */
	public function setHora($_hora) {
		$this->_hora = $_hora;
	}

	
	
	
	
	
	
	
	
	
	

}

