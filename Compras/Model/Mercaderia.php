<?php
App::uses('ComprasAppModel', 'Compras.Model');
/**
 * Mercaderia Model
 *
 */
class Mercaderia extends ComprasAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'schema_tenant';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);


	public $belongsTo = array('Compras.UnidadDeMedida');
}
