<?php
App::uses('ComprasAppController', 'Compras.Controller');
/**
 * UnidadDeMedidas Controller
 *
 */
class UnidadDeMedidasController extends ComprasAppController {


	public function index() {
		$unidadDeMedidas = $this->UnidadDeMedida->find('all');
		$this->set(compact('unidadDeMedidas'));
        $this->set('_serialize', array('unidadDeMedidas'));
	}





	public function add() {
		if ($this->request->is(array('put','post'))){
			if ( $this->UnidadDeMedida->save($this->request->data) ) {
				$this->Session->setFlash('Se ha guardado correctamente');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Error al guardar', 'Risto.flash_error');
			}
		}
        
	}


}
