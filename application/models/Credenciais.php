<?php

class Application_Model_Credenciais
{

	
	public $id;
	public $parceiro;
	public $usuario;
	public $nivel;
	

	public $parceiro_nome;
	public $parceiro_url;
	public $usuario_nome;
	public $usuario_email;
	

	
	
	
	
	
	
	
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return the $parceiro
	 */
	public function getParceiro() {
		return $this->parceiro;
	}

	/**
	 * @param field_type $parceiro
	 */
	public function setParceiro($parceiro) {
		$this->parceiro = $parceiro;
	}

	/**
	 * @return the $usuario
	 */
	public function getUsuario() {
		return $this->usuario;
	}

	/**
	 * @param field_type $usuario
	 */
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}

	/**
	 * @return the $nivel
	 */
	public function getNivel() {
		return $this->nivel;
	}

	/**
	 * @param field_type $nivel
	 */
	public function setNivel($nivel) {
		$this->nivel = $nivel;
	}

	/**
	 * @return the $parceiro_nome
	 */
	public function getParceiro_nome() {
		return $this->parceiro_nome;
	}

	/**
	 * @param field_type $parceiro_nome
	 */
	public function setParceiro_nome($parceiro_nome) {
		$this->parceiro_nome = $parceiro_nome;
	}

	/**
	 * @return the $parceiro_url
	 */
	public function getParceiro_url() {
		return $this->parceiro_url;
	}

	/**
	 * @param field_type $parceiro_url
	 */
	public function setParceiro_url($parceiro_url) {
		$this->parceiro_url = $parceiro_url;
	}

	/**
	 * @return the $usuario_nome
	 */
	public function getUsuario_nome() {
		return $this->usuario_nome;
	}

	/**
	 * @param field_type $usuario_nome
	 */
	public function setUsuario_nome($usuario_nome) {
		$this->usuario_nome = $usuario_nome;
	}

	/**
	 * @return the $usuario_email
	 */
	public function getUsuario_email() {
		return $this->usuario_email;
	}

	/**
	 * @param field_type $usuario_email
	 */
	public function setUsuario_email($usuario_email) {
		$this->usuario_email = $usuario_email;
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
			throw new Exception("Invalid Application_Model_Credenciais property {$name}");
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid Application_Model_Credenciais property {$name}");
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
	
	
	
	
	
		
	
	
	
	

}

