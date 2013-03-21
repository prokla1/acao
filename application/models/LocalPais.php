<?php

/**
 * @author jus
 *
 */
class Application_Model_LocalPais
{

	public $id;
	public $sigla;
	public $nome;
	

	

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
		return $this->id;
	}

	/**
	 * @param field_type $_id
	 */
	public function setId($_id) {
		$this->id = $_id;
	}

	/**
	 * @return the $_sigla
	 */
	public function getSigla() {
		return $this->sigla;
	}

	/**
	 * @param field_type $_sigla
	 */
	public function setSigla($_sigla) {
		$this->sigla = $_sigla;
	}

	/**
	 * @return the $_nome
	 */
	public function getNome() {
		return $this->nome;
	}

	/**
	 * @param field_type $_nome
	 */
	public function setNome($_nome) {
		$this->nome = $_nome;
	}

	
	
	

}

