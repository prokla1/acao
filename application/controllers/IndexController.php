<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    	$sess = new Zend_Session_Namespace('City');
    	$this->cityId = $sess->id;
     	$this->cityNome = $sess->nome;
     	$this->view->cityNome = $this->cityNome;
     	$this->view->doctype('XHTML1_RDFA');
    }
    
    

    public function indexAction()
    {

    	$city = $this->_getParam('c');
    		if(empty($city))
    		{
    			if(empty($this->cityId))
    			{
    				return $this->_forward('index', 'localidade');
    			}else 
    			{
    				return $this->_forward('index', 'eventos');
    			}


    		}else{
    			$cidadesTable = new Application_Model_DbTable_LocalCidades();
    			$localidade = $cidadesTable->byId($city, new Application_Model_LocalCidades());
    			 
    			if($localidade)
    			{
    				$sess = new Zend_Session_Namespace('City');
    				$sess->id = $localidade->getId();
    				$sess->nome = $localidade->getNome();
    					
    				return $this->_forward('index', 'eventos');
    			}else 
    			{  // o ID da cidade passada por parametro não foi encontrado
    				return $this->_forward('index', 'localidade');
    			}
    		}
    		
    	
        // action body
//     	return $this->_forward('index', 'eventos');  //carrega o conteudo do controller EVENTOS, na action INDEX
    	//$this->_helper->redirector->goToRoute( array('controller' => 'eventos', 'action'=> 'index'));  // faz o mesmo que o de cima, mas neste caso redireciona

    }


}

