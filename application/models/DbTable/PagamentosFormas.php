<?php

class Application_Model_DbTable_PagamentosFormas extends Zend_Db_Table_Abstract
{

    protected $_name = 'pagamento_formas';

    
    

    public function getAll()
    {
    	$resultSet = $this->select()
    	->from($this->_name)
    	->order('nome');
    	$pagamentos = array();
    	foreach ($resultSet->query() as $row)
    	{
    		$pagamentosModel = new Application_Model_PagamentoFormas($row);
    		$pagamentos[] = $pagamentosModel;
    	}
    	return $pagamentos;
    }
    
    

}

