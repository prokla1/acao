<?php

class Application_Model_RelAtividades
{

	public $id;
	public $id_parceiro;
	public $id_atividade;
	public $ativo;
	public $hora;

	
	public $atividade_nome;

	/**
	 * @return the $atividade_nome
	 */
	public function getAtividade_nome() {
		return $this->atividade_nome;
	}

	/**
	 * @param field_type $atividade_nome
	 */
	public function setAtividade_nome($atividade_nome) {
		$this->atividade_nome = $atividade_nome;
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
			throw new Exception("Invalid Application_Model_RelAtividades property {$name}");
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid Application_Model_RelAtividades property {$name}");
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
	 * @return the $_id_parceiro
	 */
	public function getId_parceiro() {
		return $this->id_parceiro;
	}

	/**
	 * @param field_type $_id_parceiro
	 */
	public function setId_parceiro($_id_parceiro) {
		$this->id_parceiro = $_id_parceiro;
	}

	/**
	 * @return the $_id_atividade
	 */
	public function getId_atividade() {
		return $this->id_atividade;
	}

	/**
	 * @param field_type $_id_atividade
	 */
	public function setId_atividade($_id_atividade) {
		$this->id_atividade = $_id_atividade;
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

	/**
	 * @return the $_hora
	 */
	public function getHora() {
		return $this->hora;
	}

	/**
	 * @param field_type $_hora
	 */
	public function setHora($_hora) {
		$this->hora = $_hora;
	}

	
	
	
	

}

