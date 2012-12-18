<?php
 
$pages = array(
			array(
				'label' 		=> 	'Início',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'index',
				'action'		=> 	'index',
				'class'			=>	'home',
				'title'			=>	'Início',
	        ),
			array(
				'label' 		=> 	'Eventos',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'eventos',
				'action'		=> 	'index',
				'title'			=>	'Eventos',
	        ),
			array(
				'label' 		=> 	'Cadastrar',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'users',
				'action'		=> 	'create',
				'class'			=>	'menu_top',
				'title'			=>	'Cadastrar',
	        ),
			array(
				'label' 		=> 	'Login',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'users',
				'action'		=> 	'login',
				'class'			=>	'menu_top',
				'title'			=>	'Login',
	        ),
 
    );
 
return $pages;
?>