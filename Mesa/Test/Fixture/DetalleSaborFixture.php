<?php

class DetalleSaborFixture extends CakeTestFixture {

      // Optional.
      // Set this property to load fixtures to a different test datasource
      public $useDbConfig = 'test';


  	public $fields = array(
      	'id' 	  	=>   array('type' => 'integer', 'key' => 'primary'),
      	'detalle_comanda_id' 	=> 'integer',
      	'sabor_id' 	=> 'integer',
  	);


 }