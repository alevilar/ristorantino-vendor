<?php


App::uses('RistoAppController', 'Risto.Controller');

class TipoFacturasController extends RistoAppController {
    public $paginate = array(
        'order' => array('TipoFactura.created' => 'asc'),
    );
	public $name = 'TipoFacturas';

	public $scaffold;
    public function index() {
        $this->Prg->commonProcess();
        $conds = $this->TipoFactura->parseCriteria( $this->Prg->parsedParams() );
        $this->Paginator->settings['conditions'] = $conds;
        $this->TipoFactura->recursive = 0;
        $tipoFacturas = $this->Paginator->paginate('TipoFactura');
        $this->set('tipoFacturas',$tipoFacturas);
    }
    public function edit($id = null) {

        if ( $this->request->is('post') || $this->request->is('put') ) {
            if ($this->TipoFactura->save($this->request->data)) {
                $this->Session->setFlash(__('El tipo de Factura fue guardada'));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('The TipoDePago could not be saved. Please, try again.'),'Risto.flash_error');
            }
        }
        if (empty($this->request->data) && $id ) {
            $this->request->data = $this->TipoFactura->read(null, $id);
        }

        $this->render('form');
    }

    public function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalido Id por Tipo de Pago'),'Risto.flash_error');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->TipoFactura->delete($id)) {
            $this->Session->setFlash(__('Tipo de Pago Eliminando'));
            $this->redirect(array('action'=>'index'));
        }
    }

}
?>