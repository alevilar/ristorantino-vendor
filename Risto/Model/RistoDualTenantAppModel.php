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
 * Class RistoDualTenantAppModel
 * 
 * Es utilizada en las clases que las tablas se repiten tanto en el tenant como en el generico (default)
 * 
 * Por ejemplo la tabla de Roles, esta en el DS default como en cada tenant
 * dependiendo el conetexto, el modelo apuntará a una base de datos u otra
 *
 * @since         RistoAppModel
 */
class RistoDualTenantAppModel extends RistoAppModel {


	public $actsAs = array( 'Containable', 'Search.Searchable', 'Risto.Auditable');


	/**
	 * 
	 * 	Setteo de relaciones para cuando se trata de un Tenant
	 * 
	 * 
	 **/
	public $inTenantHasOne = array();
	public $inTenantHasMany = array();
	public $inTenantBelongsTo = array();
	public $inTenantHasAndBelongsToMany = array();



	/**
	 * 
	 * 	Setteo de relaciones para cuando se trata de un modelo Default
	 * 
	 * 
	 **/
	public $inDefaultHasOne = array();
	public $inDefaultHasMany = array();
	public $inDefaultBelongsTo = array();
	public $inDefaultHasAndBelongsToMany = array();



/**
 * Sets up the configuration for the model, and loads databse from Multi Tenant Site
 *
 * @param Model $model Model using this behavior.
 * @param array $config Configuration options.
 * @return void
 */
	public function __construct($id = false, $table = null, $ds = null) {

		// conecto el modelo con el tenant
		$tenant = "default";
		if ( MtSites::isTenant()) {
			if ( $tenantAlias = MtSites::getSiteName() ) {
				$tenant = $tenantAlias;

				if ( !empty( $this->inTenantHasOne ) ) {
					$this->hasOne = array_merge( $this->hasOne, $this->inTenantHasOne ); 
				}

				if ( !empty( $this->inTenantHasMany ) ) {
					$this->hasMany = array_merge( $this->hasMany, $this->inTenantHasMany ); 
				}

				if ( !empty( $this->inTenantBelongsTo ) ) {
					$this->belongsTo = array_merge( $this->belongsTo, $this->inTenantBelongsTo ); 
				}

				if ( !empty( $this->inTenantHasAndBelongsToMany ) ) {
					$this->hasAndBelongsToMany = array_merge( $this->hasOne, $this->inTenantHasAndBelongsToMany ); 
				}
			}
		} else {
			if ( !empty( $this->inDefaultHasOne ) ) {
					$this->hasOne = array_merge( $this->hasOne, $this->inDefaultHasOne ); 
				}

				if ( !empty( $this->inDefaultHasMany ) ) {
					$this->hasMany = array_merge( $this->hasMany, $this->inDefaultHasMany ); 
				}

				if ( !empty( $this->inDefaultBelongsTo ) ) {
					$this->belongsTo = array_merge( $this->belongsTo, $this->inDefaultBelongsTo ); 
				}

				if ( !empty( $this->inDefaultHasAndBelongsToMany ) ) {
					$this->hasAndBelongsToMany = array_merge( $this->hasOne, $this->inDefaultHasAndBelongsToMany ); 
				}
		}

		if ( MtSites::isTenant()) {
			if ( $tenantAlias = MtSites::getSiteName() ) {
				$this->__buildTenant( $tenant );
			}
		}

	
		// ahora construir el Model
		parent::__construct($id, $table, $ds);
		
	}



}
