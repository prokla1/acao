<?php

class Application_Model_DbTable_Parceiros extends Zend_Db_Table_Abstract
{

    protected $_name = 'parceiros';




    public function byId($id, Application_Model_Parceiro $parceiro)
    {
    	$result = $this->fetchRow('id = '.$id);
    	 
    	if($result)
    	{
    		$parceiros = $result->toArray();
    		$parceiro->setOptions($parceiros);
    		$parceiro->setLocal($result->id_endereco);
    		$parceiro->setFotos($id);
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
}


