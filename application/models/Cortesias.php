<?php

class Application_Model_Cortesias
{

	protected $_id;
	protected $_id_evento;
	protected $_nome;
	protected $_descricao;
	protected $_valor;
	protected $_converter;
	protected $_qtd;
	protected $_disponivel;
	protected $_sexo;
	protected $_termino;
	

	
	


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
	 * @return the $_nome
	 */
	public function getNome() {
		return $this->_nome;
	}

	/**
	 * @param field_type $_nome
	 */
	public function setNome($_nome) {
		$this->_nome = $_nome;
	}

	/**
	 * @return the $_descricao
	 */
	public function getDescricao() {
		return $this->_descricao;
	}

	/**
	 * @param field_type $_descricao
	 */
	public function setDescricao($_descricao) {
		$this->_descricao = $_descricao;
	}

	/**
	 * @return the $_valor
	 */
	public function getValor() {
		return $this->_valor;
	}

	/**
	 * @param field_type $_valor
	 */
	public function setValor($_valor) {
		$this->_valor = $_valor;
	}

	/**
	 * @return the $_converter
	 */
	public function getConverter() {
		return $this->_converter;
	}

	/**
	 * @param field_type $_converter
	 */
	public function setConverter($_converter) {
		$this->_converter = $_converter;
	}

	/**
	 * @return the $_qtd
	 */
	public function getQtd() {
		return $this->_qtd;
	}

	/**
	 * @param field_type $_qtd
	 */
	public function setQtd($_qtd) {
		$this->_qtd = $_qtd;
	}

	/**
	 * @return the $_disponivel
	 */
	public function getDisponivel() {
		return $this->_disponivel;
	}

	/**
	 * @param field_type $_disponivel
	 */
	public function setDisponivel($_disponivel) {
		$this->_disponivel = $_disponivel;
	}

	/**
	 * @return the $_sexo
	 */
	public function getSexo() {
		return $this->_sexo;
	}

	/**
	 * @param field_type $_sexo
	 */
	public function setSexo($_sexo) {
		$this->_sexo = $_sexo;
	}

	/**
	 * @return the $_termino
	 */
	public function getTermino() {
		return $this->_termino;
	}

	/**
	 * @param field_type $_termino
	 */
	public function setTermino($_termino) {
		$this->_termino = $_termino;
	}

	

}

