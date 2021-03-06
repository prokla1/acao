<?php

class Application_Model_ParceirosContato
{

	
	protected $_id;
	protected $_id_parceiro;
	protected $_nome;
	protected $_email;
	protected $_assunto;
	protected $_mensagem;
	protected $_hora;
	protected $_enviado;

	
	



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
	 * @return the $_assunto
	 */
	public function getAssunto() {
		return $this->_assunto;
	}

	/**
	 * @param field_type $_assunto
	 */
	public function setAssunto($_assunto) {
		$this->_assunto = $_assunto;
	}

	/**
	 * @return the $_mensagem
	 */
	public function getMensagem() {
		return $this->_mensagem;
	}

	/**
	 * @param field_type $_mensagem
	 */
	public function setMensagem($_mensagem) {
		$this->_mensagem = $_mensagem;
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
	 * @return the $_enviado
	 */
	public function getEnviado() {
		return $this->_enviado;
	}

	/**
	 * @param field_type $_enviado
	 */
	public function setEnviado($_enviado) {
		$this->_enviado = $_enviado;
	}

	
	
	
	
	

}

