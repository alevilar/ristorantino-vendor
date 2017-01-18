ç<?php 
App::uses('RistoBaseSchema', 'Risto.Model');



class TenantBaseSchema extends RistoBaseSchema {

	public $connection = 'risto_tenant';


	public $__defaultValues = array(
			'account_tipo_impuestos' => array(
				array(
					'name' => 'IVA 21%',
					'porcentaje' => 21,
					'tiene_neto' => 1,
					'tiene_impuesto' => 1,
					),
				array(
					'name' => 'IVA 10,5%',
					'porcentaje' => 10.50,
					'tiene_neto' => 1,
					'tiene_impuesto' => 1,
					),
				array(
					'name' => 'IVA 27%',
					'porcentaje' => 27,
					'tiene_neto' => 1,
					'tiene_impuesto' => 1,
					),
				array(
					'name' => 'Neto No Gravado',
					'porcentaje' => 0,
					'tiene_neto' => 1,
					'tiene_impuesto' => 0,
					),
				array(
					'name' => 'Conceptos Excluidos',
					'porcentaje' => 0,
					'tiene_neto' => 0,
					'tiene_impuesto' => 1,
					),
				array(
					'name' => 'I.G.',
					'porcentaje' => 0,
					'tiene_neto' => 0,
					'tiene_impuesto' => 1,
					),
				array(
					'name' => 'I.V.A.',
					'porcentaje' => 0,
					'tiene_neto' => 1,
					'tiene_impuesto' => 1,
					),
				array(
					'name' => 'I.B.',
					'porcentaje' => 0,
					'tiene_neto' => 0,
					'tiene_impuesto' => 1,
					),
				array(
					'name' => 'IIBB CAP FED',
					'porcentaje' => 0,
					'tiene_neto' => 1,
					'tiene_impuesto' => 1,
					),
			),
			'comanda_estados' => array(
				array(
					'id' => COMANDA_ESTADO_PENDIENTE,
					'name' => 'Pendiente',
					'class_color' => 'txt-danger bg-danger',
					'printer_id' => null,
					'before_comanda_estado_id' => null,
					'after_comanda_estado_id' => null,
					),				
				array(
					'id' => COMANDA_ESTADO_LISTO,
					'name' => 'Listo',
					'class_color' => 'txt-default bg-default',
					'printer_id' => null,
					'before_comanda_estado_id' => null,
					'after_comanda_estado_id' => null,
					),
				),	
			'clientes' => array(
				array(
					'nombre' => "[Example] Google Arg. SRL",
					'nrodocumento' => 33709585229,
					'tipo_documento_id' => 1, // CUIT
					'iva_responsabilidad_id' => 1, // Resp. Insc
					)
			),
			'printers' => array(
				array(
					'name'  => 'fiscal',
					'alias' =>  'fiscal',
					'driver' => 'Fiscal',
					'driver_model' => 'Hasar441',
					),
			),
			'compras_pedido_estados' => array(
					array(
						'id' => COMPRAS_PEDIDO_ESTADO_PENDIENTE,
						'name' => 'Pendiente',
					),
					array(
						'id' => COMPRAS_PEDIDO_ESTADO_COMPLETADO,
						'name' => 'Completado',
					),
					array(
						'id' => COMPRAS_PEDIDO_ESTADO_PEDIDO,
						'name' => 'Pedido',
					),
				),
			'iva_responsabilidades' => array(
				array(
					'codigo_fiscal' => 'I',
					'name' => 'Resp. Inscripto',
					'tipo_factura_id' => RISTO_TIPO_FACTURA_A_ID, // fact "A"
					),
				array(
					'codigo_fiscal' => 'E',
					'name' => 'Exento',
					'tipo_factura_id' => RISTO_TIPO_FACTURA_B_ID, // fact "B"
					),
				array(
					'codigo_fiscal' => 'A',
					'name' => 'No Responsable',
					'tipo_factura_id' => RISTO_TIPO_FACTURA_B_ID, // fact "B"
					),
				array(
					'codigo_fiscal' => 'C',
					'name' => 'Consumidor Final',
					'tipo_factura_id' => RISTO_TIPO_FACTURA_B_ID, // fact "B"
					),
				array(
					'codigo_fiscal' => 'T',
					'name' => 'No Categorizado',
					'tipo_factura_id' => RISTO_TIPO_FACTURA_B_ID, // fact "B"
					),
				array(
					'codigo_fiscal' => 'M',
					'name' => 'Responsable Monotributo',
					'tipo_factura_id' => RISTO_TIPO_FACTURA_B_ID, // fact "B"
					),
			),			
			'observacion_comandas' => array(
				array('name' => "[Ejemplo] Observación para producto"),
				array('name' => "[Ejemplo] Otra observación de producto"),
			),
			'observaciones' => array(
				array('name' => "[Ejemplo] Observación de pedido general"),
				array('name' => "[Ejemplo] Observación de pedido 2"),
			),
			'tipo_documentos' => array(
				array('codigo_fiscal' => 'C', 'name' => 'CUIT'),
				array('codigo_fiscal' => 'L', 'name' => 'CUIL'),
				array('codigo_fiscal' => '0', 'name' => 'Libreta de Enrolamiento'),
				array('codigo_fiscal' => '1', 'name' => 'Libreta Cívica'),
				array('codigo_fiscal' => '2', 'name' => 'DNI'),
				array('codigo_fiscal' => '3', 'name' => 'Pasaporte'),
				array('codigo_fiscal' => '4', 'name' => 'Cédula de Identidad'),
				array('codigo_fiscal' => '' , 'name' => 'Sin identificar'),
			),
			'tipo_de_pagos' => array(
				array('name' => 'Efectivo', 'media_id' => 1 ),
				array('name' => 'Tarjeta Amex', 'media_id' => 2 ),
				array('name' => 'Tarjeta Visa', 'media_id' => 3 ),
				array('name' => 'Tarjeta Master Card', 'media_id' => 4 ),
				array('name' => 'Tarjeta Visa Debito', 'media_id' => 5 ),
				array('name' => 'Tarjeta Maestro', 'media_id' => 6 ),
			),
			'tipo_facturas' => array(
				array('id'=> RISTO_TIPO_FACTURA_A_ID, 'name' => '"A"'),
				array('id'=> RISTO_TIPO_FACTURA_B_ID, 'name' => '"B"'),
				array('id'=> RISTO_TIPO_FACTURA_X_ID, 'name' => '"X"'),
				array('id'=> RISTO_TIPO_FACTURA_M_ID, 'name' => '"M"'),
				array('id'=> RISTO_TIPO_FACTURA_C_ID, 'name' => '"C"'),
				array('id'=> RISTO_TIPO_FACTURA_VALE_ID, 'name' => 'Vale'),
				array('id'=> RISTO_TIPO_FACTURA_OTRO_ID, 'name' => 'Otros'),
				array('id'=> RISTO_TIPO_FACTURA_NCB_ID, 'name' => '"NCB"'), // nota de credito
				array('id'=> RISTO_TIPO_FACTURA_NCC_ID, 'name' => '"NCC"'), // nota de credito
				array('id'=> RISTO_TIPO_FACTURA_NCA_ID, 'name' => '"NCA"'), // nota de credito
				array('id'=> RISTO_TIPO_FACTURA_NDB_ID, 'name' => '"NDB"'), // nota de debito
				array('id'=> RISTO_TIPO_FACTURA_NDC_ID, 'name' => '"NDC"'), // nota de debito
				array('id'=> RISTO_TIPO_FACTURA_NDA_ID, 'name' => '"NDA"'), // nota de debito
			),
			'cash_cajas' => array(
				array('name' => 'Caja Ventas'),
			),			
			'estados' => array(
				array(
					'name' => 'Abierta',
					'color'=> 'btn-info',
				),
				array(
					'name' => 'Facturada',
					'color'=> 'btn-warning',
				),
				array(
					'name' => 'Cobrada',
					'color'=> 'btn-default',
				),
				array(
					'name' => 'Checkout',
					'color'=> 'btn-success',
				),
			),

			'media' => array(
				array(
					'id' => 1, 
					'model' => 'TipoDePago', 
					'type' => 'image/png', 
					'size' => 8978, 
					'name' => 'efectivo.png', 
					'file_name' => 'media_files/efectivo.png',
					),

				array(
					'id' => 2, 
					'model' => 'TipoDePago', 
					'type' => 'image/png', 
					'size' => 8472, 
					'name' => 'amex.png', 
					'file_name' => 'media_files/amex.png',
					),

				array(
					'id' => 3, 
					'model' => 'TipoDePago', 
					'type' => 'image/png', 
					'size' => 7973, 
					'name' => 'visa.png', 
					'file_name' => 'media_files/visa.png',
					),

				array(
					'id' => 4, 
					'model' => 'TipoDePago', 
					'type' => 'image/png', 
					'size' => 6981, 
					'name' => 'master.png', 
					'file_name' => 'media_files/master.png',
					),

				array(
					'id' => 5, 
					'model' => 'TipoDePago', 
					'type' => 'image/png', 
					'size' => 4691, 
					'name' => 'electron.png', 
					'file_name' => 'media_files/electron.png',
					),

				array(
					'id' => 6, 
					'model' => 'TipoDePago', 
					'type' => 'image/png', 
					'size' => 5624, 
					'name' => 'maestro.png', 
					'file_name' => 'media_files/maestro.png',
					),
				),
		);



	public $__extraDefaultValues = array();



	public function string2Hex($string){
	    $hex='';
	    for ($i=0; $i < strlen($string); $i++){
	        $hex .= dechex(ord($string[$i]));
	    }
	    return $hex;
	}

	public function after($event = array()) {
		parent::after( $event );


		if ( !empty($event['create']) ) {
			$modelNameEvent = $event['create'];

	        if ($modelNameEvent == 'media') {
				// insertar imagenes Media
				$insertValues = $this->__getDefaultValues( $modelNameEvent);
		        if ( $insertValues ) {
		        	$model = $this->__getModel( $modelNameEvent, $this->connection);
		            foreach($insertValues as &$iv) {
		            	// el include instancia la variable $valor
		            	$file = file_get_contents( App::pluginPath('Risto') . DS . "Config/Schema" . DS . $iv['file_name'] );
	        			$iv['file'] = $file;
	        			unset($valor);
	        		}
		            if ( $model ) {
		            	$model->saveAll( $insertValues );
		            }    
		        }

        	}

			
	        $insertValues = $this->__getExtraDefaultValues( $modelNameEvent);

	        
	        if ( $insertValues ) {
	        	$model = $this->__getModel( $modelNameEvent, $this->connection);
	        	
	            if ( $model ) {
	            	$model->saveAll( $insertValues );
	            }    

	        }  
		}
	}

	public $account_cierres = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 120, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),

		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $account_clasificaciones = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => false),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => false),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => false),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'parent_id' => array('column' => 'parent_id', 'unique' => 0),
			'lft' => array('column' => 'lft', 'unique' => 0),
			'rght' => array('column' => 'rght', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $account_egresos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'total' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'file' => array('type' => 'string', 'length' => 300 ,'null' => true, 'default' => null),
		'media_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'tipo_de_pago_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false),
		'fecha' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'media_id' => array('column' => 'media_id', 'unique' => 0),
			'tipo_de_pago_id' => array('column' => 'tipo_de_pago_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $account_egresos_gastos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'gasto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'egreso_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'importe' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'egreso_id' => array('column' => 'egreso_id', 'unique' => 0),
			'gasto_id' => array('column' => 'gasto_id', 'unique' => 0),
			'egreso_gasto' => array('column' => array('egreso_id','gasto_id'), 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $account_gastos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'cierre_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 4, 'unsigned' => false),
		'proveedor_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'clasificacion_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'tipo_factura_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'factura_nro' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'fecha' => array('type' => 'date', 'null' => false, 'default' => null),
		'importe_neto' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'importe_total' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'file' => array('type' => 'string', 'length' => 300 ,'null' => true, 'default' => null),
		'media_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'cierre_id' => array('column' => 'cierre_id', 'unique' => 0),
			'clasificacion_id' => array('column' => 'clasificacion_id', 'unique' => 0),
			'tipo_factura_id' => array('column' => 'tipo_factura_id', 'unique' => 0),
			'factura_nro' => array('column' => 'factura_nro', 'unique' => 0),
			'fecha' => array('column' => 'fecha', 'unique' => 0),
			'media_id' => array('column' => 'media_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $account_gastos_tipo_impuestos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'gasto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'tipo_impuesto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'importe' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'gasto_id' => array('column' => 'gasto_id', 'unique' => 0),
			'tipo_impuesto_id' => array('column' => 'tipo_impuesto_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'InnoDB')
	);

	public $account_impuestos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'gasto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'tipo_impuesto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'neto' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'importe' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'gasto_id' => array('column' => 'gasto_id', 'unique' => 0),
			'tipo_impuesto_id' => array('column' => 'tipo_impuesto_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $account_proveedores = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'cuit' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 12, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'mail' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'telefono' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'domicilio' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => false, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $account_tipo_impuestos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'porcentaje' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '6,2', 'unsigned' => false),
		'tiene_neto' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'tiene_impuesto' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);


	

	public $compras_proveedores_rubros = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'proveedor_id' => array('type' => 'integer', 'null' => false),
		'rubro_id' => array('type' => 'integer', 'null' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);	


	public $compras_pedido_estados = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);	




	public $compras_rubros = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);	

	

	public $compras_pedidos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'proveedor_id' => array('type' => 'integer', 'null' => true),
		'recepcionado' => array('type' => 'boolean', 'null' => false, 'default' => '0'),

		'observacionescion' => array('type' => 'text', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);


	public $compras_pedido_mercaderias = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'pedido_id' => array('type' => 'integer', 'null' => true),
		'mercaderia_id' => array('type' => 'integer', 'null' => false),
		'proveedor_id' => array('type' => 'integer', 'null' => true),
		'pedido_estado_id' => array('type' => 'integer', 'null' => false, 'default'=>1), // COMPRAS_PEDIDO_ESTADO_PENDIENTE
		'unidad_de_medida_id' => array('type' => 'integer', 'null' => false),
		'cantidad' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => null),
		'time_recibido' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'precio' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'pedido_id' => array('column' => 'pedido_id', 'unique' => 0),
			'mercaderia_id' => array('column' => 'mercaderia_id', 'unique' => 0),
			'pedido_estado_id' => array('column' => 'pedido_estado_id', 'unique' => 0),
			'unidad_de_medida_id' => array('column' => 'unidad_de_medida_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);	



	public $compras_mercaderias = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 120, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'unidad_de_medida_id' => array('type' => 'integer', 'null' => false),
		'default_proveedor_id' => array('type' => 'integer', 'null' => false),
		'rubro_id' => array('type' => 'integer', 'null' => true),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'unidad_de_medida_id' => array('column' => 'unidad_de_medida_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $compras_mercaderias_proveedores = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'mercaderia_id' => array('type' => 'integer', 'null' => false),
		'proveedor_id' => array('type' => 'integer', 'null' => true),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'mercaderia_id' => array('column' => 'mercaderia_id', 'unique' => 0),
			'proveedor_id' => array('column' => 'proveedor_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);



	public $compras_unidad_de_medidas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 120, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);


	public $afip_facturas = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mesa_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'punto_de_venta' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'comprobante_nro' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'cae' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'importe_total' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'importe_neto' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'importe_iva' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'json_data' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'mesa_id' => array('column' => 'mesa_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	public $cash_arqueos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'caja_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
		'importe_inicial' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'ingreso' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'egreso' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'otros_ingresos' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'otros_egresos' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'importe_final' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'saldo' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'datetime' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'caja_id' => array('column' => 'caja_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $cash_cajas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 124, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'integer', 'null' => true),
		'computa_ingresos' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'computa_egresos' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $cash_zetas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'arqueo_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'total_ventas' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'numero_comprobante' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'monto_iva' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'monto_neto' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'nota_credito_iva' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'nota_credito_neto' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'observacion_comprobante_tarjeta' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'arqueo_id' => array('column' => 'arqueo_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $categorias = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'media_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'parent' => array('column' => 'parent_id', 'unique' => 0),
			'lft' => array('column' => 'lft', 'unique' => 0),
			'rght' => array('column' => 'rght', 'unique' => 0),
			'media_id' => array('column' => 'media_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $clientes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'codigo' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'mail' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'telefono' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'descuento_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10, 'unsigned' => true),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'nrodocumento' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tipo_documento_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'domicilio' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'iva_responsabilidad_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'fecha' => array('type' => 'date', 'null' => true, 'default' => null),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'codigo' => array('column' => 'codigo', 'unique' => 0),
			'descuento_id' => array('column' => 'descuento_id', 'unique' => 0),
			'nrodocumento' => array('column' => 'nrodocumento', 'unique' => 0),
			'tipo_documento_id' => array('column' => 'tipo_documento_id', 'unique' => 0),
			'iva_responsabilidad_id' => array('column' => 'iva_responsabilidad_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);


	public $comanda_estados = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'printer_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'before_comanda_estado_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),

		'after_comanda_estado_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),

		'class_color' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'printer_id' => array('column' => 'printer_id', 'unique' => 0),
			'printer_before' => array('column' => array('printer_id','before_comanda_estado_id'), 'unique' => 0),
			'printer_after' => array('column' => array('printer_id','after_comanda_estado_id'), 'unique' => 0),
			'printer_before_after' => array('column' => array('printer_id','before_comanda_estado_id','after_comanda_estado_id'), 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $comandas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'mesa_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'printer_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'comanda_estado_id' => array('type' => 'integer', 'null' => false, 'default'=>COMANDA_ESTADO_PENDIENTE, 'unsigned' => false, 'key' => 'index'),
		'prioridad' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false),
		'impresa' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'mesa_id' => array('column' => 'mesa_id', 'unique' => 0),
			'comanda_estado_id' => array('column' => 'comanda_estado_id', 'unique' => 0),
			'printer_id' => array('column' => 'printer_id', 'unique' => 0),
			'comanda_estado_id_printer_id' => array('column' => array('printer_id', 'comanda_estado_id'), 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $comensales = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'cant_mayores' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false),
		'cant_menores' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false),
		'cant_bebes' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4, 'unsigned' => false),
		'mesa_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $config_categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $configs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'config_category_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
		'key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'value' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $descuentos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'porcentaje' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $detalle_comandas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'producto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'cant' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'cant_eliminada' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'comanda_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'es_entrada' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'mesa_id_2' => array('column' => 'comanda_id', 'unique' => 0),
			'producto_id' => array('column' => 'producto_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $detalle_sabores = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'detalle_comanda_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'sabor_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'detalle_comanda_id' => array('column' => 'detalle_comanda_id', 'unique' => 0),
			'sabor_id' => array('column' => 'sabor_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $estados = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'color' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 14, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $grupo_sabores = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'seleccion_de_sabor_obligatorio' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'tipo_de_seleccion' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $grupo_sabores_productos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'producto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'grupo_sabor_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'producto_id' => array('column' => 'producto_id', 'unique' => 0),
			'grupo_sabor_id' => array('column' => 'grupo_sabor_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $historico_precios = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'precio' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'producto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'producto_id' => array('column' => 'producto_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $impfiscales = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'path' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $inventory_categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 65, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $inventory_counts = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'count' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'product_id' => array('column' => 'product_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $inventory_products = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 65, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'category_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $iva_responsabilidades = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'codigo_fiscal' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tipo_factura_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'tipo_factura_id' => array('column' => 'tipo_factura_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $media = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'model' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 48, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'size' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6, 'unsigned' => false),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 48, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'file' => array('type' => 'longblob', 'null' => false, 'default' => null),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $mesas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'numero' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'mozo_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'subtotal' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'total' => array('type' => 'decimal', 'null' => true, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'cliente_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10, 'unsigned' => true),
		'descuento_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'menu' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false, 'comment' => 'es para cuando un cliente quiere imprimir el importe como MENU sin que se vea lo que consumio'),
		'cant_comensales' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false),
		'estado_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'observation' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'checkin' => array('type' => 'datetime', 'null' => true, 'default' => null, 'key' => 'index'),
		'checkout' => array('type' => 'datetime', 'null' => true, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'time_cerro' => array('type' => 'datetime', 'null' => true, 'default' => null, 'key' => 'index'),
		'time_cobro' => array('type' => 'datetime', 'null' => true, 'default' => null, 'key' => 'index'),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'estado_id' => array('column' => array('estado_id'), 'unique' => 0),
			'time_cerro' => array('column' => array('time_cerro', 'time_cobro'), 'unique' => 0),
			'mozo_id' => array('column' => 'mozo_id', 'unique' => 0),
			'checkin' => array('column' => 'checkin', 'unique' => 0),
			'checkout' => array('column' => 'checkout', 'unique' => 0),
			'numero' => array('column' => 'numero', 'unique' => 0),
			'time_cobro' => array('column' => 'time_cobro', 'unique' => 0),
			'created' => array('column' => array('time_cerro', 'mozo_id'), 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $mozos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'numero' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'apellido' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'media_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'activo' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'numero' => array('column' => 'numero', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $observacion_comandas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $observaciones = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $pagos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'mesa_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
		'tipo_de_pago_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'valor' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false, 'comment' => 'por ahora este campo vale cuando el tipo de pago es mixto, entonces se pone la cantidad de efectivo que pagó. Para poder hacer el arqueo.'),
		'user_id' => array('type' => 'integer', 'null' => true),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'mesa_id' => array('column' => 'mesa_id', 'unique' => 0),
			'tipo_de_pago_id' => array('column' => 'tipo_de_pago_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $pquery_categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $pquery_queries = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 78, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'query' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ver_online' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'expiration_time' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'columns' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $printers = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'alias' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 124, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'driver' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'driver_model' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'output' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $productos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 254, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'abrev' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 254, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'categoria_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
		'precio' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'printer_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'order' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false),
		'sin_stock' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'categoria_id' => array('column' => 'categoria_id', 'unique' => 0),
			'printer_id' => array('column' => 'printer_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $productos_precios_futuros = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'producto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'unique'),
		'precio' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'producto_id' => array('column' => 'producto_id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $productos_tags = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'producto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'tag_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'prod_tags' => array('column' => array('producto_id', 'tag_id'), 'unique' => 0),
			'prod_id' => array('column' => 'producto_id', 'unique' => 0),

		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $restaurantes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $roles = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'machin_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $roles_users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'rol_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'user_id' => array('column' => array('user_id', 'rol_id'), 'unique' => 0),
			'user_rol' => array('column' => array('user_id','rol_id'), 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $sabores = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'categoria_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'grupo_sabor_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'precio' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'unsigned' => false),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'categoria_id' => array('column' => 'categoria_id', 'unique' => 0),
			'grupo_sabor_id' => array('column' => 'grupo_sabor_id', 'unique' => 0),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $tags = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $generic_users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'pin' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128),
		'rol_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'pin' => array('column' => 'pin', 'unique' => 1),
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);


	public $tipo_de_pagos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 110, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'media_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),			
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $tipo_documentos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'codigo_fiscal' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	public $tipo_facturas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'codename' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'string', 'length' => 36, 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'name' => array('column' => 'name', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);



	


	/***
	*
	*	Devuelve los valores al ejecutar "SCHEMA CREATE"
	*
	*	@param string $tablename Nombre de la tabla
	*	@return array listado de valores a insertar en la tabla para hacer el saveAll
	**/
	private function __getExtraDefaultValues ( $tableName ) {
		$values = $this->__extraDefaultValues;

		if ( $values && $tableName && array_key_exists( $tableName, $values )) {
			return $values[$tableName];
		} else {
			return false;
		}
	}

}
