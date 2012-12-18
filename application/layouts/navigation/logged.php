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
				'label' 		=> 	'Minha Conta',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'me',
				'action'		=> 	'index',
				'title'			=>	'Minha Conta',
	        ),
			array(
				'label' 		=> 	'Logout',
				'route'			=>	'default', //pq o navigation dava erro qdo estava num router
				'controller' 	=> 	'users',
				'action'		=> 	'logout',
				'class'			=>	'menu_top',
				'title'			=>	'Logout',
	        ),
 
    );
 
return $pages;
?>