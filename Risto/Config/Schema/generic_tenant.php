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
			array(
				'parent_id' 	=> 1,
				'lft' 			=> 2,
				'rght' 			=> 3,
				'name' 			=> 'Lácteos',
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
				'name' 			=> 'Sanguches',
				'description' 	=> '',
				'media_id' 		=> null,
			),
		),
		'productos' => array(
			array(
				'name' => 'producto 1',
				'abrev' => 'prod',
				'categoria_id' => 1,
				'precio' => 10,
				'printer_id' => 2,
			),
			array(
				'name' => 'Queso Port Salut',
				'abrev' => 'queso',
				'categoria_id' => 2,
				'precio' => 12,
				'printer_id' => 2,
			),
			array(
				'name' => 'Leche',
				'abrev' => 'leche',
				'categoria_id' => 2,
				'precio' => 33,
				'printer_id' => 2,
			),
			array(
				'name' => 'Queso Sancor',
				'abrev' => 'queso',
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