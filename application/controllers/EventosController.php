<?php

class EventosController extends Zend_Controller_Action
{

    public function init()
    {
    	$sess = new Zend_Session_Namespace('City');
    	$this->cityId = $sess->id;
     	$this->cityNome = $sess->nome;
     	$this->view->cityId = $this->cityId;
     	$this->view->cityNome = $this->cityNome;
     	$this->view->doctype('XHTML1_RDFA');

     	
     	$sessTipo = new Zend_Session_Namespace('Tipo');
     	if ($this->_getParam('tipo') && $this->_getParam('tipo') != ':tipo')
     	{
     		$this->tipo = $this->_getParam('tipo');
     		$sessTipo->tipo = $this->_getParam('tipo');
     	}else {
     		if ($sessTipo->tipo)
     		{
     			$this->tipo = $sessTipo->tipo;
     		}else
     		{
     			$this->tipo = 'todos';
     			$sessTipo->tipo = 'todos';
     		}
     	}
     	$this->view->tipo = $this->tipo; //$tipo;
     	
     	

     	$sessDia = new Zend_Session_Namespace('Dia');
     	if ($this->_getParam('d'))
     	{
     		$this->dia_base = $this->_getParam('d');
     		$sessDia->dia = $this->dia_base;
     	}else {
     		if ($sessDia->dia)
     		{
     			$this->dia_base = $sessDia->dia;
     		}else
     		{
     			$this->dia_base = time();
     			$sessDia->dia = $this->dia_base;
     		}
     	}
     	
     	
    }
    
    

    public function indexAction()
    {

    	if(empty($this->cityId))
    	{
    		return $this->_forward('index', 'localidade');
    	}
    	
    	

    	
    	
//     	$dia_base = $this->_getParam('d');
//     	if(empty($dia_base)){
//     		$dia_base = time(); //+86400*50;  //86400 = 1 dia
//     	}
    	
    	$dia_base = $this->dia_base;
    	$this->view->dia_base = $dia_base;
    	
    	$eventos = new Application_Model_DbTable_Eventos();
    	
    	
    	
    	if ($this->tipo && $this->tipo != 'todos' && $this->tipo != ':tipo')
    	{
    		$this->view->eventos = $eventos->findByCityDateType($this->cityId, $dia_base, $this->tipo);
    	}else 
    	{
    		$this->view->eventos = $eventos->findByCityAndDate($this->cityId, $dia_base);
    	}
    	

    	//$this->view->eventos = $eventos->findByCity($this->cityId);
//     	$eventosTable = new Application_Model_DbTable_Eventos();
//     	$this->view->destaques = $eventosTable->findByCityDestaques($this->cityId);
    }


//     public function festasAction()
//     {
//     	$sess = new Zend_Session_Namespace('Atividade');
//     	$sess->id = '6';
//     	$sess->nome = 'festas';
    	 
//     	return $this->_forward('index', 'eventos', array('tipo' => 'festas'));
//     }

//     public function teatroAction()
//     {
//     	$sess = new Zend_Session_Namespace('Atividade');
//     	$sess->id = '2';
//     	$sess->nome = 'teatro';
//     	return $this->_forward('index', 'eventos', array('tipo' => 'teatro'));
//     }

//     public function cinemaAction()
//     {
//     	$sess = new Zend_Session_Namespace('Atividade');
//     	$sess->id = '1';
//     	$sess->nome = 'cinema';
//     	return $this->_forward('index', 'eventos', array('tipo' => 'cinema'));
//     }
    
//     public function todosAction()
//     {
//     	$sess = new Zend_Session_Namespace('Atividade');
//     	$sess->id = '0';
//     	$sess->nome = 'todos';
//     	return $this->_forward('index', 'eventos', array('tipo' => 'todos'));
//     }

}

