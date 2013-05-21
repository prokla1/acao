<?php

class Application_Model_LocalEnderecos
{
	public $id;
	public $id_cidade;
	public $rua;
	public $numero;
	public $complemento;
	
	public $cidade;
	
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
	public function setCidade($id_endereco) {
		
		$cidadeTable = new Application_Model_DbTable_LocalCidades();
		$cidadeModel = new Application_Model_LocalCidades();
		$cidade = $cidadeTable->byId($id_endereco, $cidadeModel);
		
		$this->cidade = $cidade;
	}
	
	/**
	 * @return the $parceiro (objeto class Parceiros)
	 */
	public function getCidade() {
		return $this->cidade;
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
			throw new Exception("Invalid Application_Model_LocalEnderecos property {$name}");
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid Application_Model_LocalEnderecos property {$name}");
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
	 * @return the $rua
	 */
	public function getRua() {
		return $this->rua;
	}

	/**
	 * @param field_type $rua
	 */
	public function setRua($rua) {
		$this->rua = $rua;
	}

	/**
	 * @return the $numero
	 */
	public function getNumero() {
		return $this->numero;
	}

	/**
	 * @param field_type $numero
	 */
	public function setNumero($numero) {
		$this->numero = $numero;
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

