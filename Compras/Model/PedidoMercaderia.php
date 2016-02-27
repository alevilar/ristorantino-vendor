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


	public $order = array('PedidoMercaderia.created'=>'DESC');


	public $actsAs = array( 'Containable', 'Search.Searchable');



	public $filterArgs = array(		
        'pedido_id' => array(
            'type' => 'value',    
            ),
        'mercaderia_id' => array(
            'type' => 'value',
            ),
        'pedido_estado_id' => array(
            'type' => 'value',
            ),
        'unidad_de_medida_id' => array(
            'type' => 'value',
            ),
        'proveedor_id' => array(
            'type' => 'value',
            'field' => 'Mercaderia.proveedor_id'
            ),
        'created_by' => array(
            'type' => 'value',
            'field' => 'Pedido.created_by'
            ),
        );

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
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
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
			'className' => 'Compras.Pedido',
			'foreignKey' => 'pedido_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Proveedor' => array(
			'className' => 'Account.Proveedor',
			'foreignKey' => 'proveedor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PedidoEstado' => array(
			'className' => 'Compras.PedidoEstado',
			'foreignKey' => 'pedido_estado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UnidadDeMedida' => array(
			'className' => 'Compras.UnidadDeMedida',
			'foreignKey' => 'unidad_de_medida_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Mercaderia' => array(
			'className' => 'Compras.Mercaderia',
			'foreignKey' => 'mercaderia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
