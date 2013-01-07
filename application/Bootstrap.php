<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	
	
	
	


	/**
	 * cria o navigation, menu de navegação conforme os arquivos que contem os arrays() dos links
	 */
	protected function _initNavigation()
	{
		$nav_default = new Zend_Config(require(APPLICATION_PATH . '/layouts/navigation/default.php'));// read in the array menu
		$navigation_default = new Zend_Navigation($nav_default);
		Zend_Registry::set('default',$navigation_default);// initialize the navigation object with the array
	
		$nav_logged = new Zend_Config(require(APPLICATION_PATH . '/layouts/navigation/logged.php'));
		Zend_Registry::set('logged',new Zend_Navigation($nav_logged));
	}
	

	
	
	


	/**
	 * cria as rotas
	 * 
	 * Muda de:  /evento/index/id/3
	 * Para:   /evento/3/Sertanejo+Universitario
	 */
	protected function _initRoutes()
	{
		$frontcontroller = Zend_Controller_Front::getInstance();
		$router = $frontcontroller->getRouter('default');

		
		$router->addRoute(
				'evento',
				new Zend_Controller_Router_Route('evento/:id/:nome', array(
						'module' => 'default',
						'controller'	=>	'evento',
						'action'		=>	'index',
						'id'   			=>	':id',
						'nome'			=>	':nome'
				))
		);	
		
		$router->addRoute(
				'parceiro',
				new Zend_Controller_Router_Route('parceiro/:id/:nome', array(
						'module' => 'default',
						'controller'	=>	'parceiro',
						'action'		=>	'index',
						'id'   			=>	':id',
						'nome'			=>	':nome'
				))
		);
	}
	
	
	
	
	

}

