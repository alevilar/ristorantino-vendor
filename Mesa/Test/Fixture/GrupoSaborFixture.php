<?php
/**
 * GrupoSaborFixture
 *
 */
class GrupoSaborFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'seleccion_de_sabor_obligatorio' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'tipo_de_seleccion' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
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
			'seleccion_de_sabor_obligatorio' => 1,
			'tipo_de_seleccion' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => 1428795112,
			'modified' => 1428795112
		),
		array(
			'id' => 2,
			'seleccion_de_sabor_obligatorio' => 1,
			'tipo_de_seleccion' => 2,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => 1428795112,
			'modified' => 1428795112
		),
		array(
			'id' => 3,
			'seleccion_de_sabor_obligatorio' => 1,
			'tipo_de_seleccion' => 3,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => 1428795112,
			'modified' => 1428795112
		),
		array(
			'id' => 4,
			'seleccion_de_sabor_obligatorio' => 1,
			'tipo_de_seleccion' => 4,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => 1428795112,
			'modified' => 1428795112
		),
		array(
			'id' => 5,
			'seleccion_de_sabor_obligatorio' => 1,
			'tipo_de_seleccion' => 5,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => 1428795112,
			'modified' => 1428795112
		),
		array(
			'id' => 6,
			'seleccion_de_sabor_obligatorio' => 1,
			'tipo_de_seleccion' => 6,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => 1428795112,
			'modified' => 1428795112
		),
		array(
			'id' => 7,
			'seleccion_de_sabor_obligatorio' => 1,
			'tipo_de_seleccion' => 7,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => 1428795112,
			'modified' => 1428795112
		),
		array(
			'id' => 8,
			'seleccion_de_sabor_obligatorio' => 1,
			'tipo_de_seleccion' => 8,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => 1428795112,
			'modified' => 1428795112
		),
		array(
			'id' => 9,
			'seleccion_de_sabor_obligatorio' => 1,
			'tipo_de_seleccion' => 9,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => 1428795112,
			'modified' => 1428795112
		),
		array(
			'id' => 10,
			'seleccion_de_sabor_obligatorio' => 1,
			'tipo_de_seleccion' => 10,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => 1428795112,
			'modified' => 1428795112
		),
	);

}
