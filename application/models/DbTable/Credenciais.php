<?php

class Application_Model_DbTable_Credenciais extends Zend_Db_Table_Abstract
{

    protected $_name = 'credenciais';

    
    



    /**
     * Verificar se o USUARIO tem permissão para tal PARCEIRO
     * @param unknown_type $id_usuario
     * @param unknown_type $id_estab
     * @return boolean
     */
    public function permissao($id_usuario, $id_parceiro)
    {
    	$select  = $this->select()->from($this->_name,
    			array('key' => 'id'))
    			->where("parceiro = ?", $id_parceiro)
    			->where("usuario = ?", $id_usuario);
    	if($this->getAdapter()->fetchAll($select))
    	{
    		return true;
    	}else
    	{
    		return false;
    	}
    }
    
    
    /**
     * Retorna os estabelecimentos que o USUARIO tem credencial para acessar
     * @param unknown_type $usuario
     * @return multitype:Application_Model_Credenciais
     */
    public function getByUsuario($usuario)
    {
    	return $this->getCredenciais($usuario);
    }
    
    /**
     * Retorna todas as credenciais, para listar no SETTINGS
     * @param unknown_type $usuario
     * @return multitype:Application_Model_Credenciais
     */
    public function getCredenciais($usuario = null)
    {
    	$resultSet = $this->select()
    	->setIntegrityCheck(false) // allows joins
    	->from($this->_name)
    	->joinLeft(
    			array(
    					'parceiros'		=>	'parceiros'
    			),
    			'credenciais.parceiro	=	parceiros.id',
    			array(
    					'parceiro_nome'	=>	'parceiros.nome',
    					'parceiro_url'	=>	'parceiros.url_amigavel',
    			)
    	)
    	->joinLeft(
    			array(
    					'usuarios'		=>	'usuarios'
    			),
    			'credenciais.usuario	=	usuarios.id',
    			array(
    					'usuario_nome'	=>	'usuarios.nome',
    					'usuario_email'	=>	'usuarios.email',
    			)
    	)
    	->order('parceiros.nome')
    	->order('usuarios.email');
    
    	if($usuario)
    	{
    		$resultSet->where('usuarios.id = ?', $usuario);
    	}
    
    
    	$credenciais = array();
    	
    	foreach($resultSet->query() as $row)
    	{
    		//print_r($row);
    		
    		$credencial = new Application_Model_Credenciais();
    		$credencial->setOptions($row);
    
    		/*
    		$parceiroTable = new Application_Model_DbTable_Parceiros();
    		$credencial->setParceiroObj($parceiroTable->byId($row['parceiro'], new Application_Model_Parceiro()));
    			
    		$usuarioTable = new Application_Model_DbTable_Usuarios();
    		$credencial->setUsuarioObj($usuarioTable->byId($row['usuario'], new Application_Model_Usuario()));
    		*/
    			
    		$credenciais[] = $credencial;
    	}
    	return $credenciais;
    }
    
    
    
    
    /**
     * Deleta a credencial
     * @param int $credencial
     * @return number
     */
    public function del($credencial)
    {
    	$where = array(
    			$this->getAdapter()->quoteInto('id = ?', $credencial)
    	);
    	return $this->delete($where);
    }
    
    
    

}

