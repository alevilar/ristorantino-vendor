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


	public function add () {
		if ($this->request->is(array('put','post'))) {
			if ( $this->Pedido->save($this->request->data, array('deep'=>true)) ) {
				$this->Flash->setFlash('Se ha guardado correctamente un nuevo pedido');
			} else {
				$this->Flash->setFlash('Error al guardar el pedido');
			}
		}

		$unidadDeMedidas = $this->Pedido->PedidoMercaderia->UnidadDeMedida->find('list');
		$mercaderias = $this->Pedido->PedidoMercaderia->Mercaderia->find('list');

		$this->set(compact('mercaderias', 'unidadDeMedidas'));
	}

}
