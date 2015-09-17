<?php

class MozoFixture extends CakeTestFixture {

      // Optional.
      // Set this property to load fixtures to a different test datasource
      public $useDbConfig = 'test';



  	public $fields = array(
      	'id' 				=>   array('type' => 'integer', 'key' => 'primary'),
  		'numero' 			=>   array('type'=>'string', 'length' => 64, 'null' => false),
  		'nombre' 			=>   array('type'=>'string', 'length' => 64, 'null' => true, 'default' => 'NULL'),
  		'apellido' 			=>   'string',
  		'media_id' 			=>   'integer',
  		'deleted_date' 		=>   'datetime',
  		'deleted' 			=>   'integer',
  	);

  	 public $records = array(
          array(
          	'id' => 1,
          	'numero' => 1,
          	'nombre' => 'Diego Armando',
          	'apellido' => 'Maradona',
          	'media_id' => null,          	
          	)
          );


 }