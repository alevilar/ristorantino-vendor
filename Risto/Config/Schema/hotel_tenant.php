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
			
		);
}