<?php

class Application_Model_DbTable_Conversao extends Zend_Db_Table_Abstract
{

    protected $_name = 'conversao';

    
    public function converter(Application_Model_Cortesias $cortesia,  Application_Model_Usuario $usuario)
    {
    	$cortesiasTable = new Application_Model_DbTable_Cortesias();
    	$cortesiasTable->update(array('disponivel' => new Zend_Db_Expr('disponivel - 1')), 'id = "'. $cortesia->id .'"');
    	
    	$conversaoTable = new Application_Model_DbTable_Conversao();
    	
    	$data = array(
    			'id_cortesia' => $cortesia->id,
    			'id_evento' => $cortesia->evento->id,
    			'id_usuario' => $usuario->id,
    			'qtd' => '1',
    			//$conversaoModel->setPontos('0');
    			'reais' => $cortesia->valor,
    			'concretizado' => '1',
    			'visivel' => '1',
    			
    			
    	);
    	
    	$conversaoTable->insert($data);
    	
    	return $cortesiasTable;
    }

}

