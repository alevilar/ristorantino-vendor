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





	public function add( $id = null ) {
		if ($this->request->is(array('put','post'))){
			if ( $this->UnidadDeMedida->save($this->request->data) ) {
				$this->Session->setFlash('Se ha guardado correctamente');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash('Error al guardar', 'Risto.flash_error');
			}
		}

		if ( $id ) {
			if (!$this->UnidadDeMedida->exists($id)) {
				throw new NotFoundException(__('Unidad De Medida Inválido'));
			}
			$this->UnidadDeMedida->id = $id;
			$this->UnidadDeMedida->recursive = -1;
			$this->request->data = $this->UnidadDeMedida->read();
		}
        
	}


	/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UnidadDeMedida->id = $id;
		if (!$this->UnidadDeMedida->exists()) {
			throw new NotFoundException(__('Unidad De Medida Inválido'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UnidadDeMedida->delete()) {
			$this->Flash->success(__('Se ha borrado la Unidad de Medida.'));
		} else {
			$this->Flash->error(__('No se ha podido eliminar la Unidad de Medida'), 'Risto.flash_error');
		}
		return $this->redirect($this->referer());
	}


}
