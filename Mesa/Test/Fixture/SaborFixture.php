<?php
/**
 * SaborFixture
 *
 */
class SaborFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'categoria_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'grupo_sabor_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'precio' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'categoria_id' => 1,
			'grupo_sabor_id' => 1,
			'precio' => 1,
			'created' => 1428797753,
			'modified' => 1428797753,
			'deleted_date' => 1428797753,
			'deleted' => 1
		),
		array(
			'id' => 2,
			'name' => 'Lorem ipsum dolor sit amet',
			'categoria_id' => 2,
			'grupo_sabor_id' => 2,
			'precio' => 2,
			'created' => 1428797753,
			'modified' => 1428797753,
			'deleted_date' => 1428797753,
			'deleted' => 2
		),
		array(
			'id' => 3,
			'name' => 'Lorem ipsum dolor sit amet',
			'categoria_id' => 3,
			'grupo_sabor_id' => 3,
			'precio' => 3,
			'created' => 1428797753,
			'modified' => 1428797753,
			'deleted_date' => 1428797753,
			'deleted' => 3
		),
		array(
			'id' => 4,
			'name' => 'Lorem ipsum dolor sit amet',
			'categoria_id' => 4,
			'grupo_sabor_id' => 4,
			'precio' => 4,
			'created' => 1428797753,
			'modified' => 1428797753,
			'deleted_date' => 1428797753,
			'deleted' => 4
		),
		array(
			'id' => 5,
			'name' => 'Lorem ipsum dolor sit amet',
			'categoria_id' => 5,
			'grupo_sabor_id' => 5,
			'precio' => 5,
			'created' => 1428797753,
			'modified' => 1428797753,
			'deleted_date' => 1428797753,
			'deleted' => 5
		),
		array(
			'id' => 6,
			'name' => 'Lorem ipsum dolor sit amet',
			'categoria_id' => 6,
			'grupo_sabor_id' => 6,
			'precio' => 6,
			'created' => 1428797753,
			'modified' => 1428797753,
			'deleted_date' => 1428797753,
			'deleted' => 6
		),
		array(
			'id' => 7,
			'name' => 'Lorem ipsum dolor sit amet',
			'categoria_id' => 7,
			'grupo_sabor_id' => 7,
			'precio' => 7,
			'created' => 1428797753,
			'modified' => 1428797753,
			'deleted_date' => 1428797753,
			'deleted' => 7
		),
		array(
			'id' => 8,
			'name' => 'Lorem ipsum dolor sit amet',
			'categoria_id' => 8,
			'grupo_sabor_id' => 8,
			'precio' => 8,
			'created' => 1428797753,
			'modified' => 1428797753,
			'deleted_date' => 1428797753,
			'deleted' => 8
		),
		array(
			'id' => 9,
			'name' => 'Lorem ipsum dolor sit amet',
			'categoria_id' => 9,
			'grupo_sabor_id' => 9,
			'precio' => 9,
			'created' => 1428797753,
			'modified' => 1428797753,
			'deleted_date' => 1428797753,
			'deleted' => 9
		),
		array(
			'id' => 10,
			'name' => 'Lorem ipsum dolor sit amet',
			'categoria_id' => 10,
			'grupo_sabor_id' => 10,
			'precio' => 10,
			'created' => 1428797753,
			'modified' => 1428797753,
			'deleted_date' => 1428797753,
			'deleted' => 10
		),
	);

}
