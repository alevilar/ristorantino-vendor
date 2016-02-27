<?php
App::uses('ComprasAppController', 'Compras.Controller');
/**
 * PedidoMercaderias Controller
 *
 */
class PedidoMercaderiasController extends ComprasAppController {


	public function cambiarEstado ($estadoId = null, $id = null) {

        if ( $this->request->is( 'post') && !empty($this->request->data['Pedido']['id'])) {
            
            // filtrar solo los que vinieron un valor
            $this->request->data['Pedido']['id'] = array_filter($this->request->data['Pedido']['id'], function( $item ){
                return $item > 0;
            });
        }

        if ( !empty($id) ) {
            $this->request->data['Pedido']['id'] =  array($id);
        }        

        if ( $this->PedidoMercaderia->updateAll(array(
            'PedidoMercaderia.pedido_estado_id' => $estadoId,
            ), array(
            'PedidoMercaderia.id' => $this->request->data['Pedido']['id']
            )) ) {
            $this->Session->setFlash("Se ha modificado el estado correctamente");
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
