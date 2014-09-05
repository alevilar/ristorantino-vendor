<?php

	Router::parseExtensions('json', 'xls');

	Router::mapResources('Printers.PrinterJobs');


	if ( Configure::read('Site.isTenant') ) {
		Router::connect('/', array('plugin' => 'risto','controller' => 'pages', 'action' => 'display', 'dashboard'));	
	} else {
		//dashboard as homepage
		Router::connect('/', array('plugin' => 'risto','controller' => 'pages', 'action' => 'display', 'home'));
	}
	
	Router::connect('/dashboard', array('plugin' => 'risto','controller' => 'pages', 'action' => 'display', 'dashboard'));	
	Router::connect('/pages/administracion', array('plugin' => 'risto','controller' => 'pages', 'action' => 'display', 'administracion'));

/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));



	Router::connect('/users/login', array('plugin'=>'users','controller' => 'users', 'action' => 'login'));	
	Router::connect('/users/logout', array('plugin'=>'users','controller' => 'users', 'action' => 'logout'));

	

	// URL´s para la adicion
	// estos se suponen que son rutas temporales de migracion de Chocha012 a la Chocha014
	$myPlugins = array(		
		array('plugin' => 'fidelization', 'controller'=>'clientes'),
		array('plugin' => 'mesa', 'controller'=>'mesas'),
		array('plugin' => 'mesa', 'controller'=>'mozos'),
		array('plugin' => 'product', 'controller'=>'categorias'),
		array('plugin' => 'comanda', 'controller'=>'detalle_comandas'),
		array('plugin' => 'mesa', 'controller'=>'pagos'),
		
		);

	foreach ( $myPlugins as $rt) {		
		Router::connect('/'. $rt['controller'] .'/:action', array('plugin'=>$rt['plugin'], 'controller' => $rt['controller']));
		Router::connect('/'. $rt['controller'] .'/:action/*', array('plugin'=>$rt['plugin'], 'controller' => $rt['controller']));
		Router::connect('/'.$rt['controller'], array('plugin'=>$rt['plugin'], 'action' => 'index', 'controller' => $rt['controller']));
	}

	unset($myPlugins);

	


