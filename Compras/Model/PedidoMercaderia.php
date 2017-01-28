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
            'field' => 'Pedido.proveedor_id'
            ),
        'created_by' => array(
            'type' => 'value',
            'field' => 'Pedido.created_by'
            ),
        'created_from' => array(
	            'type' => 'value',
	            'field' => 'PedidoMercaderia.created >=',
        ),
        'created_to' => array(
            'type' => 'value',
            'field' => 'PedidoMercaderia.created <=',
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
				'allowEmpty' => true,
				'required' => false,
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


	/**
	 * filtrar los proveedores involucrados retornando un listado de ID's
	 * 
	 * 
	 * @param array $pedidoMercaderias array del find de PedidoMercaderia
	 * @return array con un list de id's de proveedores
	 * 
	 **/
	public function getProveedoresInvolucrados( $pedidoMercaderias ) {
		$provs = [];
		foreach ($pedidoMercaderias as $pm) {
			if ( !empty($pm['Mercaderia']['Proveedor']['id']) ) {
				$provs[] = $pm['Mercaderia']['Proveedor']['id'];

			}
			if ( !empty($pm['Mercaderia']['Rubro']['Proveedor']) ) {
				foreach ($pm['Mercaderia']['Rubro']['Proveedor'] as $rubro) {
					$provs[] = $rubro['id'];
				}
			}
		}
		return $provs;
	}


	public function saveLimpios( $data ) {
		$enviarXMail = !empty($data['Pedido']['sendmail']);
		$pedidoLimpio = $this->limpiarPedidosSinCant($data['PedidoMercaderia'] );
 
 		$pedido = array();
        if ( $pedidoLimpio ) {    
        	if ( !empty($data['Pedido']) ) {
       			$pedido = $data['Pedido'];
        	}
			$pedido['PedidoMercaderia'] = $this->Pedido->agregarRubroSegunProveedorSeleccionado($data['Pedido']['proveedor_id'], $pedidoLimpio );
       		if ( $this->Pedido->saveAll($pedido, array('deep'=>true)) ) {
       				if ( $enviarXMail ) {
       					$mensajeMail = '';
       					if (!empty($data['Pedido']['mensaje_mail'])) {
       						$mensajeMail = trim($data['Pedido']['mensaje_mail']);
       					}
       					$this->Pedido->sendMail($this->Pedido->id, $mensajeMail);
       				}
	                
					ReceiptPrint::imprimirPedidoCompra($this->Pedido);
					return true;
            } else {
       			return false;
       		}
        }
        
        return true;
	}


	/**
	 * 
	 * 
	 * 	Limpiar los pedidos recibidos con formulario
	 * 	elimina los que cuya cantidad es CERO
	 * 
	 * 
	 **/
	public function limpiarPedidosSinCant ( $pedidoMercaderias ) {
		$pedidoLimpio = array();
		foreach ( $pedidoMercaderias as $pedido ) {
            if ( $pedido['cantidad'] ) {
                $mercaderia = array(
                    'id'   => empty($pedido['mercaderia_id']) ? null : $pedido['mercaderia_id'],
                    'name' => $pedido['mercaderia'],
                    'unidad_de_medida_id' => $pedido['unidad_de_medida_id'],
                    );

                if ($pedido) {
                    $pedido['Mercaderia'] = $mercaderia;
                }
                $pedidoLimpio[] = array(
                    'PedidoMercaderia' => $pedido,
                    );
            }
        }

        return $pedidoLimpio;
	}
}
