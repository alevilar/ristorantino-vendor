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
			'className' => 'Compras.PedidoMercaderia',
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





    /**
	 * Called before every deletion operation.
	 *
	 * @param bool $cascade If true records that depend on this record will also be deleted
	 * @return bool True if the operation should continue, false if it should abort
	 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforedelete
	 */
	public function beforeDelete($cascade = true) {
		$idInborrables = array(
				COMPRAS_PEDIDO_ESTADO_PENDIENTE,
				COMPRAS_PEDIDO_ESTADO_COMPLETADO,
				COMPRAS_PEDIDO_ESTADO_PEDIDO,
			);
		if ( in_array($this->id, $idInborrables)) {
			return false;
		}

		return true;
	}
}
