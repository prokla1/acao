<?php

/**
 * @author jus
 *
 */
class Application_Model_Evento
{
	protected $_id;
	protected $_url_amigavel;
	protected $_id_parceiro;
	protected $_id_endereco;
	protected $_id_cidade;
	protected $_endereco;
	protected $_complemento;
	protected $_nome;
	protected $_descricao;
	protected $_capa;
	protected $_ativo;
	protected $_destaque;
	protected $_realizacao;
	protected $_hora;
	
	protected $_parceiro;
	//protected $_endereco;
	
	protected $_cortesias;
	
	protected $_generos;
	
	
	
		
	
	/**
	 * @param field_type $id_evento
	 */
	public function setGeneros($id_evento) {
		$generos = new Application_Model_DbTable_RelGeneros();
		$this->_generos = $generos->generosByEvento($id_evento);
	}
	
	/**
	 * @return the $_fotos (objeto class Application_Model_Generos)
	 */
	public function getGeneros() {
		return $this->_generos;
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
	 * @param field_type $id_evento
	 */
	public function setCortesias($id_evento) {
		$cortesiasTable = new Application_Model_DbTable_Cortesias();
		$cortesias = $cortesiasTable->cortesiasByEvento($id_evento);
		$this->_cortesias = $cortesias;
	}
	
	/**
	 * @return the $_parceiro (objeto class Parceiros)
	 */
	public function getCortesias() {
		return $this->_cortesias;
	}
	
	
	
	


	/**
	 * @param field_type $_id_parceiro
	 */
	public function setParceiroObj($parceiro0bj) {
		$this->_parceiro = $parceiro0bj;
	}


	/**
	 * @param field_type $_id_parceiro
	 */
	public function setParceiro($id_parceiro) {
		$parceiroTable = new Application_Model_DbTable_Parceiros();
		$parceiroModel = new Application_Model_Parceiro();
		$parceiro = $parceiroTable->byId($id_parceiro, $parceiroModel);
		$this->_parceiro = $parceiro;
	}
	
	/**
	 * @return the $_parceiro (objeto class Parceiros)
	 */
	public function getParceiro() {
		return $this->_parceiro;
	}
	



	/**
	 * @param field_type $_endereco
	 *//*
	public function setEndereco($id_endereco) {
		$enderecoTable = new Application_Model_DbTable_LocalEnderecos();
		$enderecoModel = new Application_Model_LocalEnderecos();
		$endereco = $enderecoTable->byId($id_endereco, $enderecoModel);
		$this->_endereco = $endereco;
	}*/
	
	/**
	 * @return the $_endereco (objeto class Endereco)
	 */
	public function getEndereco() {
		return $this->_endereco;
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
		//$this->setParceiro($_id_parceiro);
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
	 * @return the $_capa
	 */
	public function getCapa() {
		return $this->_capa;
	}

	/**
	 * @param field_type $_capa
	 */
	public function setCapa($_capa) {
		$this->_capa = $_capa;
	}

	/**
	 * @return the $_destaque
	 */
	public function getDestaque() {
		return $this->_destaque;
	}

	/**
	 * @param field_type $_destaque
	 */
	public function setDestaque($_destaque) {
		$this->_destaque = $_destaque;
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
	/**
	 * @return the $_url_amigavel
	 */
	public function getUrl_amigavel() {
		return $this->_url_amigavel;
	}

	/**
	 * @param field_type $_url_amigavel
	 */
	public function setUrl_amigavel($_url_amigavel) {
		$this->_url_amigavel = $_url_amigavel;
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






	
	
	
	
	
	

	
	
}

