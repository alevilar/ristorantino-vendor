<?php

class PagoFixture extends CakeTestFixture {

      // Optional.
      // Set this property to load fixtures to a different test datasource
      public $useDbConfig = 'test';



  	public $fields = array(
      	'id' 				=>   array('type' => 'integer', 'key' => 'primary'),
      	'mesa_id' => 'integer',
      	'tipo_de_pago_id' => 'integer',
      	'valor' => 'float',
      	'created' => 'timestamp'
  	);

  	 public $records = array(
          array(
          	'id'=> 1,
	      	'mesa_id' => 1,
	      	'tipo_de_pago_id' => 1,
	      	'valor' => 10,
          	),         
          );


 }