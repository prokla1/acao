<?php

class Application_Model_Parceiro
{
	protected $_id;
	protected $_url_amigavel;
	protected $_id_usuario;
	protected $_nome;
	protected $_descricao;
	protected $_foto;
	protected $_ativo;
	protected $_id_tipo;
	protected $_id_endereco;
	protected $_funcionamento;
	protected $_pagamento;
	protected $_telefone;
	protected $_num_votos;
	protected $_total_pontos;
	protected $_rating;
	protected $_hora;
	
	protected $_local;
	protected $_fotos;
	protected $_atividades;
	protected $_tipo;
	





	/**
	 * @param field_type $_id_parceiro
	 */
	public function setAtividades($id_parceiro) {
		$atividades = new Application_Model_DbTable_RelAtividades();
		$this->_atividades = $atividades->atividadesByParceiro($id_parceiro);
	}
	
	/**
	 * @return the $_fotos (objeto class Application_Model_Atividades)
	 */
	public function getAtividades() {
		return $this->_atividades;
	}
	
	




	/**
	 * @param field_type $_id_parceiro
	 */
	public function setFotos($id_parceiro) {
		$fotos = new Application_Model_DbTable_ParceirosFotos();
		$this->_fotos = $fotos->fotosByParceiro($id_parceiro);
	}
	
	/**
	 * @return the $_fotos (objeto class Application_Model_ParceirosFotos)
	 */
	public function getFotos() {
		return $this->_fotos;
	}
	
	
		




	/**
	 * @param field_type $_id_endereco
	 */
	public function setLocal($id_endereco) {
		$localEnderecoTable = new Application_Model_DbTable_LocalEnderecos();
		$localEnderecoModel = new Application_Model_LocalEnderecos();
		$localEndereco = $localEnderecoTable->byId($id_endereco, $localEnderecoModel);
		
		$this->_local = $localEndereco;
		
	}
	
	/**
	 * @return the $_local (objeto class Local)
	 */
	public function getLocal() {
		return $this->_local;
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
	 * @return the $_funcionamento
	 */
	public function getFuncionamento() {
		return $this->_funcionamento;
	}

	/**
	 * @param field_type $_funcionamento
	 */
	public function setFuncionamento($_funcionamento) {
		$this->_funcionamento = $_funcionamento;
	}

	/**
	 * @return the $_pagamento
	 */
	public function getPagamento() {
		return $this->_pagamento;
	}

	/**
	 * @param field_type $_pagamento
	 */
	public function setPagamento($_pagamento) {
		$this->_pagamento = $_pagamento;
	}
	/**
	 * @return the $_telefone
	 */
	public function getTelefone() {
		return $this->_telefone;
	}

	/**
	 * @param field_type $_telefone
	 */
	public function setTelefone($_telefone) {
		$this->_telefone = $_telefone;
	}

	/**
	 * @return the $_num_votos
	 */
	public function getNum_votos() {
		return $this->_num_votos;
	}

	/**
	 * @param field_type $_num_votos
	 */
	public function setNum_votos($_num_votos) {
		$this->_num_votos = $_num_votos;
	}

	/**
	 * @return the $_total_pontos
	 */
	public function getTotal_pontos() {
		return $this->_total_pontos;
	}

	/**
	 * @param field_type $_total_pontos
	 */
	public function setTotal_pontos($_total_pontos) {
		$this->_total_pontos = $_total_pontos;
	}

	/**
	 * @return the $_rating
	 */
	public function getRating() {
		return $this->_rating;
	}

	/**
	 * @param field_type $_rating
	 */
	public function setRating($_rating) {
		$num_votos = $this->_num_votos;
		$total_pontos = $this->_total_pontos;
		$rating = ($this->_num_votos > 0) ? $total_pontos / $num_votos : 0;
		$this->_rating = $rating;
	}

	
	
	

}

