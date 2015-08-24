<?php
App::uses('Mysql', 'Model/Datasource/Database');

/**
 * MySQL DBO driver object
 *
 * Provides connection and SQL generation for MySQL RDMS
 *
 * @package       Cake.Model.Datasource.Database
 */
class RistoMysqlExtended extends Mysql {


/**
 * MySQL column definition
 *
 * @var array
 */
	public $columns = array(
		'primary_key' => array('name' => 'NOT NULL AUTO_INCREMENT'),
		'string' => array('name' => 'varchar', 'limit' => '255'),
		'text' => array('name' => 'text'),
		'biginteger' => array('name' => 'bigint', 'limit' => '20'),
		'integer' => array('name' => 'int', 'limit' => '11', 'formatter' => 'intval'),
		'float' => array('name' => 'float', 'formatter' => 'floatval'),
		'decimal' => array('name' => 'decimal', 'formatter' => 'floatval'),
		'datetime' => array('name' => 'datetime', 'format' => 'Y-m-d H:i:s', 'formatter' => 'date'),
		'timestamp' => array('name' => 'timestamp', 'format' => 'Y-m-d H:i:s', 'formatter' => 'date'),
		'time' => array('name' => 'time', 'format' => 'H:i:s', 'formatter' => 'date'),
		'date' => array('name' => 'date', 'format' => 'Y-m-d', 'formatter' => 'date'),
		'binary' => array('name' => 'blob'),
		'longblob' => array('name' => 'longblob'),
		'boolean' => array('name' => 'tinyint', 'limit' => '1')
	);

}