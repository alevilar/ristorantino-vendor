
<?php

class CategoriaFixture extends CakeTestFixture {

      // Optional.
      // Set this property to load fixtures to a different test datasource
      public $useDbConfig = 'test';


  	public $fields = array(
  		'id' => array('type' => 'integer', 'key' => 'primary'),
      'parent_id' => 'integer',
      'lft' => 'integer',
      'rght' => 'integer',
      'name' => array('type' => 'string', 'length' => 20, 'null' => false ),
      'description' => array('type' => 'text', 'length' => 20, 'null' => false ),
      'media_id' => 'integer',
      'created' => 'timestamp',
      'modified' => 'timestamp',
      'deleted_date' => 'timestamp',
      'deleted' => 'integer',
  	);

  	 public $records = array(
          array(
          	'id' => 1,
            'parent_id' => null,
            'lft' => null,
            'rght' => null,
            'name' => '/',
            'description' => 'Categoria principal ROOT',
            'media_id' => null,
            'created' => '2010-12-12 12:12:12',
            'modified' => '2010-12-12 12:12:12',
            'deleted_date' => null,
            'deleted' => 0,
          	),
          );


 }