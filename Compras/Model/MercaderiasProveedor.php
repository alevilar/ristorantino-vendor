<?php
App::uses('ComprasAppModel', 'Compras.Model');
/**
 * MercaderiasProveedor Model
 *
 * @property Mercaderia $Mercaderia
 * @property Proveedor $Proveedor
 */
class MercaderiasProveedor extends ComprasAppModel {


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'mercaderia_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'proveedor_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Mercaderia' => array(
			'className' => 'Mercaderia',
			'foreignKey' => 'mercaderia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Proveedor' => array(
			'className' => 'Proveedor',
			'foreignKey' => 'proveedor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
