<?php

class Application_Model_DbTable_Eventos extends Zend_Db_Table_Abstract
{

    protected $_name = 'eventos';
    

    protected $_dependentTables = array('Application_Model_DbTable_Parceiros');
    
    /*
    protected $_referenceMap = array(
    		'refParceiros' => array(
    				'refTableClass' => 'Application_Model_DbTable_Parceiros',
    				'refColumns'    => array('id'),
    				'columns'       => array('id_parceiro')
    		)
    );
    
   */ 
}

