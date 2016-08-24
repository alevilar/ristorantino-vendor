<?php
App::uses('ComprasAppModel', 'Compras.Model');
/**
 * Mercaderia Model
 *
 */
class Mercaderia extends ComprasAppModel {


	public $order = array('Mercaderia.name'=>'ASC');


	public $actsAs = array(
		'Search.Searchable',
	);



	public $filterArgs = array(
		
        'search' => array(
        	'field' => 'Mercaderia.name',
            'type' => 'like',
            ),
        );

	
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


	/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(		
		'PedidoMercaderia' => array(
			'className' => 'Compras.PedidoMercaderia',
			'foreignKey' => 'mercaderia_id',
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

	public $belongsTo = array(
		'Compras.UnidadDeMedida', 
		'Proveedor' => array(
			'className' => 'Account.Proveedor',
			'foreignKey' => 'default_proveedor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			),
		'Rubro' => array(
			'className' => 'Compras.Rubro',
			'foreignKey' => 'rubro_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			)

		);


}
