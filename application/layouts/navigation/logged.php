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
				'label' 		=> 	'Minha Conta',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'usuario',
				'action'		=> 	'index',
				'title'			=>	'Minha Conta',
	        ),
			array(
				'label' 		=> 	'Sair',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'usuario',
				'action'		=> 	'sair',
				'title'			=>	'Logout',
	        ),
 
    );
 
return $pages;
?>