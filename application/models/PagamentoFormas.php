<?php

class Application_Model_PagamentoFormas
{


	public $id;
	public $nome;
	public $imagem;
	public $troco;
	public $descricao;
	



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
			throw new Exception("Invalid Application_Model_Estabelecimentos property {$name}");
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid Application_Model_Estabelecimentos property {$name}");
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
	 * @return the $imagem
	 */
	public function getImagem() {
		return $this->imagem;
	}

	/**
	 * @param field_type $imagem
	 */
	public function setImagem($imagem) {
		$this->imagem = $imagem;
	}

	/**
	 * @return the $troco
	 */
	public function getTroco() {
		return $this->troco;
	}

	/**
	 * @param field_type $troco
	 */
	public function setTroco($troco) {
		$this->troco = $troco;
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

	
	
	
	
	
}

