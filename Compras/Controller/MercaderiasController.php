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
	}

    public function asignar_rubros() {
        if ($this->request->is(array('post', 'put'))) {
            if ( $this->Mercaderia->save($this->request->data) ) {
                $this->Session->setFlash("Se ha guardado correctamente a la mercaderia");
            } else {
                $this->Session->setFlash("Error al guardar la mercaderia", 'Risto.flash_error');
            }
        }

        $this->Prg->commonProcess();
        $conds = $this->Mercaderia->parseCriteria( $this->Prg->parsedParams() );

        $conds[] = 'Mercaderia.rubro_id IS NULL';
        $this->Paginator->settings['conditions'] = $conds; 

        $this->Paginator->settings['limit'] = 1; 


        $mercaderias = $this->Paginator->paginate();
        if ( !empty($mercaderias)) {
            $this->request->data = $mercaderias[0];
        }
        $rubros = $this->Mercaderia->Rubro->find('list');
        $defaultProveedores = $this->Mercaderia->Proveedor->find('list');
        $unidadDeMedidas = $this->Mercaderia->UnidadDeMedida->find('list');
        $this->set(compact('mercaderias', 'defaultProveedores', 'unidadDeMedidas', 'rubros'));
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

		$rubros = $this->Mercaderia->Rubro->find('list');
        $defaultProveedores = $this->Mercaderia->Proveedor->find('list');
        $unidadDeMedidas = $this->Mercaderia->UnidadDeMedida->find('list');    
        $this->set(compact('defaultProveedores', 'unidadDeMedidas', 'rubros'));
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

        $this->Mercaderia->id = $id;
		$this->request->data = $this->Mercaderia->read();

        $defaultProveedores = $this->Mercaderia->Proveedor->find('list');
        $rubros = $this->Mercaderia->Rubro->find('list');
        $unidadDeMedidas = $this->Mercaderia->UnidadDeMedida->find('list');
        $this->set(compact('mercaderias', 'defaultProveedores', 'unidadDeMedidas', 'rubros'));
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
