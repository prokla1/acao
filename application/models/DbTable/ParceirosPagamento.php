<?php

class Application_Model_DbTable_ParceirosPagamento extends Zend_Db_Table_Abstract
{

    protected $_name = 'parceiros_pagamento';

    
    


    /**
     * Salva os tipos de pagamento aceitos pelo PARCEIRO
     * @param array $pagamentos
     * @param unknown_type $parceiro
     * @return Application_Model_DbTable_ParceirosPagamento
     */
    public function savePagamentos(array $pagamentos, $parceiro)
    {
    	foreach ($pagamentos as $pagamento)
    	{
    		$data = array(
    				'parceiro' => $parceiro,
    				'pagamento' => $pagamento,
    		);
    		$this->insert($data);
    	}
    	return $this;
    }
    
    
    
    /**
     * Deleta a forma de pagamento aceita pelo PARCEIRO
     * @param unknown_type $id
     * @param unknown_type $parceiro
     * @return number
     */
    public function del($id, $parceiro = null)
    {
    	$where = array(
    			$this->getAdapter()->quoteInto('id = ?', $id),
    			$this->getAdapter()->quoteInto('parceiro = ?', $parceiro)
    	);
    	return $this->delete($where);
    }
    
    
    /**
     * Retorna os tipos de pagamento aceito pelo PARCEIRO
     * @param unknown_type $estab
     * @return multitype:Application_Model_ParceirosPagamento
     */
    public function byParceiro($parceiro)
    {
    	$pagamentos = array();
    
    	$resultSet = $this->select()
    	->setIntegrityCheck(false) 
    	->from($this->_name)
    	->joinRight( 
    			array(
    					'pagamento_formas'		=>	'pagamento_formas'
    			),
    			'pagamento_formas.id			=	parceiros_pagamento.pagamento',
    			array( 
    					'pagamento_nome'	=>	'pagamento_formas.nome',
    					'pagamento_imagem'	=>	'pagamento_formas.imagem',
    					'pagamento_descricao'	=>	'pagamento_formas.descricao',
    			)
    	)
    	->where("parceiros_pagamento.parceiro = ?", $parceiro)
    	->order('pagamento_formas.nome');
    
    	foreach($resultSet->query() as $row)
    	{
    		$pagamento = new Application_Model_ParceirosPagamento($row);
    		$pagamentos[] = $pagamento;
    	}
    	return $pagamentos;
    }
    
    

}

