<?php

class Application_Model_Usuario
{

	protected $_id;
	protected $_id_facebook;
	protected $_nome;
	protected $_cpf;
	protected $_email;
	protected $_senha;
	protected $_sexo;
	protected $_nascimento;
	protected $_foto;
	protected $_ativo;
	protected $_email_verificado;
	protected $_id_endereco;
	protected $_hora;
	protected $_array_face;
	
	



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
	 * @return the $_id_facebook
	 */
	public function getId_facebook() {
		return $this->_id_facebook;
	}

	/**
	 * @param field_type $_id_facebook
	 */
	public function setId_facebook($_id_facebook) {
		$this->_id_facebook = $_id_facebook;
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
	 * @return the $_cpf
	 */
	public function getCpf() {
		return $this->_cpf;
	}

	/**
	 * @param field_type $_cpf
	 */
	public function setCpf($_cpf) {
		$this->_cpf = $_cpf;
	}

	/**
	 * @return the $_email
	 */
	public function getEmail() {
		return $this->_email;
	}

	/**
	 * @param field_type $_email
	 */
	public function setEmail($_email) {
		$this->_email = $_email;
	}

	/**
	 * @return the $_senha
	 */
	public function getSenha() {
		return $this->_senha;
	}

	/**
	 * @param field_type $_senha
	 */
	public function setSenha($_senha) {
		$this->_senha = md5($_senha);
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
	 * @return the $_nascimento
	 */
	public function getNascimento() {
		return $this->_nascimento;
	}

	/**
	 * @param field_type $_nascimento
	 */
	public function setNascimento($_nascimento) {
		$this->_nascimento = $_nascimento;
	}

	/**
	 * @return the $_foto
	 */
	public function getFoto() {
		return $this->_foto;
	}

	/**
	 * @param field_type $_foto
	 */
	public function setFoto($_foto) {
		$this->_foto = $_foto;
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
	 * @return the $_email_verificado
	 */
	public function getEmail_verificado() {
		return $this->_email_verificado;
	}

	/**
	 * @param field_type $_email_verificado
	 */
	public function setEmail_verificado($_email_verificado) {
		$this->_email_verificado = $_email_verificado;
	}

	/**
	 * @return the $_id_endereco
	 */
	public function getId_endereco() {
		return $this->_id_endereco;
	}

	/**
	 * @param field_type $_id_endereco
	 */
	public function setId_endereco($_id_endereco) {
		$this->_id_endereco = $_id_endereco;
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

	/**
	 * @return the $_array_face
	 */
	public function getArray_face() {
		return $this->_array_face;
	}

	/**
	 * @param field_type $_array_face
	 */
	public function setArray_face($_array_face) {
		$this->_array_face = $_array_face;
	}

	
	

}

