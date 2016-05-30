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
			
			
		);
}