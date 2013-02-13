<?php

class Application_Model_DbTable_Rating extends Zend_Db_Table_Abstract
{

    protected $_name = 'ratings';

    function jaVotou($ip, $id_parceiro)
    {

    	$result = $this->fetchRow(
		    			$this->select()
		    			->where('ip = ?', $ip)
		    			->where('id_parceiro = ?', $id_parceiro)
// 		    			->where('hora > ?', date('Y-m-d h:i:s', (time() - 86400)))
		    			->where('hora > ?', (time() - 86400))
    				);
    	
    	$votou = (count($result) == 0) ? false : true;
    	 
		if($votou == false)
		{
			$data = array(
					'id_parceiro'	=>	$id_parceiro,
					'ip'			=>	$ip
					);
			
			$this->insert($data);
		}
		
    	return $votou;
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
}

