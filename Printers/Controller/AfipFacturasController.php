<?php
App::uses('PrintersAppController', 'Printers.Controller');
/**
 * AfipFacturas Controller
 *
 * @property AfipFactura $AfipFactura
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AfipFacturasController extends PrintersAppController {

	public $helpers = array(
        'Html' => array(
            'className' => 'Risto.PxHtml'
            ),
        'Form' => array(
            'className' => 'Risto.PxForm'
            ),
        'Session',
        'Paginator',
        'Number',
        'Time',
        'Text',
        'Barcodes.Barcode',
    );



	//public $sfaffold;

	public function beforeFilter () {

		parent::beforeFilter();
		$this->Auth->allow(array('view'));		
	}



/**
 * index method
 *
 * @return void
 */
	public function index() {

		$this->AfipFactura->recursive = 0;
		$this->AfipFactura->contain(array(
				'Mesa' => array(
					'Cliente' => array(
						'TipoDocumento', 
						'IvaResponsabilidad'
						), 
					'Mozo'
					)
				));
		$this->set('afipFacturas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->layout = 'Printers.factura';
		if (!$this->AfipFactura->exists($id)) {
			throw new NotFoundException(__('Factura inexistente'));
		}		
		$options = array(
			'conditions' => array(
				'AfipFactura.' . $this->AfipFactura->primaryKey => $id
				),
			'contain' => array(
				'Mesa' => array('Cliente' => array('TipoDocumento', 'IvaResponsabilidad'), 'Mozo')
				)
			);
		$factura = $this->AfipFactura->find('first', $options);		
		$this->set('factura', $factura);		
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AfipFactura->create();
			if ($this->AfipFactura->save($this->request->data)) {
				$this->Session->setFlash(__('The afip factura has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The afip factura could not be saved. Please, try again.'));
			}
		}
		$mesas = $this->AfipFactura->Mesa->find('list');
		$this->set(compact('mesas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AfipFactura->exists($id)) {
			throw new NotFoundException(__('Invalid afip factura'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AfipFactura->save($this->request->data)) {
				$this->Session->setFlash(__('The afip factura has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The afip factura could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AfipFactura.' . $this->AfipFactura->primaryKey => $id));
			$this->request->data = $this->AfipFactura->find('first', $options);
		}
		$mesas = $this->AfipFactura->Mesa->find('list');
		$this->set(compact('mesas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AfipFactura->id = $id;
		if (!$this->AfipFactura->exists()) {
			throw new NotFoundException(__('Invalid afip factura'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AfipFactura->delete()) {
			$this->Session->setFlash(__('The afip factura has been deleted.'));
		} else {
			$this->Session->setFlash(__('The afip factura could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
