<?php

class Application_Model_DbTable_Usuarios extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuarios';

    

    
    public function save(Application_Model_Usuario $usuario)
    {
    	$data = array(
    			'nome' => $usuario->getNome(),
    			'email' => $usuario->getEmail(),
    			'senha' => $usuario->getSenha(),
    			'sexo' => $usuario->getSexo(),
    			'nascimento' => $usuario->getNascimento()
    	);
    
    	// id == null -> insert
    	if (null === ($id = $usuario->getId())) {
    		unset($data['id']);
    
    		// is unique eamil?
    		if($this->isUniqueEmail($usuario->getEmail())){
    			$this->insert($data);
    		}
    		else {
    			throw new Exception('This email is already being used.');
    		}
    			
    	} else {
    		$this->update($data, array('id = ?' => $id));
    	}
    }
    
    
    
    /**
     * Verifica se o email já existe
     * @param String $email
     * @return boolean
     */
    public function isUniqueEmail($email){
    	$where = $this->getDefaultAdapter()
    			->quoteInto('email = ?', $email);
    
    	return (count($this->fetchAll($where)) == 0) ? true : false;
    }
    

}

