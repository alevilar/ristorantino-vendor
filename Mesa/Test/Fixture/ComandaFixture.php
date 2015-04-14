<?php

class ComandaFixture extends CakeTestFixture {

      // Optional.
      // Set this property to load fixtures to a different test datasource
      public $useDbConfig = 'test';




  	public $fields = array(
      	'id' 	  	=>   array('type' => 'integer', 'key' => 'primary'),
      	'mesa_id' 	=> 'integer',
      	'created' 	=> 'timestamp',
        'impresa'   => 'integer',
      	'observacion' => 'text',
  	);


  	 public $records = array(
          array(
          	'id' => 1,
          	'mesa_id' => 1,
          	'created' => 11212122,
          	'observacion' => '',
          	),  
          array(
            'id' => 2,
            'mesa_id' => 3,
            'created' => 11212122,
            'observacion' => '',
            ),         
          );

 }