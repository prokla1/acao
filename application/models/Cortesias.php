<?php

class Application_Model_Cortesias
{

	protected $_id;
	protected $_id_evento;
	protected $_nome;
	protected $_descricao;
	protected $_valor_original;
	protected $_valor;
	protected $_qtd;
	protected $_disponivel;
	protected $_max_converter;
	protected $_sexo;
	protected $_termino;
	
	//protected $_genero;
	

	
	
	

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
	 * @return the $_valor_orignal
	 */
	public function getValor_original() {
		return $this->_valor_original;
	}

	/**
	 * @param field_type $_valor_orignal
	 */
	public function setValor_original($_valor_original) {
		$this->_valor_original = $_valor_original;
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
	 * @return the $_max_converter
	 */
	public function getMax_converter() {
		return $this->_max_converter;
	}

	/**
	 * @param field_type $_max_converter
	 */
	public function setMax_converter($_max_converter) {
		$this->_max_converter = $_max_converter;
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
		//$this->setGenero($_sexo);
	}


	/**
	 * @return the $_genero
	 */
	public function getGenero() {
		return $this->_genero;
	}
	
	/**
	 * @param field_type $_genero
	 */
	public function setGenero($_genero) {
		switch ($_genero){
			case 1:
				$genero = 'Masculino';
				break;
			case 2:
				$genero = 'Feminino';
				break;
			default:
				$genero = 'Unissex';
		}
		$this->_genero = $genero;
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

