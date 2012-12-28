<?php

class Application_Model_Evento
{
	protected $_id;
	protected $_id_parceiro;
	protected $_nome;
	protected $_descricao;
	protected $_ativo;
	protected $_realizacao;
	protected $_hora;
	
	protected $_parceiro;
	

	

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
			throw new Exception("Invalid Evento property {$name}");
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid Evento property {$name}");
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
	 * @param field_type $_id_parceiro
	 */
	public function setParceiro($id_parceiro) {
		$parceiroTable = new Application_Model_DbTable_Parceiros();
		$parceiro = $parceiroTable->fetchRow('id = '. $id_parceiro);
		$this->_parceiro = $parceiro;
	}
	
	/**
	 * @return the $_parceiro (objeto class Parceiros)
	 */
	public function getParceiro() {
		return $this->_parceiro;
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
	 * @return the $_id_parceiro
	 */
	public function getId_parceiro() {
		return $this->_id_parceiro;
	}

	/**
	 * @param field_type $_id_parceiro
	 */
	public function setId_parceiro($_id_parceiro) {
		$this->_id_parceiro = $_id_parceiro;
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
	 * @return the $_realizacao
	 */
	public function getRealizacao() {
		return $this->_realizacao;
	}

	/**
	 * @param field_type $_realizacao
	 */
	public function setRealizacao($_realizacao) {
		$this->_realizacao = $_realizacao;
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

