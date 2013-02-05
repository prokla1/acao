<?php
 
$pages = array(
			array(
				'label' 		=> 	'Eventos',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'eventos',
				'action'		=> 	'index',
				'title'			=>	'Eventos',
				'class'         => 	'events',
			),
			array(
				'label' 		=> 	'Divulgue seu evento',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'site',
				'action'		=> 	'divulgar-evento',
				'title'			=>	'Divulgue seu evento',
				'class'         => 	'register',
	        ),
			array(
				'label' 		=> 	'Fique por dentro',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'usuario',
				'action'		=> 	'entrar',
				'title'			=>	'Quero fazer login',
				'class'			=>	'login',
	        ),
	        
 
    );
 
return $pages;
?>