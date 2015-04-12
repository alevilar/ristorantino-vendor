<?php

class EstadoFixture extends CakeTestFixture {

      // Optional.
      // Set this property to load fixtures to a different test datasource
      public $useDbConfig = 'test';



  	public $fields = array(
      	'id' 				=>   array('type' => 'integer', 'key' => 'primary'),
  		'name' 			=>   array('type'=>'string', 'length' => 64, 'null' => false),
  		'color' 			=>   array('type'=>'string', 'length' => 64, 'null' => true, 'default' => 'NULL'),
  	);

  	 public $records = array(
          array(
          	'id' => MESA_ABIERTA,
          	'name' => 'Abierta',
          	'color' => 'white',
          	),
          array(
          	'id' => MESA_CERRADA,
          	'name' => 'Cerrada',
          	'color' => 'red',
          	),
          array(
          	'id' => MESA_COBRADA,
          	'name' => 'Cobrada',
          	'color' => 'silver',
          	),
          );


 }