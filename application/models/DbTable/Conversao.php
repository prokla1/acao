<?php

class Application_Model_DbTable_Conversao extends Zend_Db_Table_Abstract
{

    protected $_name = 'conversao';


    
    /**
     * faz a conversao, grava os dados reverente a convesao e diminui a disponibilidade da cortesia
     * @return resultado do insert
     */
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

    

    /**
     * Verifica se o usuario já converteu a cortesia pelo ID_USUARIO e ID_CORTESIA
     * @param String $id_usuario, $id_cortesia
     * @return boolean FALSE / TRUE
     */
    public function jaConverteu($id_usuario, $id_cortesia){
    	$resultSet = $this->select()
	    	->from('conversao')
	    	->where('id_cortesia = ?', $id_cortesia)
	    	->order('hora')
	    	->query();
    	
    
    	return $result->toArray(); //(count($this->fetchAll($where)) == 0) ? false : true;
    }



    /**
     * Retorna todas as "CORTESIAS" convertidas de um ID_CORTESIA
     * @return multitype:Application_Model_Cortesias
     */
    public function byIdCortesia($id_cortesia)
    {

    	$resultSet = $this->select()
	    	->from('conversao')
	    	->where('id_cortesia = ?', $id_cortesia)
	    	->order('hora')
	    	->query();
    	
    	$conversoes = array();
    	foreach ($resultSet as $row) {
    	
    		$conversaoModel = new Application_Model_Conversao();
    		$conversaoModel->setOptions($row);
    		$conversaoModel->setUsuario($row['id_usuario']);
    	
    		$conversoes[] = $conversaoModel;
    	}
    	return $conversoes;
    }
}

