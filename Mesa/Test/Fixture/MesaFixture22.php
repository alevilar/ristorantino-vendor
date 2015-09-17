<?php

class MesaFixture extends CakeTestFixture {

      // Optional.
      // Set this property to load fixtures to a different test datasource
      public $useDbConfig = 'test';


      public $fields = array(
      	'id' 				=>   array('type' => 'integer', 'key' => 'primary'),
  		'numero' 			=>   array('type'=>'string', 'length' => 64,'null' => false),
  		'mozo_id' 			=>   array('type'=>'integer', 'null' => false),
  		'subtotal' 			=>   array('type'=>'integer', 'null' => false, 'default' => 0),
  		'total' 			=>   array('type'=>'integer', 'null' => false, 'default' => 0),
  		'cliente_id' 		=>   array('type'=>'integer', 'null' => false, 'default' => 0),
  		'descuento_id' 		=>   'integer',
  		'menu' 				=>   'integer',
  		'cant_comensales' 	=>   array('type'=>'integer', 'default' => 0),
  		'estado_id' 		=>   array('type'=>'integer', 'default' => 0),
  		'observation' 		=>   'text',
  		'checkin' 			=>   'datetime',
  		'checkout' 			=>   'datetime',
  		'created' 			=>   'datetime',
  		'modified' 			=>   'datetime',
  		'time_cerro' 		=>   'datetime',
  		'time_cobro' 		=>   'datetime',
  		'deleted_date' 		=>   'datetime',
  		'deleted' 			=>   'integer',
  	);




      public $records = array(
          array(
            'id' => 1,
			'numero' => 1,
			'mozo_id' => 1,
			'subtotal' => 10,
			'total' => 10,
			'cant_comensales' => 1,
			'estado_id' => MESA_COBRADA, // COBRADA
			'created' => '2007-03-18 10:39:23',
			'modified' => '2007-03-18 10:39:23',
			'time_cerro' => '2007-03-18 10:39:23',
			'time_cobro' => '2007-03-18 10:39:23',
          ),
          array(
            'id' => 2,
			'numero' => 2,
			'mozo_id' => 1,
			'subtotal' => 2213,
			'total' => 2213,
			'cant_comensales' => 4,
			'estado_id' => MESA_CERRADA, // CERRADA
			'created' => '2007-03-18 10:39:23',
			'modified' => '2007-03-18 10:39:23',
			'time_cerro' => '2007-03-18 10:39:23',
			'time_cobro' => '2007-03-18 10:39:23',
          ),
          array(
            'id' => 3,
			'numero' => 3,
			'mozo_id' => 1,
			'subtotal' => 0,
			'total' => 0,
			'cant_comensales' => 4,
			'estado_id' => MESA_ABIERTA, // ABIERTA
			'created' => '2007-03-18 10:39:23',
			'modified' => '2007-03-18 10:39:23',
          ),
      );
 }