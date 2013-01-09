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
				'controller' 	=> 	'usuario',
				'action'		=> 	'cadastrar',
				'title'			=>	'Cadastrar',
	        ),
			array(
				'label' 		=> 	'Entrar',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'usuario',
				'action'		=> 	'entrar',
				'title'			=>	'Login',
	        ),
	        
 
    );
 
return $pages;
?>