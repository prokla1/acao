<?php

class Application_Model_Conversao
{

	protected $_id;
	protected $_id_cortesia;
	protected $_id_evento;
	protected $_id_usuario;
	protected $_qtd;
	protected $_pontos;
	protected $_reais;
	protected $_concretizado;
	protected $_visivel;
	
	
	protected $_evento;
	protected $_cortesia;
	protected $_usuario;



	/**
	 * @return the $_evento
	 */
	public function getUsuario() {
		return $this->_usuario;
	}
	
	/**
	 * @param field_type $_evento
	 */
	public function setUsuario($id_usuario) {
		$usuarioTable = new Application_Model_DbTable_Usuarios();
		$usuario = $usuarioTable->find($id_usuario);
		$this->_usuario = $usuario;
	}
	
	


	/**
	 * @return the $_evento
	 */
	public function getEvento() {
		return $this->_evento;
	}
	
	/**
	 * @param field_type $_evento
	 */
	public function setEvento($id_evento) {
		$eventoTable = new Application_Model_DbTable_Eventos();
		$evento = $eventoTable->byId($id_evento);
		$this->_evento = $evento;
	}
	
	
	/**
	 * @return the $_cortesia
	 */
	public function getCortesia() {

		return $this->_cortesia;
	}

	/**
	 * @param field_type $_cortesia
	 */
	public function setCortesia($id_cortesia) {
		$cortesiaTable = new Application_Model_DbTable_Cortesias();
		$cortesiaModel = new Application_Model_Cortesias();
		
		$cortesia = $cortesiaTable->byId($id_cortesia, $cortesiaModel);
		$this->_cortesia = $cortesia;
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
	 * @return the $_id_cortesia
	 */
	public function getId_cortesia() {
		return $this->_id_cortesia;
	}

	/**
	 * @param field_type $_id_cortesia
	 */
	public function setId_cortesia($_id_cortesia) {
		$this->_id_cortesia = $_id_cortesia;
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
	 * @return the $_id_usuario
	 */
	public function getId_usuario() {
		return $this->_id_usuario;
	}

	/**
	 * @param field_type $_id_usuario
	 */
	public function setId_usuario($_id_usuario) {
		$this->_id_usuario = $_id_usuario;
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
	 * @return the $_pontos
	 */
	public function getPontos() {
		return $this->_pontos;
	}

	/**
	 * @param field_type $_pontos
	 */
	public function setPontos($_pontos) {
		$this->_pontos = $_pontos;
	}

	/**
	 * @return the $_reais
	 */
	public function getReais() {
		return $this->_reais;
	}

	/**
	 * @param field_type $_reais
	 */
	public function setReais($_reais) {
		$this->_reais = $_reais;
	}

	/**
	 * @return the $_concretizado
	 */
	public function getConcretizado() {
		return $this->_concretizado;
	}

	/**
	 * @param field_type $_concretizado
	 */
	public function setConcretizado($_concretizado) {
		$this->_concretizado = $_concretizado;
	}
	/**
	 * @return the $_visivel
	 */
	public function getVisivel() {
		return $this->_visivel;
	}

	/**
	 * @param field_type $_visivel
	 */
	public function setVisivel($_visivel) {
		$this->_visivel = $_visivel;
	}


	
	
	

}

