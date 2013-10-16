<?php

class Application_Model_DbTable_Usuarios extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuarios';

    

    /**
     * Retorna os emails e os IDs para fazer o select (usado para setar as credenciais)
     * @return Ambigous <multitype:, multitype:mixed Ambigous <string, boolean, mixed> >
     */
    public function getEmails()
    {
    	$select  = $this->select()->from($this->_name,
    			array('key' => 'id','value' => 'email'))
    			->order('email')
    			->where('ativo = ?', '1');
    	$result = $this->getAdapter()->fetchAll($select);
    	return $result;
    }
    


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
     * ou salva caso ele ainda não exista
    * retorn objeto USUARIO
    */
    public function byEmailFace($user_get, Application_Model_Usuario $usuario)
    {
    	$select = $this->select()->where('email = ?', $user_get['email']);
    	$result = $this->fetchRow($select);
    	    	
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
    		$usuario->setNascimento(date('Y-m-d', strtotime($user_get['birthday'])));
    		$usuario->setAtivo('1');
    		$usuario->setEmail_verificado('1');
    		
    		$sexo = '0';
    		switch ($user_get['gender'])
    		{
    			case 'male':
    				$sexo = '1';
    				break;
    			case 'female':
    				$sexo = '2';
    				break;
    			default:
    				$sexo = '0';
    		}
    		$usuario->setSexo($sexo);
    		
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
    		if($this->isUniqueEmail($usuario->getEmail()))
    		{
//     			if($this->isUniqueCPF($usuario->getCpf()))
//     			{
    				$this->insert($data);
//     			}else 
//     			{
//     				throw new Exception('Este CPF já esta sendo utilizado.');
//     			}
    			
    		}else 
    		{
    			throw new Exception('Este email já esta sendo utilizado.');
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
    	$where = $this->getDefaultAdapter()->quoteInto('email = ?', $email);
    	return (count($this->fetchAll($where)) == 0) ? true : false;
    }    
    
    /**
     * Verifica se o CPF já existe
     * @param String $cpf
     * @return boolean
     */
    public function isUniqueCPF($cpf){
    	$where = $this->getDefaultAdapter()->quoteInto('cpf = ?', $cpf);
    	return (count($this->fetchAll($where)) == 0) ? true : false;
    }
    

}

