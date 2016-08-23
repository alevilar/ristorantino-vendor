<?php 
App::uses('TenantBaseSchema', 'Risto.Model');


class GenericTenantSchema extends TenantBaseSchema {
	public $__extraDefaultValues = array(			
		'mozos' => array(
			array(
				'numero' => "Vendedor 1",
				'nombre' => "Ej: Jose",
				'apellido' => "Lopez",
				'activo' => true,
			),
		),
		'categorias' => array(
			array(
				'parent_id' 	=> null,
				'lft' 			=> 1,
				'rght' 			=> 8,
				'name' 			=> '/',
				'description' 	=> '',
				'media_id' 		=> null,
			),
		),
		'printers' => array(
				array(
					'id' => 2,
					'name'  => 'comandera',
					'alias' =>  'comandera',
					'driver' => 'Receipt',
					'driver_model' => 'Display',
					),
			),
		'roles' => array(
					array(
						'id' => ROL_ID_MOZO,
						'name' => 'Vendedor',
						'machin_name' => 'mozo',
						),
					array(
						'id' => ROL_ID_CAJERO,
						'name' => 'Cajero',
						'machin_name' => 'adicionista',
						),
					array(
						'id' => ROL_ID_ENCARGADO,
						'name' => 'Administrador',
						'machin_name' => 'administrador',
						),
			),

		'compras_unidad_de_medidas' => array(
					array( 'name' => "Planta" ) ,
					array( 'name' => "Penca" ) ,
					array( 'name' => "Kilo" ) ,
					array( 'name' => "Bolsa" ) ,
					array( 'name' => "Unidad" ) ,
					array( 'name' => "Atado" ) ,
					array( 'name' => "Cajon" ) ,
					array( 'name' => "Caja" ) ,
					array( 'name' => "Lata" ) ,
					array( 'name' => "Bidon" ) ,
					array( 'name' => "Pack" ) ,
					array( 'name' => "Botella" ) ,
					array( 'name' => "Pilon" ) ,
					array( 'name' => "Barra" ) ,
					array( 'name' => "Horma" ) ,
					array( 'name' => "Gancho" ) ,
					array( 'name' => "Frasco" ) ,
					array( 'name' => "Porcion" ) ,
					array( 'name' => "Plancha" ) ,

			),
	);
}