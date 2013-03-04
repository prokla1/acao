<?php

class Application_Model_DbTable_Parceiros extends Zend_Db_Table_Abstract
{

    protected $_name = 'parceiros';


    public function getParceirosList()  //para popular o select no form de cadastro dos eventos
    
    {
    	$select  = $this->select()->from($this->_name,
    			array('key' => 'id','value' => 'nome'))
    			->order('nome');
    	$result = $this->getAdapter()->fetchAll($select);
    	return $result;
    }


    public function byId($id, Application_Model_Parceiro $parceiro)
    {
    	$result = $this->fetchRow('id = '.$id);
    	 
    	if($result)
    	{
    		$parceiros = $result->toArray();
    		$parceiro->setOptions($parceiros);
    		$parceiro->setLocal($result->id_endereco);
    		$parceiro->setFotos($id);
    		$parceiro->setAtividades($id);
    	}else
    	{
    		$parceiro = null;
    	}
    
    
    	return $parceiro;
    }



    public function byUrl($url, Application_Model_Parceiro $parceiro)
    {
    	$result = $this->fetchRow($this->select()->where('url_amigavel = ?', $url));
    	 
    	if($result)
    	{
    		$parceiros = $result->toArray();
    		$parceiro->setOptions($parceiros);
    		$parceiro->setLocal($result->id_endereco);
    		$parceiro->setFotos($result->id);
    		$parceiro->setAtividades($result->id);
    	}else
    	{
    		$parceiro = null;
    	}
    
    
    	return $parceiro;
    }
    
    
    
    
    public function rating($id_parceiro, $nota)
    {
    	$this->update(array(
		    			'num_votos' => new Zend_Db_Expr('num_votos + 1'), 
		    			'total_pontos' =>  new Zend_Db_Expr('total_pontos + '.$nota),
    					'rating' => new Zend_Db_Expr('(total_pontos / num_votos)')
    				),    			 
    				'id = "'. $id_parceiro .'"');
    	 
    	return $this->byId($id_parceiro, new Application_Model_Parceiro());
    }
    
    
    
    
    

    public function save(Application_Model_Parceiro $parceiro)
    {
    	$data = array(
    			'url_amigavel' => $parceiro->getUrl_amigavel(),
    			'id_usuario' => null,
    			'nome' => $parceiro->getNome(),
    			'descricao' => $parceiro->getDescricao(),
    			'foto' => $parceiro->getFoto(),
    			'ativo' => $parceiro->getAtivo(),
    			'id_endereco' => $parceiro->getId_endereco(),
    			'foto' => $parceiro->getFoto(),
    			'funcionamento' => $parceiro->getFuncionamento(),
    			'pagamento' => $parceiro->getPagamento(),
    			'telefone' => $parceiro->getTelefone(),
    	);
    
    	// id == null -> insert
    	if (null === ($id = $parceiro->getId())) {
    		unset($data['id']);
    		return $this->insert($data);
    	} else {
    		return $this->update($data, array('id = ?' => $id));
    	}
    }
     
     
}


