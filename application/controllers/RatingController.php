<?php

class RatingController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$dados = array();
    	$rating = $this->_getParam('rating');
    	$id_parceiro = $this->_getParam('id');
    	
    	if($rating > 0 && $rating < 6){
    		
    		$ratingTable = new Application_Model_DbTable_Rating();
    		
    		if($ratingTable->jaVotou($_SERVER['REMOTE_ADDR'], $id_parceiro)){
    			$dados['status'] = "fail";
    			$dados['msg'] = "Você já votou neste parceiro hoje";
    		}else 
    		{
	    		$parceirosTable = new Application_Model_DbTable_Parceiros();
	    		$parceiro = $parceirosTable->rating($id_parceiro, $rating);
	    		 
	    		$dados['status'] = "sucess";
	    		$dados['rating'] = $parceiro->getRating();
    		}
    		 
    	}else{
    		$dados['status'] = "fail";
    		$dados['msg']	= "Valor do voto incorreto";
    	}
    	 
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	 
    	$this->_helper->json($dados);
    }


}

