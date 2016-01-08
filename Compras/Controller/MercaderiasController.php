<?php
App::uses('ComprasAppController', 'Compras.Controller');
/**
 * Mercaderias Controller
 *
 */
class MercaderiasController extends ComprasAppController {



	public function index() {
		$this->Prg->commonProcess();
        $conds = $this->Mercaderia->parseCriteria( $this->Prg->parsedParams() );

        $this->Paginator->settings['conditions'] = $conds; 

        $mercaderias = $this->Paginator->paginate();
        $defaultProveedor = $this->Mercaderia->Proveedor->find('list');
        $unidadDeMedidas = $this->Mercaderia->UnidadDeMedida->find('list');
        $this->set(compact('mercaderias', 'defaultProveedores', 'unidadDeMedidas'));
        $this->set('_serialize', array('mercaderias'));
	}


	public function add() {
		if ($this->request->is(array('put','post'))){
			if ( $this->Mercaderia->save($this->request->data) ) {
				$this->Session->setFlash('Se ha guardado correctamente');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Error al guardar', 'error');
			}
		}

        $defaultProveedores = $this->Mercaderia->Proveedor->find('list');
        $unidadDeMedidas = $this->Mercaderia->UnidadDeMedida->find('list');
        $this->set(compact('defaultProveedores', 'unidadDeMedidas'));
	}



	public function edit( $id ) {
		if ($this->request->is(array('put','post'))){
			if ( $this->Mercaderia->save($this->request->data) ) {
				$this->Session->setFlash('Se ha guardado correctamente');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Error al guardar', 'error');
			}
		}

		$this->request->data = $this->Mercaderia->find('first', array('condition'=>array('Mercaderia.id'=>$id)));

        $defaultProveedores = $this->Mercaderia->Proveedor->find('list');
        $unidadDeMedidas = $this->Mercaderia->UnidadDeMedida->find('list');
        $this->set(compact('mercaderias', 'defaultProveedores', 'unidadDeMedidas'));
        $this->set('_serialize', array('mercaderias'));
        $this->render('add');
	}


	 public function delete( $id = null ) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Comanda'), 'Risto.flash_error');            
        }
        if ($this->Mercaderia->delete($id)) {
            $this->Session->setFlash(__('Mercaderia deleted'), 'Risto.flash_success');
        } else {
            $this->Session->setFlash(__('No se pudo eliminar la Mercaderia'), 'Risto.flash_error');
        }
        if ($this->request->is('ajax')) {
            return 1;
        } 
        $this->redirect($this->referer());
    }
	


}
