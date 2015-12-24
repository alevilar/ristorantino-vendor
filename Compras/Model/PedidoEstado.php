<?php
App::uses('ComprasAppModel', 'Compras.Model');
/**
 * PedidoEstado Model
 *
 * @property ComprasPedidoMercaderia $ComprasPedidoMercaderia
 * @property PedidoMercaderia $PedidoMercaderia
 */
class PedidoEstado extends ComprasAppModel {


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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PedidoMercaderia' => array(
			'className' => 'PedidoMercaderia',
			'foreignKey' => 'pedido_estado_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
