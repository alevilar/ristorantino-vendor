<?php 
App::uses('TenantBaseSchema', 'Risto.Model');


class RestaurantTenantSchema extends TenantBaseSchema {

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
			'roles' => array(
					array(
						'id' => ROL_ID_MOZO,
						'name' => 'Mozo',
						'machin_name' => 'mozo',
						),
					array(
						'id' => ROL_ID_CAJERO,
						'name' => 'Cajero',
						'machin_name' => 'adicionista',
						),
					array(
						'id' => ROL_ID_ENCARGADO,
						'name' => 'Encargado',
						'machin_name' => 'administrador',
						),
					array(
						'id' => ROL_ID_COCINERO,
						'name' => 'Cocinero',
						'machin_name' => 'mozo',
						),
			),
		);
}

