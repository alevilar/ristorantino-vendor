
<?php

class ProductoFixture extends CakeTestFixture {

      // Optional.
      // Set this property to load fixtures to a different test datasource
      public $useDbConfig = 'test';




  	public $fields = array(
  		  'id' => array('type' => 'integer', 'key' => 'primary'),
	      'name' => array('type' => 'string', 'length' => 20, 'null' => false ),
	      'abrev'  => array('type' => 'string', 'length' => 20, 'null' => false ) ,
		  'description'  => array('type' => 'text', 'length' => 20, 'null' => false ),
		  'categoria_id'  => array('type' => 'integer', 'length' => 20, 'null' => false ),
		  'precio'  => array('type' => 'float', 'length' => 20, 'null' => false ),
		  'printer_id' => 'integer',
		  'order' => array('type' => 'integer', 'default' => 0),
	      'created' => 'timestamp',
	      'modified' => 'timestamp',
	      'deleted_date' => 'timestamp',
	      'deleted' => 'integer',
  	);

  	 public $records = array(
          array(
          	  'id' => 1,
		      'name' => 'Producto Prueba',
		      'abrev'  => 'prueba producto',
			  'description'  => 'producto que es de prueba',
			  'categoria_id'  => 1,
			  'precio'  => 100,
			  'printer_id' => 2, // comandera segun PrinterFixture
			  'order' => 1,
		      'created' => '2011-11-11 11:11:11',
		      'modified' => '2011-11-11 11:11:11',
		      'deleted_date' => null,
		      'deleted' => 0,
          	),
          );


 }