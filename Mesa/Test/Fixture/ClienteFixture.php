
<?php

class ClienteFixture extends CakeTestFixture {

      // Optional.
      // Set this property to load fixtures to a different test datasource
      public $useDbConfig = 'test';


  	public $fields = array(
      	'id' 				=>   array('type' => 'integer', 'key' => 'primary'),
  		'codigo' 			=>   array('type'=>'string', 'length' => 64),
  		'mail' 			=>   array('type'=>'string', 'length' => 64),
  		'telefono' 			=>   array('type'=>'string', 'length' => 64),
  		'descuento_id' => 'integer',
  		'nombre' 			=>   array('type'=>'string', 'length' => 64),
  		'nrodocumento' 			=>   array('type'=>'string', 'length' => 64),
  		'tipo_documento_id' => 'integer',
  		'domicilio' 			=>   array('type'=>'string', 'length' => 500),
  		'iva_responsabilidad_id' => 'integer',
  		'fecha' => 'date',
  		'observacion' => 'text',

  	);

  	 public $records = array(
          array(
          	'id'	=> 1,
	  		'codigo'	=> '1002',
	  		'nombre'	=> 'Google',
	  		'nrodocumento'	=> '33709585229',
	  		'tipo_documento_id'	=>TIPO_DOCUMENTO_CUIT ,
	  		'domicilio'	=> 'una calle me separa',
	  		'iva_responsabilidad_id'	=>  IVA_RESPONSABILIDAD_RESPONSABLE_INSCRIPTO,
          	),
          );


 }
