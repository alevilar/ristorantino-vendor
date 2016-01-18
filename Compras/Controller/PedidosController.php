<?php
App::uses('ComprasAppController', 'Compras.Controller');
/**
 * Pedidos Controller
 *
 */
class PedidosController extends ComprasAppController {


	public function index() {
		$pedidos = $this->Paginator->paginate();
		$this->set(compact('pedidos'));     

	}


	public function pendientes() {
		$pedidos = $this->Pedido->PedidoMercaderia->find('all', array(
			'conditions' => array(
				'PedidoMercaderia.pedido_estado_id <>' => COMPRAS_PEDIDO_ESTADO_COMPLETADO,
				),
			'contain' => array(
				'Mercaderia'=> array('Proveedor'),
				'Pedido'=>array('User'),
				'UnidadDeMedida',
				'PedidoEstado',
				),
		));

		$pedPorProv = array();
		foreach ($pedidos as $p) {			
			$provId = !empty($p['Mercaderia']['Proveedor']['id']) ? $p['Mercaderia']['Proveedor']['id'] : 0;
			$pedPorProv[$provId]['Proveedor'] = $p['Mercaderia']['Proveedor'];
			$pedPorProv[$provId]['PedidoMercaderia'][] = $p;
		}
		$pedidos = $pedPorProv;

		$pedidoEstados = $this->Pedido->PedidoMercaderia->PedidoEstado->find('list');
		$this->set(compact('pedidos', 'pedidoEstados'));
	}




	public function add () {
		if ($this->request->is(array('put','post'))) {


			$pedidoLimpio = array(
				'Pedido' => array(

					),
				'PedidoMercaderia' => array(),
			);
			
			foreach ( $this->request->data['PedidoMercaderia'] as $pedido ) {
				if ( $pedido['cantidad'] ) {
					$mercaderia = array(
						'id'   => empty($pedido['mercaderia_id']) ? null : $pedido['mercaderia_id'],
						'name' => $pedido['mercaderia'],
						'unidad_de_medida_id' => $pedido['unidad_de_medida_id'],
						);

					if ($pedido) {
						$pedido['Mercaderia'] = $mercaderia;
					}
					$pedidoLimpio['PedidoMercaderia'][] = array(
						'PedidoMercaderia' => $pedido,
						);
				}
			}
			
			if ( $pedidoLimpio ) {				
				if ( $this->Pedido->saveAll($pedidoLimpio, array('deep'=>true)) ) {
					$this->Session->setFlash('Se ha guardado correctamente un nuevo pedido');
					ReceiptPrint::imprimirPedidoCompra($this->Pedido);
				} else {
					debug($pedidoLimpio);
					debug($this->Pedido->validationErrors);
					$this->Session->setFlash('Error al guardar el pedido', 'Risto.flash_error');
				}
			} else {
				$this->Session->setFlash('Error, el pedido quedo vacio, o sea, no se seleccionaron cantidades', 'Risto.flash_error');
			}
		}

		$unidadDeMedidas = $this->Pedido->PedidoMercaderia->UnidadDeMedida->find('list');
		$mercaderias = $this->Pedido->PedidoMercaderia->Mercaderia->find('list');
		$mercaUnidades = $this->Pedido->PedidoMercaderia->Mercaderia->find('list', array('fields'=> array('id', 'unidad_de_medida_id')));
		$this->set(compact('mercaderias', 'unidadDeMedidas', 'mercaUnidades'));
	}


	public function imprimir ( $id ) {
		$this->Pedido->id = $id;
		ReceiptPrint::imprimirPedidoCompra($this->Pedido);
		$this->Session->setFlash( __( "Se envio a imprimir un pedido de compra" ));
		$this->redirect($this->referer() );
	}

	public function view ( $id ) {
		$pedido = $this->Pedido->find('first', array(
			'conditions'=>array('Pedido.id'=>$id),
			'contain' => array(
				'PedidoMercaderia'=> array(
					'Mercaderia'=>array('Proveedor'),
					'UnidadDeMedida',
					'PedidoEstado',
					)
				)
			));

		$this->set('pedido', $pedido);
	}

}
