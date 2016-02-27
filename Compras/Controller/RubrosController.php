<?php
App::uses('ComprasAppController', 'Compras.Controller');
/**
 * Rubros Controller
 *
 * @property Rubro $Rubro
 * @property PaginatorComponent $Paginator
 */
class RubrosController extends ComprasAppController {



/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Rubro->recursive = 0;
		$this->set('rubros', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Rubro->exists($id)) {
			throw new NotFoundException(__('Invalid rubro'));
		}
		$options = array('conditions' => array('Rubro.' . $this->Rubro->primaryKey => $id));
		$this->set('rubro', $this->Rubro->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rubro->create();
			if ($this->Rubro->save($this->request->data)) {
				$this->Session->setFlash(__('The rubro has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rubro could not be saved. Please, try again.'));
			}
		}
		$proveedores = $this->Rubro->Proveedor->find('list');
		$this->set(compact('proveedores'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Rubro->exists($id)) {
			throw new NotFoundException(__('Invalid rubro'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Rubro->save($this->request->data)) {
				$this->Session->setFlash(__('The rubro has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rubro could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Rubro.' . $this->Rubro->primaryKey => $id));
			$this->request->data = $this->Rubro->find('first', $options);
		}
		$proveedores = $this->Rubro->Proveedor->find('list');
		$this->set(compact('proveedores'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Rubro->id = $id;
		if (!$this->Rubro->exists()) {
			throw new NotFoundException(__('Invalid rubro'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Rubro->delete()) {
			$this->Flash->success(__('The rubro has been deleted.'));
		} else {
			$this->Flash->error(__('The rubro could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
