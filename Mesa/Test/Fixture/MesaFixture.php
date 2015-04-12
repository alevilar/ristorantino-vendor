<?php
/**
 * MesaFixture
 *
 */
class MesaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'numero' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'mozo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'subtotal' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'total' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'cliente_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10, 'unsigned' => true),
		'descuento_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'menu' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'cant_comensales' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false),
		'estado_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'observation' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'checkin' => array('type' => 'timestamp', 'null' => true, 'default' => null, 'key' => 'index'),
		'checkout' => array('type' => 'timestamp', 'null' => true, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'time_cerro' => array('type' => 'timestamp', 'null' => true, 'default' => null, 'key' => 'index'),
		'time_cobro' => array('type' => 'timestamp', 'null' => true, 'default' => null, 'key' => 'index'),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'time_cerro' => array('column' => array('time_cerro', 'time_cobro'), 'unique' => 0),
			'mozo_id' => array('column' => 'mozo_id', 'unique' => 0),
			'checkin' => array('column' => 'checkin', 'unique' => 0),
			'checkout' => array('column' => 'checkout', 'unique' => 0),
			'numero' => array('column' => 'numero', 'unique' => 0),
			'time_cobro' => array('column' => 'time_cobro', 'unique' => 0),
			'created' => array('column' => array('time_cerro', 'mozo_id'), 'unique' => 0)
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
			'numero' => 1,
			'mozo_id' => 1,
			'subtotal' => 10,
			'total' => 10,
			'cant_comensales' => 1,
			'estado_id' => MESA_COBRADA, // COBRADA
			'menu' => 0,
			'created' => '2007-03-18 10:39:23',
			'observation' => '',
			'modified' => '2007-03-18 10:39:23',
			'time_cerro' => '2007-03-18 10:39:23',
			'time_cobro' => '2007-03-18 10:39:23',
			'deleted' => 0,
          ),
          array(
            'id' => 2,
			'numero' => 2,
			'mozo_id' => 1,
			'subtotal' => 2213,
			'total' => 2213,
			'menu' => 0,
			'cant_comensales' => 4,
			'estado_id' => MESA_CERRADA, // CERRADA
			'observation' => 'una cosa de observacion',
			'created' => '2007-03-18 10:39:23',
			'modified' => '2007-03-18 10:39:23',
			'time_cerro' => '2007-03-18 10:39:23',
			'time_cobro' => '2007-03-18 10:39:23',
			'deleted' => 0,
          ),
          array(
            'id' => 3,
			'numero' => 3,
			'mozo_id' => 1,
			'subtotal' => 0,
			'total' => 0,
			'menu' => 0,
			'cant_comensales' => 4,
			'estado_id' => MESA_ABIERTA, // ABIERTA
			'observation' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2007-03-18 10:39:23',
			'modified' => '2007-03-18 10:39:23',
			'deleted' => 0,
          ),
		array(
			'id' => 4,
			'numero' => 'Lorem ipsum dolor sit amet',
			'mozo_id' => 1,
			'subtotal' => 1,
			'total' => 1,
			'cliente_id' => null,
			'descuento_id' => null,
			'menu' => 1,
			'cant_comensales' => 1,
			'estado_id' => 1,
			'observation' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'checkin' => 1428797601,
			'checkout' => 1428797601,
			'created' => '2015-04-11 21:13:21',
			'modified' => '2015-04-11 21:13:21',
			'time_cerro' => 1428797601,
			'time_cobro' => 1428797601,
			'deleted_date' => null,
			'deleted' => 0
		),
	);

}
