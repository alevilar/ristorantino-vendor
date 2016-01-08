<?php
App::uses('ComprasAppModel', 'Compras.Model');
/**
 * Pedido Model
 *
 * @property ComprasPedidoMercaderia $ComprasPedidoMercaderia
 * @property PedidoMercaderia $PedidoMercaderia
 */
class Pedido extends ComprasAppModel {



	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $order = array('Pedido.created'=>'DESC');

	
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(		
		'PedidoMercaderia' => array(
			'className' => 'Compras.PedidoMercaderia',
			'foreignKey' => 'pedido_id',
			'dependent' => true,
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
		'User' => array(
			'className' => 'Users.User',
			'foreignKey' => 'created_by',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		);


	public function beforeSave($options = array()) {
		if ( empty($this->data['Pedido']['id']) ) {
			$this->data['Pedido']['created_by'] = CakeSession::read('Auth.User.id');
		}
		return parent::beforeSave($options);
	}
}
