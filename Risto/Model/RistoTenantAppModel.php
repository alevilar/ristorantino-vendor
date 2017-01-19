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
App::uses('CakeSession', 'Model/Datasource');
App::uses('CakeRequest', 'Network');
App::uses('MtSites', 'MtSites.Utility');

/**
 * Class RistoAppModel
 *
 * @since         RistoAppModel
 */
class RistoTenantAppModel extends RistoAppModel {


	public $actsAs = array( 'Containable', 'Search.Searchable', 'Risto.Auditable');

/**
 * Sets up the configuration for the model, and loads databse from Multi Tenant Site
 *
 * @param Model $model Model using this behavior.
 * @param array $config Configuration options.
 * @return void
 */
	public function __construct($id = false, $table = null, $ds = null) {

		// conecto el modelo con el tenant
		$this->__buildTenant();

	
		// ahora construir el Model
		parent::__construct($id, $table, $ds);
		
	}


	/**
	*
	*	Conecta con el datasource del tenant 
	*
	**/
	private function __buildTenant () {		
		// usar tenant para este model
		MtSites::connectDatasourceWithCurrentTenant();
		$this->useDbConfig = MtSites::getTenantDataSourceName();	
	}

}
