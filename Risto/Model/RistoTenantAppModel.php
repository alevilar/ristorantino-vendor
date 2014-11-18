<?php
/**
 * Debug Kit App Model
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         DebugKit 0.1
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 **/

App::uses('RistoAppModel', 'Risto.Model');

/**
 * Class RistoAppModel
 *
 * @since         RistoAppModel
 */
class RistoTenantAppModel extends RistoAppModel {


/**
 * Sets up the configuration for the model, and loads databse from Multi Tenant Site
 *
 * @param Model $model Model using this behavior.
 * @param array $config Configuration options.
 * @return void
 */
	public function __construct($id = false, $table = null, $ds = null) {

		// usar el correspondiente al tenant
		$currentTenant = CakeSession::read('MtSites.current');
		if ( !empty($currentTenant) ) {

			// listar sources actuales
			$sources = ConnectionManager::enumConnectionObjects();

			//copiar del default
			$tenantConf = $sources['default'];

			// colocar el nombre de la base de datos
			$tenantConf['database'] = $tenantConf['database'] ."_". $currentTenant;

			// crear la conexion con la bd
			$confName = 'tenant_'.$currentTenant;
			ConnectionManager::create( $confName, $tenantConf );

			// usar tenant para este model
			$this->useDbConfig = $confName;	

		}
		// ahora construir el Model
		parent::__construct($id, $table, $ds);
		
	}

}
