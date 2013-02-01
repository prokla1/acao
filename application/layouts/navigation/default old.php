<?php
 
$pages = array(
			array(
				'label' 		=> 	'Cadastrar evento',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'eventos',
				'action'		=> 	'index',
				'title'			=>	'Quero cadastrar um evento',
				'class'         => 	'cadevents_link',
			),
			array(
				'label' 		=> 	'Eventos',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'eventos',
				'action'		=> 	'index',
				'title'			=>	'Quero encontrar eventos',
				'class'         => 	'events_link',
	        ),
			array(
				'label' 		=> 	'Cadastrar',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'usuario',
				'action'		=> 	'cadastrar',
				'title'			=>	'Quero me cadastrar',
				'class'			=>	'cad_link',
	        ),
			array(
				'label' 		=> 	'Entrar',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'usuario',
				'action'		=> 	'entrar',
				'title'			=>	'Quero fazer login',
				'id'			=>	'login_link',
				//'params'     => array('rel' => 'login'),
				'class'			=>	'login_link',
	        ),
	        
 
    );
 
return $pages;
?>