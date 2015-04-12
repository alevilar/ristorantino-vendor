<?php

class DetalleComandaFixture extends CakeTestFixture {

      // Optional.
      // Set this property to load fixtures to a different test datasource
      public $useDbConfig = 'test';


  	public $fields = array(
      	'id' 	  	=>   array('type' => 'integer', 'key' => 'primary'),
      	'producto_id' 	=> 'integer',
      	'comanda_id' 	=> 'integer',
      	'cant' => 'float',
      	'cant_eliminada' =>  array( 'type' => 'integer', 'default' => 0 ),
      	'es_entrada' => array( 'type' => 'integer', 'default' => 0 ),
      	'observacion' => 'text',
      	'created' 	=> 'timestamp',
      	'modified' 	=> 'timestamp',
  	);


     public $records = array(
          array(
            'id' => 1,
            'producto_id' => 1,
            'comanda_id' => 1,
            'cant' => 1,
            'cant_eliminada' => 0,
            'es_entrada' => 0,
            'observacion' => '',
            'created' => 1212121,
            'modified' => 12121212,
            ),         
          );

 }