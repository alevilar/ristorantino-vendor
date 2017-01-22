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

    /**
     *     Me da los datos de la mercadería según su id, y tambien según su nombre.
     *
     *     @param $id = id de la mercadería para buscar el registro con ese id.
     *     @param $name = nombre de la mercadería para buscar todos los registros con ese nombre.
     */

	public function buscarMercaderia($id = null, $name = null) {
        if (!isset($id)) {
        $merca = $this->find('all', array(			
			'conditions' => array(
				'Mercaderia.name' => $name
				)
			)
          );

        } else {
        $merca = $this->find('all', array(			
			'conditions' => array(
				'Mercaderia.id' => $id
				)
			)
          );
        }

		return $merca;
	}

	/**
	 *   Borra todas las mercaderías duplicadas, y despues actualiza la tabla compras_pedidos_mercaderias 
	 *   con el id del producto que se unifico.
	 *
	 *   @param $id_mercaderia = id de la mercadería duplicada usada como condición para borrar.
	 *   @param $name = nombre de la mercadería duplicada usada como condición para borrar.
	 *   @param $id = id de la mercadería que tenia las duplicaciones para actualizar 
	 *          la tabla compras_pedidos_mercaderias
	 */

	public function unificarMercaderia($id_mercaderia, $name, $id) {

		if ($this->deleteall(array('Mercaderia.name' => $name, 'Mercaderia.id' => $id_mercaderia), false)) {
			return $this->PedidoMercaderia->updateAll(array('mercaderia_id' => $id));

		}

		return false;

	}


}
