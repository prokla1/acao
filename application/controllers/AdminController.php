<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
		$admin = false;
    	
    	$auth = Zend_Auth::getInstance();
    	if($auth->hasIdentity())
    	{
    		$user = $auth->getIdentity();
    		$this->usuario = $user;
    		if($user->admin == '1')
    		{
    			$admin = true;
    		}
    	}
    	 
    	$this->admin = $admin;
    	
    	if(!$admin)
    	{
    		return $this->_forward('entrar', 'usuario');
    	}
    }

    public function indexAction()
    {
        // action body
    }


}

