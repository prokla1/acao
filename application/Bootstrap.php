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

	 */
	protected function _initRoutes()
	{
		$frontcontroller = Zend_Controller_Front::getInstance();
		$router = $frontcontroller->getRouter('default');

	/*
 	* Muda de:  /evento/index/id/3
	* Para:   /evento/3/Sertanejo+Universitario
 	*/		/*
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
		*/
		$router->addRoute(
				'evento',
				new Zend_Controller_Router_Route('parceiro/:idP/:nomeP/evento/:idE/:nomeE', array(
						'module' => 'default',
						'controller'	=>	'parceiro',
						'action'		=>	'evento',
						'idP'   		=>	':idP',
						'nomeP'			=>	':nomeP',
						'idE'   		=>	':idE',
						'nomeE'			=>	':nomeE'
				))
		);
		$router->addRoute(
				'parceiro',
				new Zend_Controller_Router_Route('parceiro/:idP/:nomeP', array(
						'module' => 'default',
						'controller'	=>	'parceiro',
						'action'		=>	'index',
						'idP'   		=>	':idP',
						'nomeP'			=>	':nomeP'
				))
		);
		$router->addRoute(
				'agenda',
				new Zend_Controller_Router_Route('parceiro/:idP/:nomeP/agenda', array(
						'module' => 'default',
						'controller'	=>	'parceiro',
						'action'		=>	'agenda',
						'idP'   		=>	':idP',
						'nomeP'			=>	':nomeP'
				))
		);
		$router->addRoute(
				'fotos',
				new Zend_Controller_Router_Route('parceiro/:idP/:nomeP/fotos', array(
						'module' => 'default',
						'controller'	=>	'parceiro',
						'action'		=>	'fotos',
						'idP'   		=>	':idP',
						'nomeP'			=>	':nomeP'
				))
		);
		$router->addRoute(
				'localizacao',
				new Zend_Controller_Router_Route('parceiro/:idP/:nomeP/localizacao', array(
						'module' => 'default',
						'controller'	=>	'parceiro',
						'action'		=>	'localizacao',
						'idP'   		=>	':idP',
						'nomeP'			=>	':nomeP'
				))
		);
		$router->addRoute(
				'contato',
				new Zend_Controller_Router_Route('parceiro/:idP/:nomeP/contato', array(
						'module' => 'default',
						'controller'	=>	'parceiro',
						'action'		=>	'contato',
						'idP'   		=>	':idP',
						'nomeP'			=>	':nomeP'
				))
		);
		
		
		$router->addRoute(
				'rating',
				new Zend_Controller_Router_Route('rating/:rating/:id', array(
						'module' => 'default',
						'controller'	=>	'parceiro',
						'action'		=>	'rating',
						'rating'		=>	':rating',
						'id'   			=>	':id'
				))
		);	
		
		
		
		$router->addRoute(
				'localidade',
				new Zend_Controller_Router_Route('localidade/:id/:nome', array(
						'module' => 'default',
						'controller'	=>	'localidade',
						'action'		=>	'index',
						'id'   			=>	':id',
						'nome'			=>	':nome'
				))
		);
		
	}
	
	
	
	
	

}

