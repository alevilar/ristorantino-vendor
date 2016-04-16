<?php 
App::uses('TenantBaseSchema', 'Risto.Model');


class RestaurantTenantSchema extends TenantBaseSchema {

	public $__extraDefaultValues = array(			
			'mozos' => array(
				array(
					'numero' => "Mozo 1",
					'nombre' => "Ej: Mozo 1",
					'apellido' => "Lopez",
					'activo' => true,
				),
				array(
					'numero' => "Mozo 2",
					'nombre' => "Ej: Mozo 2",
					'apellido' => "Gomez",
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
				array(
					'parent_id' 	=> 1,
					'lft' 			=> 2,
					'rght' 			=> 3,
					'name' 			=> 'Guarnición',
					'description' 	=> '',
					'media_id' 		=> null,
				),
				array(
					'parent_id' 	=> 1,
					'lft' 			=> 4,
					'rght' 			=> 5,
					'name' 			=> 'Bebidas',
					'description' 	=> '',
					'media_id' 		=> null,
				),
				array(
					'parent_id' 	=> 1,
					'lft' 			=> 6,
					'rght' 			=> 7,
					'name' 			=> 'Hamburguesas',
					'description' 	=> '',
					'media_id' 		=> null,
				),
			),
			'comanda_estados' => array(				
				array(
					'id' => 3,
					'name' => 'Marchando',
					'class_color' => 'txt-warning bg-warning',
					'printer_id' => 2,
					'before_comanda_estado_id' => COMANDA_ESTADO_PENDIENTE,
					'after_comanda_estado_id' => 4,
					),
				array(
					'id' => 4,
					'name' => 'Saliendo',
					'class_color' => 'txt-success bg-success',
					'printer_id' => 2,
					'before_comanda_estado_id' => 3,
					'after_comanda_estado_id' => COMANDA_ESTADO_LISTO,
					),			
				),
			'printers' => array(
				array(
					'id' => 2,
					'name'  => 'cocina',
					'alias' =>  'cocina',
					'driver' => 'Receipt',
					'driver_model' => 'Display',
					),
				array(
					'id' => 3,
					'name'  => 'barra',
					'alias' =>  'barra',
					'driver' => 'Receipt',
					'driver_model' => 'Display',
					),
			),
			'productos' => array(
				array(
					'name' => 'Paella',
					'abrev' => 'paella',
					'categoria_id' => 1,
					'precio' => 100,
					'printer_id' => 2,
				),
				array(
					'name' => 'Puré',
					'abrev' => 'papa',
					'categoria_id' => 2,
					'precio' => 12,
					'printer_id' => 2,
				),
				array(
					'name' => 'Papas Fritas',
					'abrev' => 'papa',
					'categoria_id' => 2,
					'precio' => 33,
					'printer_id' => 2,
				),
				array(
					'name' => 'Papa al Natural',
					'abrev' => 'papa',
					'categoria_id' => 2,
					'precio' => 30,
					'printer_id' => 2,
				),
				array(
					'name' => 'Pepsi',
					'abrev' => 'gaseosa',
					'categoria_id' => 3,
					'precio' => 25,
					'printer_id' => null,
				),
				array(
					'name' => 'Big Hamburg',
					'abrev' => 'hamburguesa',
					'categoria_id' => 4,
					'precio' => 98,
					'printer_id' => 2,
				),
				array(
					'name' => 'Super de Pollo',
					'abrev' => 'hamburguesa',
					'categoria_id' => 4,
					'precio' => 77,
					'printer_id' => 2,
				),
			),
			'sabores' => array(
				array(
					'name' => 'Queso',
					'categoria_id' => 4,
					'precio' => 10,
				),
				array(
					'name' => 'Tomate',
					'categoria_id' => 4,
					'precio' => 5,
				),
				array(
					'name' => 'Lechuga',
					'categoria_id' => 4,
					'precio' => 6,
				),
				array(
					'name' => 'Huevo',
					'categoria_id' => 4,
					'precio' => 2,
				),
				array(
					'name' => 'Sola',
					'categoria_id' => 4,
					'precio' => 0,
				),																							
			),
		);
}

