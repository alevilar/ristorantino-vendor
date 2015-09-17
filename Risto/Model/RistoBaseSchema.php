<?php

App::uses('CakeSchema', 'Model');

/**
 * Risto Schema management.
 *
 * @package       Cake.Model
 */
class RistoBaseSchema extends CakeSchema {

	/**
	*
	*	Listado de valores por defecto
	*	debe indicar el nombre de la tabla "Ej: users, personas, roles"
	*	y debe contener un arrar de registros
	*
	**/
	public $__defaultValues = array();


	public function before($event = array()) {
		return true;
	}

	/**
	*
	*	Devuelve el Model de la tabla pasada como parametro y la connection seleccionada
	*
	**/
	public function __getModel ( $modelNameEvent, $connection ) {
		App::uses('ClassRegistry', 'Utility');
        $modelName = Inflector::classify( $modelNameEvent );
        
        $clasToLoad = array(
        	'class'=> $modelName,
        	'table' => $modelNameEvent, 
        	'ds' => $connection, 
        	//'alias' => $modelName
        	);
        return ClassRegistry::init( $clasToLoad );
	}


	public function after($event = array()) {
		if (isset($event['create'])) {
	    	$db = ConnectionManager::getDataSource($this->connection);
	    	$db->cacheSources = false;

	        $modelNameEvent = $event['create'];
	        $insertValues = $this->__getDefaultValues( $modelNameEvent);

            
	        if ( $insertValues ) {
	        	$model = $this->__getModel( $modelNameEvent, $this->connection);
	            
	            if ( $model ) {
	            	$model->saveAll( $insertValues );
	            }    
	        }            
	    }
	}



	/***
	*
	*	Devuelve los valores al ejecutar "SCHEMA CREATE"
	*
	*	@param string $tablename Nombre de la tabla
	*	@return array listado de valores a insertar en la tabla para hacer el saveAll
	**/
	private function __getDefaultValues ( $tableName ) {
		$values = $this->__defaultValues;

		if ( $values && $tableName && array_key_exists( $tableName, $values )) {
			return $values[$tableName];
		} else {
			return false;
		}
	}
}