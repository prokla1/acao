<?php

class Application_Model_DbTable_Parceiros extends Zend_Db_Table_Abstract
{

    protected $_name = 'parceiros';

    

    protected $_referenceMap = array(
    		'refParceiros' => array(
    				'refTableClass' => 'Application_Model_DbTable_Eventos',
    				'refColumns'    => array('id'),
    				'columns'       => array('id_parceiro')
    		)
    );

}

