<?php
App::uses('ComprasAppModel', 'Compras.Model');
/**
 * PedidoMercaderia Model
 *
 * @property Pedido $Pedido
 * @property PedidoEstado $PedidoEstado
 * @property MedidaUnidad $MedidaUnidad
 */
class PedidoMercaderia extends ComprasAppModel {


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'pedido_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'pedido_estado_id' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'medida_unidad_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cantidad' => array(
			'decimal' => array(
				'rule' => array('decimal'),
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
		'Pedido' => array(
			'className' => 'Pedido',
			'foreignKey' => 'pedido_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PedidoEstado' => array(
			'className' => 'PedidoEstado',
			'foreignKey' => 'pedido_estado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MedidaUnidad' => array(
			'className' => 'MedidaUnidad',
			'foreignKey' => 'medida_unidad_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
