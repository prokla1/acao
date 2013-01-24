<?php

class Application_Model_DbTable_Usuarios extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuarios';



    /*
     * seleciona o usuario pelo ID
    * retorn objeto USUARIO
    */
    public function byId($id, Application_Model_Usuario $usuario)
    {
    	$result = $this->fetchRow('id = '.$id);
    	$usuarios = $result->toArray();
    	$usuario->setOptions($usuarios);
    	return $usuario;
    }
    


    /*
     * seleciona o usuario pelo EMAIL vindo do FACE
    * retorn objeto USUARIO
    */
    public function byEmailFace($user_get, Application_Model_Usuario $usuario)
    {
    	$select = $this->select()->where('email = ?', $user_get['email']);
    	$result = $this->fetchRow($select);
    	    	
    	//$result = $this->fetchRow('email = '.$email);
    	//$usuario = $user_get;
    	if($result)
    	{
	    	$usuarios = $result->toArray();
	    	$usuario->setOptions($usuarios);
    	}else 
    	{
    		//save
    		$usuario->setId_facebook($user_get['id']);
    		$usuario->setNome($user_get['name']);
    		$usuario->setEmail($user_get['email']);
    		$usuario->setNascimento($user_get['birthday']);
    		$usuario->setAtivo('1');
    		$usuario->setArray_face(json_encode($user_get));
    		$this->insert($usuario->getArray());
    	}
    	return $usuario;
    }
    
      
    
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

