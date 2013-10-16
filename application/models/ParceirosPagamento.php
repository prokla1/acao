<?php

class Application_Model_ParceirosPagamento
{

	
	
	public $id;
	public $parceiro;
	public $pagamento;


	public $pagamento_nome;
	public $pagamento_imagem;
	
	
	
	
	/**
	 * @return the $pagamento_nome
	 */
	public function getPagamento_nome() {
		return $this->pagamento_nome;
	}
	
	/**
	 * @param field_type $pagamento_nome
	 */
	public function setPagamento_nome($pagamento_nome) {
		$this->pagamento_nome = $pagamento_nome;
	}
	
	/**
	 * @return the $pagamento_imagem
	 */
	public function getPagamento_imagem() {
		return $this->pagamento_imagem;
	}
	
	/**
	 * @param field_type $pagamento_imagem
	 */
	public function setPagamento_imagem($pagamento_imagem) {
		$this->pagamento_imagem = $pagamento_imagem;
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
			throw new Exception("Invalid Application_Model_EstabCozinha property {$name}");
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception("Invalid Application_Model_EstabCozinha property {$name}");
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

	
	

}

