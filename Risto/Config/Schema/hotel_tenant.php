<?php 
App::uses('TenantBaseSchema', 'Risto.Model');


class HotelTenantSchema extends TenantBaseSchema {
	public $__extraDefaultValues = array(						
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
					'id' => 3,
					'name'  => 'comandera',
					'alias' =>  'comandera',
					'driver' => 'Receipt',
					'driver_model' => 'Display',
					),
			),
			'roles' => array(
					array(
						'id' => ROL_ID_MOZO,
						'name' => 'Maestranza',
						'machin_name' => 'mozo',
						),
					array(
						'id' => ROL_ID_CAJERO,
						'name' => 'Recepcionista',
						'machin_name' => 'adicionista',
						),
					array(
						'id' => ROL_ID_ENCARGADO,
						'name' => 'Administrador',
						'machin_name' => 'administrador',
						),
			),
			'compras_unidad_de_medidas' => array(
					array(
						'id' => 1,
						'name' => "Planta" ) ,
					array( 
						'id' => 2,
						'name' => "Penca" ) ,
					array(
					    'id' => 3, 
						'name' => "Kilo" ) ,
					array( 
						'id' => 4,
						'name' => "Bolsa" ) ,
					array( 
						'id' => 5,
						'name' => "Unidad" ) ,
					array( 
						'id' => 6,
						'name' => "Atado" ) ,
					array( 
						'id' => 7,
						'name' => "Cajon" ) ,
					array( 
						'id' => 8,
						'name' => "Caja" ) ,
					array( 
						'id' => 9,
						'name' => "Lata" ) ,
					array( 
						'id' => 10,
						'name' => "Bidon" ) ,
					array( 
						'id' => 11,
						'name' => "Pack" ) ,
					array( 
						'id' => 12,
						'name' => "Botella" ) ,
					array( 
						'id' => 13,
						'name' => "Pilon" ) ,
					array( 
						'id' => 14,
						'name' => "Barra" ) ,
					array( 
						'id' => 15,
						'name' => "Horma" ) ,
					array( 
						'id' => 16,
						'name' => "Gancho" ) ,
					array( 
						'id' => 17,
						'name' => "Frasco" ) ,
					array( 
						'id' => 18,
						'name' => "Porcion" ) ,
					array( 
						'id' => 19,
						'name' => "Plancha" ) ,

			),
			'compras_rubros' => array(
					array(
						'id' => 1,
						'name' => "Almacén" ) ,
					array( 
						'id' => 2,
						'name' => "Bebidas" ) ,
					array(
					    'id' => 3, 
						'name' => "Carnicería" ) ,
					array( 
						'id' => 4,
						'name' => "Granja" ) ,
					array( 
						'id' => 5,
						'name' => "Heladería" ) ,
					array( 
						'id' => 6,
						'name' => "Mantenimiento" ) ,
					array( 
						'id' => 7,
						'name' => "Lácteos" ) ,
					array( 
						'id' => 8,
						'name' => "Librería" ) ,
					array( 
						'id' => 9,
						'name' => "Limpieza" ) ,
					array( 
						'id' => 10,
						'name' => "Otros" ) ,
					array( 
						'id' => 11,
						'name' => "Panadería" ) ,
					array( 
						'id' => 12,
						'name' => "Papelera" ) ,
					array( 
						'id' => 13,
						'name' => "Pescadería" ) ,
					array( 
						'id' => 14,
						'name' => "Verdulería" ) ,
					array( 
						'id' => 15,
						'name' => "Viáticos" ) ,
					array( 
						'id' => 16,
						'name' => "Vinos" ) ,
			),
			
		);
}