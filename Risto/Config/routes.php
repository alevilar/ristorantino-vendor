<?php
	Router::parseExtensions('json', 'xls');

	Router::mapResources('Printers.PrinterJobs');


/**
*		Paginas del CORE o App Global (no tenant)
*/
	Router::connect('/', array('plugin'=>'risto','controller' => 'pages', 'action' => 'display', 'home'));	
	Router::connect('/login', array('plugin'=>'users','controller' => 'users', 'action' => 'login'));	
	Router::connect('/bye', array('plugin'=>'users','controller' => 'users', 'action' => 'logout'));
	Router::connect('/pages/tos', array('plugin'=>'risto','controller' => 'pages', 'action' => 'display', 'tos'));
	

	Router::connect('/register', array('plugin' => 'users', 'controller' => 'users', 'action' => 'register'));


	/* OUATH */
	Router::connect('/auth_login/*', array( 'plugin' => 'users', 'controller' => 'users', 'action' => 'auth_login'));
	Router::connect('/auth_callback/*', array( 'plugin' => 'users', 'controller' => 'users', 'action' => 'auth_callback'));




	// get tenants names from subfolders
	$tenantsFolders = glob ( TENANT_PATH . DS ."*", GLOB_ONLYDIR );
	$tenants = array();
	foreach ( $tenantsFolders as $tf ) {
		$tenants[] = basename( $tf );
	}
	$tenantRoutConfig = array(
			'tenant' => implode('|', $tenants),
			'persist' => array('tenant'),
		);
	unset( $tenantsFolders );
	unset( $tenants );




	Router::connect('/:tenant', array('plugin' => 'risto','controller' => 'pages', 'action' => 'display', 'dashboard'), $tenantRoutConfig);	
	Router::connect('/:tenant/pages/administracion', array('plugin' => 'risto', 'controller' => 'pages', 'action' => 'display', 'administracion'), $tenantRoutConfig);

/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/:tenant/pages/*', array('controller' => 'pages', 'action' => 'display'), $tenantRoutConfig);




	

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
		Router::connect('/:tenant/'. $rt['controller'] .'/:action', array('plugin'=>$rt['plugin'], 'controller' => $rt['controller']), $tenantRoutConfig);
		Router::connect('/:tenant/'. $rt['controller'] .'/:action/*', array('plugin'=>$rt['plugin'], 'controller' => $rt['controller']), $tenantRoutConfig);
		Router::connect('/:tenant/'.$rt['controller'], array('plugin'=>$rt['plugin'], 'action' => 'index', 'controller' => $rt['controller']), $tenantRoutConfig);
	}

	unset($myPlugins);

	







/**
 *  ---------------------------------------------------------------------------------------
 *
 *
 *			CAKEPHP Controller - Action ROUTES FOR TENANT
 */



$prefixes = Router::prefixes();

if ($plugins = CakePlugin::loaded()) {
	App::uses('PluginShortRoute', 'Routing/Route');
	foreach ($plugins as $key => $value) {
		$plugins[$key] = Inflector::underscore($value);
	}
	$pluginPattern = implode('|', $plugins);
	$match = array('plugin' => $pluginPattern, 'defaultRoute' => true);
	$shortParams = array('routeClass' => 'PluginShortRoute', 'plugin' => $pluginPattern, 'defaultRoute' => true);

	foreach ($prefixes as $prefix) {
		$params = array('prefix' => $prefix, $prefix => true);
		$indexParams = $params + array('action' => 'index');
		Router::connect("/{$prefix}/:tenant/:plugin", $indexParams, $shortParams + $tenantRoutConfig);
		Router::connect("/{$prefix}/:tenant/:plugin/:controller", $indexParams, $match + $tenantRoutConfig);
		Router::connect("/{$prefix}/:tenant/:plugin/:controller/:action/*", $params, $match + $tenantRoutConfig);
	}
	Router::connect('/:tenant/:plugin', array('action' => 'index'), $shortParams + $tenantRoutConfig);
	Router::connect('/:tenant/:plugin/:controller', array('action' => 'index'), $match + $tenantRoutConfig);
	Router::connect('/:tenant/:plugin/:controller/:action/*', array(), $match + $tenantRoutConfig);
}

foreach ($prefixes as $prefix) {
	$params = array('prefix' => $prefix, $prefix => true);
	$indexParams = $params + array('action' => 'index');
	Router::connect("/{$prefix}/:tenant/:controller", $indexParams, array('defaultRoute' => true) + $tenantRoutConfig);
	Router::connect("/{$prefix}/:tenant/:controller/:action/*", $params, array('defaultRoute' => true) + $tenantRoutConfig);
}
Router::connect('/:tenant/:controller', array('action' => 'index'), array('defaultRoute' => true) + $tenantRoutConfig);
Router::connect('/:tenant/:controller/:action/*', array(), array('defaultRoute' => true) + $tenantRoutConfig);

$namedConfig = Router::namedConfig();
if ($namedConfig['rules'] === false) {
	Router::connectNamed(true);
}

unset($namedConfig, $params, $indexParams, $prefix, $prefixes, $shortParams, $match,
	$pluginPattern, $plugins, $key, $value);

