<?php
App::uses('ComprasAppController', 'Compras.Controller');
/**
 * UnidadDeMedidas Controller
 *
 */
class UnidadDeMedidasController extends ComprasAppController {



	public function index() {

		$this->Prg->commonProcess();
        $conditions = $this->UnidadDeMedida->parseCriteria( $this->Prg->parsedParams() );
        
		$unidadDeMedidas = $this->UnidadDeMedida->find('all', array('conditions'=>$conditions));
		$this->set(compact('unidadDeMedidas'));
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
