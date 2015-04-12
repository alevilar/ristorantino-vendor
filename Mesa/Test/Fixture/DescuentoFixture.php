
<?php

class DescuentoFixture extends CakeTestFixture {

      // Optional.
      // Set this property to load fixtures to a different test datasource
      public $useDbConfig = 'test';



  	public $fields = array(
      	'id' 				=>   array('type' => 'integer', 'key' => 'primary'),
  		'name' 			=>   array('type'=>'string', 'length' => 64, 'null' => false),
  		'description' 			=>   'text',
  		'porcentaje' => 'float',
  		'deleted_date' => 'timestamp',
  		'deleted' => 'integer',
  	);

  	 public $records = array(
          array(
          	'id' => 1,
          	'name' => 'invitacion',
          	'porcentaje' => 100,
          	'deleted' => 0,
          	),
          array(
          	'id' => 2,
          	'name' => '10% de descuento',
          	'porcentaje' => 10,
          	'deleted' => 0,
          	),
          );


 }