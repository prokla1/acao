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
	
	
	

}

