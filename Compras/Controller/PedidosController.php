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
				'Mercaderia'=> array('Proveedor', 'Rubro'=>'Proveedor'),
				'Pedido'=>array('User'),
				'UnidadDeMedida',
				'PedidoEstado',
				),
			'order' => array('PedidoEstado.id', 'PedidoMercaderia.created'=>'DESC'),
		));

		$pedPorRubro = array();
		foreach ($pedidos as $p) {			
			$rubroId = !empty($p['Mercaderia']['Rubro']['id']) ? $p['Mercaderia']['Rubro']['id'] : 0;
			$pedEst = $p['PedidoMercaderia']['pedido_estado_id'];
			$pedPorRubro[$pedEst][$rubroId]['Rubro'] = $p['Mercaderia']['Rubro'];
			$pedPorRubro[$pedEst][$rubroId]['PedidoMercaderia'][] = $p;
		}
		$pedidos = $pedPorRubro;

		$pedidoEstados = $this->Pedido->PedidoMercaderia->PedidoEstado->find('list', array('order'=>array('PedidoEstado.id')));
		$this->set(compact('pedidos', 'pedidoEstados'));
	}




	public function add ( $id = null ) {
		if ($this->request->is(array('put','post'))) {


			$pedidoLimpio = array(
				'Pedido' => array(

					),
				'PedidoMercaderia' => array(),
			);
			if (!empty($id)) {
				$pedidoLimpio['Pedido']['id'] = $id;
			}

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
					$this->Session->setFlash('Error al guardar la Órden de Compra', 'Risto.flash_error');
				}
			} else {
				$this->Session->setFlash('Error, La Órden de Compra quedó vacía, o sea, no se seleccionaron cantidades', 'Risto.flash_error');
			}
		} else {
			if ( !empty($id) ) {
				if ( !$this->Pedido->exists($id) ) {
					throw new NotFoundException("El ID de Órden de Compra #$id no pudo ser encontrado");
				}
				$this->request->data['Pedido']['id'] = $id;
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
		$this->Session->setFlash( __( "Se envió a imprimir la Órden de Compra #", $id ));
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
					'Proveedor',
					)
				)
			));

		$this->set('pedido', $pedido);
	}


	public function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Órden de Compra', true));
            $this->redirect( $this->referer() );
        }
        if ($this->Pedido->delete($id)) {
            $this->Session->setFlash(__('Órden de Compra eliminada correctamente', true));
            if ( !$this->request->is('ajax') ) {
                $this->redirect($this->referer() );
            }
        }
        $this->Session->setFlash(__('La Órden de Compra no se puede eliminar. Reintente.', true));
        $this->redirect($this->referer() );
    }

}
