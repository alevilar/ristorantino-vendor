<?php
App::uses('ComprasAppController', 'Compras.Controller');
/**
 * PedidoMercaderias Controller
 *
 */
class PedidoMercaderiasController extends ComprasAppController {


	public function cambiarEstado ($id, $estadoId) {
        $this->PedidoMercaderia->id=$id;
        if ( $this->PedidoMercaderia->saveField('pedido_estado_id', $estadoId) ){
            $this->Session->setFlash("Se marcó como completado el Pedido #$id");
        } else {
            $this->Session->setFlash("Error al marcar como completado al pedido #$id", 'Risto.flash_error');
        }
		$this->redirect($this->referer());
	}


    public function historial() {
        $this->Prg->commonProcess();
        $conds = $this->PedidoMercaderia->parseCriteria( $this->Prg->parsedParams() );

        $this->Paginator->settings = array(
            'order'  => array(
                'PedidoMercaderia.created' => 'DESC',
                ),
            'contain' => array(
                'Mercaderia'=> array('Proveedor'),
                'Pedido'=>array('User'),
                'UnidadDeMedida',
                'PedidoEstado',
                ),
            'conditions' => $conds,
        );

        $pedidos = $this->Paginator->paginate();


        $pedidoEstados = $this->PedidoMercaderia->PedidoEstado->find('list');
        $proveedores = $this->PedidoMercaderia->Mercaderia->Proveedor->find('list');
        $this->set(compact('pedidos', 'pedidoEstados', 'proveedores'));
    }


	function form($id = null)
    {
        if ( $this->request->is(array('post', 'put')) ) {
            if ( $this->PedidoMercaderia->save( $this->request->data ) ) {
                $this->Session->setFlash('la mercaderia del pedido ha sido guardada');
            } else {
                debug($this->PedidoMercaderia->validationErrors);
                $this->Session->setFlash('Error al guardar la mercaderia del pedido', 'Risto.flash_error');
            }
        }

        if (!empty($id)) {
            $this->PedidoMercaderia->recursive = 0;
            $this->request->data = $this->PedidoMercaderia->read(null, $id);
        }

        $unidadDeMedidas = $this->PedidoMercaderia->UnidadDeMedida->find('list');
        $mercaderias = $this->PedidoMercaderia->Mercaderia->find('list');
        $pedidoEstados = $this->PedidoMercaderia->PedidoEstado->find('list');
        $this->set('pedidoEstados', $pedidoEstados);
        $this->set('unidadDeMedidas', $unidadDeMedidas);
        $this->set('mercaderias', $mercaderias);
    }

   

    public function delete($id = null)
    {
        if (!$this->PedidoMercaderia->exists( $id) ) {
            $this->Session->setFlash(__('Invalid id for PedidoMercaderia', 'Risto.flash_error'));
        }
        if ($this->PedidoMercaderia->delete($id)) {
            $this->Session->setFlash(__('PedidoMercaderia deleted', true));
        }
        $this->redirect( $this->referer() );
    }

}
