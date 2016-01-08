<?php
App::uses('ComprasAppController', 'Compras.Controller');
/**
 * PedidoMercaderias Controller
 *
 */
class PedidoMercaderiasController extends ComprasAppController {


	public function completar ($id) {
        $this->PedidoMercaderia->id=$id;
        if ( $this->PedidoMercaderia->saveField('pedido_estado_id', COMPRAS_PEDIDO_ESTADO_COMPLETADO) ){
            $this->Session->setFlash("Se marcó como completado el Pedido #$id");
        } else {
            $this->Session->setFlash("Error al marcar como completado al pedido #$id", 'Risto.flash_error');
        }
		$this->redirect($this->referer());
	}


	function form($id = null)
    {
        if ( $this->request->is(array('post', 'put')) ) {
            debug($this->request->data);
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

    function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Clasificacion', true));
        }
        if ($this->Clasificacion->delete($id)) {
            $this->Session->setFlash(__('Clasificacion deleted', true));
        }
        $this->redirect(array('action' => 'index'));
    }
}
