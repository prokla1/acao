<?php

class Application_Model_Parceiro
{
	public $id;
	public $url_amigavel;
	public $id_usuario;
	public $nome;
	public $descricao;
	public $foto;
	public $ativo;
	//public $id_endereco;
	public $id_cidade;
	public $endereco;
	public $complemento;
	public $funcionamento;
	public $pagamento;
	public $telefone;
	public $num_votos;
	public $total_pontos;
	public $rating;
	public $hora;
	
	public $local;
	public $fotos;
	public $atividades;
	
	public $cidade_nome;
	public $estado_nome;
	public $pais_nome;

	/**
	 * @return the $cidade_nome
	 */
	public function getCidade_nome() {
		return $this->cidade_nome;
	}

	/**
	 * @param field_type $cidade_nome
	 */
	public function setCidade_nome($cidade_nome) {
		$this->cidade_nome = $cidade_nome;
	}

	/**
	 * @return the $estado_nome
	 */
	public function getEstado_nome() {
		return $this->estado_nome;
	}

	/**
	 * @param field_type $estado_nome
	 */
	public function setEstado_nome($estado_nome) {
		$this->estado_nome = $estado_nome;
	}

	/**
	 * @return the $pais_nome
	 */
	public function getPais_nome() {
		return $this->pais_nome;
	}

	/**
	 * @param field_type $pais_nome
	 */
	public function setPais_nome($pais_nome) {
		$this->pais_nome = $pais_nome;
	}

	
	
	
	
	/**
	 * @param field_type $id_parceiro
	 */
	public function setAtividades($id_parceiro) {
		$atividades = new Application_Model_DbTable_RelAtividades();
		$this->atividades = $atividades->byParceiro($id_parceiro);
	}
	
	/**
	 * @return the $fotos (objeto class Application_Model_Atividades)
	 */
	public function getAtividades() {
		return $this->atividades;
	}
	
	




	/**
	 * @param field_type $id_parceiro
	 */
	public function setFotos($id_parceiro) {
		$fotos = new Application_Model_DbTable_ParceirosFotos();
		$this->fotos = $fotos->fotosByParceiro($id_parceiro);
	}
	
	/**
	 * @return the $fotos (objeto class Application_Model_ParceirosFotos)
	 */
	public function getFotos() {
		return $this->fotos;
	}
	
	
		




	/**
	 * @param field_type $id_endereco
	 */
	public function setLocal($id_cidade) {
		$localCidadeTable = new Application_Model_DbTable_LocalCidades();
		$localCidadeModel = new Application_Model_LocalCidades();
		$localCidade = $localCidadeTable->byId($id_cidade, $localCidadeModel);
		
		$this->local = $localCidade;
	}
	/*
	public function setLocal($id_endereco) {
		$localEnderecoTable = new Application_Model_DbTable_LocalEnderecos();
		$localEnderecoModel = new Application_Model_LocalEnderecos();
		$localEndereco = $localEnderecoTable->byId($id_endereco, $localEnderecoModel);
	
		$this->local = $localEndereco;
	}
	*/
	
	/**
	 * @return the $local (objeto class Local)
	 */
	public function getLocal() {
		return $this->local;
	}
	
	
	
	
	
	

	/**
	 * Retorna os atributos public em array
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
	 * @return the $url_amigavel
	 */
	public function getUrl_amigavel() {
		return $this->url_amigavel;
	}

	/**
	 * @param field_type $url_amigavel
	 */
	public function setUrl_amigavel($url_amigavel) {
		$this->url_amigavel = $url_amigavel;
	}

	/**
	 * @return the $id_usuario
	 */
	public function getId_usuario() {
		return $this->id_usuario;
	}

	/**
	 * @param field_type $id_usuario
	 */
	public function setId_usuario($id_usuario) {
		$this->id_usuario = $id_usuario;
	}

	/**
	 * @return the $nome
	 */
	public function getNome() {
		return $this->nome;
	}

	/**
	 * @param field_type $nome
	 */
	public function setNome($nome) {
		$this->nome = $nome;
	}

	/**
	 * @return the $descricao
	 */
	public function getDescricao() {
		return $this->descricao;
	}

	/**
	 * @param field_type $descricao
	 */
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}

	/**
	 * @return the $foto
	 */
	public function getFoto() {
		return $this->foto;
	}

	/**
	 * @param field_type $foto
	 */
	public function setFoto($foto) {
		$this->foto = $foto;
	}

	/**
	 * @return the $ativo
	 */
	public function getAtivo() {
		return $this->ativo;
	}

	/**
	 * @param field_type $ativo
	 */
	public function setAtivo($ativo) {
		$this->ativo = $ativo;
	}

	



	/**
	 * @return the $id_endereco
	 */
	public function getId_endereco() {
		return $this->id_endereco;
	}
	
	/**
	 * @param field_type $id_endereco
	 */
	public function setId_endereco($id_endereco) {
		$this->id_endereco = $id_endereco;
	}
	
	
	
	/**
	 * @return the $hora
	 */
	public function getHora() {
		return $this->hora;
	}

	/**
	 * @param field_type $hora
	 */
	public function setHora($hora) {
		$this->hora = $hora;
	}
	/**
	 * @return the $funcionamento
	 */
	public function getFuncionamento() {
		return $this->funcionamento;
	}

	/**
	 * @param field_type $funcionamento
	 */
	public function setFuncionamento($funcionamento) {
		$this->funcionamento = $funcionamento;
	}

	/**
	 * @return the $pagamento
	 */
	public function getPagamento() {
		return $this->pagamento;
	}

	/**
	 * @param field_type $pagamento
	 */
	public function setPagamento($pagamento) {
		$this->pagamento = $pagamento;
	}
	/**
	 * @return the $telefone
	 */
	public function getTelefone() {
		return $this->telefone;
	}

	/**
	 * @param field_type $telefone
	 */
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
	}

	/**
	 * @return the $num_votos
	 */
	public function getNum_votos() {
		return $this->num_votos;
	}

	/**
	 * @param field_type $num_votos
	 */
	public function setNum_votos($num_votos) {
		$this->num_votos = $num_votos;
	}

	/**
	 * @return the $total_pontos
	 */
	public function getTotal_pontos() {
		return $this->total_pontos;
	}

	/**
	 * @param field_type $total_pontos
	 */
	public function setTotal_pontos($total_pontos) {
		$this->total_pontos = $total_pontos;
	}

	/**
	 * @return the $rating
	 */
	public function getRating() {
		return $this->rating;
	}

	/**
	 * @param field_type $rating
	 */
	public function setRating($rating) {
		$num_votos = $this->num_votos;
		$total_pontos = $this->total_pontos;
		$rating = ($this->num_votos > 0) ? $total_pontos / $num_votos : 0;
		$this->rating = $rating;
	}
	/**
	 * @return the $id_cidade
	 */
	public function getId_cidade() {
		return $this->id_cidade;
	}

	/**
	 * @param field_type $id_cidade
	 */
	public function setId_cidade($id_cidade) {
		$this->id_cidade = $id_cidade;
	}

	/**
	 * @return the $endereco
	 */
	public function getEndereco() {
		return $this->endereco;
	}

	/**
	 * @param field_type $endereco
	 */
	public function setEndereco($endereco) {
		$this->endereco = $endereco;
	}

	/**
	 * @return the $complemento
	 */
	public function getComplemento() {
		return $this->complemento;
	}

	/**
	 * @param field_type $complemento
	 */
	public function setComplemento($complemento) {
		$this->complemento = $complemento;
	}


	
	
	

}

