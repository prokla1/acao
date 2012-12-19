<?php

class Application_Model_DbTable_Eventos extends Zend_Db_Table_Abstract
{

    protected $_name = 'eventos';
    

    // Declara a dependencia da tabela 'eventos' com a tabela 'parceiros'
    // através do model 'Application_Model_DbTable_Parceiros'.
    protected $_dependentTables = array('Application_Model_DbTable_Parceiros');
    
}

