<?php
App::uses('ComprasAppModel', 'Compras.Model');
App::uses('CakeEmail', 'Network/Email');
App::uses('CakeTime', 'Utility');

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
		'Proveedor' => array(
			'className' => 'Account.Proveedor',
			'foreignKey' => 'proveedor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
			if ( !CakeSession::check('Auth.User.pin') ) {
				$this->data['Pedido']['created_by'] = CakeSession::read('Auth.User.id');
			}
		}
		return parent::beforeSave($options);
	}


	public function getViewDataForPedidos ( $pedidoId = null ) {
		if ( empty($pedidoId) ) {
			$pedidoId = $this->id;
		}
		if (empty($pedidoId )) {
        	throw new NotFoundException("No se encontro una Órden de Copmra con el ID $pedidoId");
        }

        $this->contain(array(
        	'User',
        	'Proveedor',
        	'PedidoMercaderia' => array(
        		'Mercaderia',
        		'UnidadDeMedida',
        		),
        	));
        return array(
        	'pedido' => $this->read() ,
        	'proveedores' => $this->PedidoMercaderia->Mercaderia->Proveedor->find('list'),
        	);
		
	}


	/**
	 *
	 * 	A las mercaderias nuevas les agrego el proveedor y el rubro de la orden de compra
	 *  devuelvo el array de pedidoLimpio completado con esos datos
	 * 
	 * 	@return array $pedidoLimpio
	 **/
	public function agregarRubroSegunProveedorSeleccionado ( $proveedor_id, $pedidoLimpio ){
		$this->Proveedor->contain('Rubro');
		$prov = $this->Proveedor->read(null, $proveedor_id);
		$rubro_id = null;
		if ( count($prov['Rubro']) ) {
			$rubro_id = $prov['Rubro'][0]['id'];
		}

		// por cada pedido agrego el rubro y el profeevor de la mercaderia
		foreach ($pedidoLimpio as &$value) {
			$mercaderia = $value['PedidoMercaderia']['Mercaderia'];

			// limpieza del ID para cuando la mercaderia es nueva
			if ( empty($mercaderia['id']) ) {
				unset($value['PedidoMercaderia']['Mercaderia']['id']);
				unset($value['PedidoMercaderia']['mercaderia_id']);
			}

			if ( empty($value['PedidoMercaderia']['observacion']) && isset($value['PedidoMercaderia']['observacion']) ) {
				unset($value['PedidoMercaderia']['observacion']);
			}


			if ( empty($mercaderia['rubro_id']) || empty($mercaderia['proveedor_id']) ) {
				if ( empty($mercaderia['rubro_id']) && $rubro_id ) {
					$value['PedidoMercaderia']['Mercaderia']['rubro_id'] = $rubro_id;
				}
				
				if ( empty($mercaderia['default_proveedor_id']) ) {
					$value['PedidoMercaderia']['Mercaderia']['default_proveedor_id'] = $proveedor_id;
				}
			}
		}
		return $pedidoLimpio;
	}



	function sendMail($pid) {

		$str = '';
		$this->id = $pid;
		$this->contain(array(
			'User',
			'Proveedor',
			'PedidoMercaderia' => array(
				'UnidadDeMedida',
				'Mercaderia',
				)
			));
		$pedido = $this->read();

  		$str .= "ÍTEMS:\n";

		foreach ($pedido['PedidoMercaderia'] as $merca ) {  

				$cant = (float)$merca['cantidad'];
				$uMedida = $merca['UnidadDeMedida']['name'];
				$mercaderia = $merca['Mercaderia']['name'];
				$observacion = $merca['observacion'];

				$umedidaTxt = ($cant>1)? Inflector::pluralize($uMedida) : $uMedida;

				if ( $observacion ) {
					$observacion = ". OBS: " .$observacion;
				}
				$detalle = "$cant $umedidaTxt de $mercaderia$observacion";

		    	$str .= $detalle."\n";
		 }


	    $str .= "\n";
	    $str .= "\n";
	    $str .= "\n";
	   

    	$str .= "- " . CakeTime::format( $pedido['Pedido']['created'], "%A %d/%m/%y %H:%M" ) . "-";
  		$str .= "\n";
  		$str .= "Responda directamente a este mail si tiene dudas o consultas";


	    $Email = new CakeEmail();
		$siteMail = Configure::read("Restaurante.mail");
		$siteName = Configure::read("Site.name");
		$proveedorMail = $pedido['Proveedor']['mail'];
		$Email->from(array($siteMail => $siteName));
		$Email->to($proveedorMail);
		$Email->cc($siteMail);
		$Email->subject('Orden de Compra #'. $this->id);
		$ret = $Email->send($str);
	}
}
