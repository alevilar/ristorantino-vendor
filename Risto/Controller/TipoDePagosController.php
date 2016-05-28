<?php



App::uses('RistoAppController', 'Risto.Controller');

class TipoDePagosController extends RistoAppController {

	public $name = 'TipoDePagos';

     
	public function index() {
		$this->TipoDePago->recursive = 0;
		$this->set('tipoDePagos', $this->paginate());
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid TipoDePago.'),'Risto.flash_error');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('tipoDePago', $this->TipoDePago->read(null, $id));
	}


	public function edit($id = null) {
                
		if ( $this->request->is('post') || $this->request->is('put') ) {            
			if ($this->TipoDePago->save($this->request->data)) {
				$this->Session->setFlash(__('The TipoDePago has been saved'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The TipoDePago could not be saved. Please, try again.'),'Risto.flash_error');
			}
		}

		if (empty($this->request->data) && $id ) {
			$this->request->data = $this->TipoDePago->read(null, $id);
		}

		$this->render('form');
	}

	public function delete($id = null) {

		$this->TipoDePago->id = $id;
		if (!$this->TipoDePago->exists()) {
			throw new NotFoundException(__('Tipo de Pago Inválido'));
		}


		if ( $this->request->is(array('put', 'post')) && $this->TipoDePago->delete($id) ) {
			$this->Session->setFlash(__('TipoDePago deleted'));
		} elseif ($this->TipoDePago->id == TIPO_DE_PAGO_EFECTIVO ) {
			$this->Session->setFlash(__('No se puede eliminar el Tipo de Pago: Efectivo'),'Risto.flash_error');
		}
		$this->redirect($this->referer());
	}

}
?>