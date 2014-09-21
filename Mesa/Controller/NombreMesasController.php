<?php
App::uses('AppController', 'Controller');
/**
 * NombreMesas Controller
 *
 * @property NombreMesa $NombreMesa
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class NombreMesasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->NombreMesa->recursive = 0;
		$this->set('nombreMesas', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->NombreMesa->exists($id)) {
			throw new NotFoundException(__('Invalid nombre mesa'));
		}
		$options = array('conditions' => array('NombreMesa.' . $this->NombreMesa->primaryKey => $id));
		$this->set('nombreMesa', $this->NombreMesa->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->NombreMesa->create();
			if ($this->NombreMesa->save($this->request->data)) {
				$this->Session->setFlash(__('The nombre mesa has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The nombre mesa could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->NombreMesa->exists($id)) {
			throw new NotFoundException(__('Invalid nombre mesa'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->NombreMesa->save($this->request->data)) {
				$this->Session->setFlash(__('The nombre mesa has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The nombre mesa could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('NombreMesa.' . $this->NombreMesa->primaryKey => $id));
			$this->request->data = $this->NombreMesa->find('first', $options);
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
		$this->NombreMesa->id = $id;
		if (!$this->NombreMesa->exists()) {
			throw new NotFoundException(__('Invalid nombre mesa'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->NombreMesa->delete()) {
			$this->Session->setFlash(__('The nombre mesa has been deleted.'));
		} else {
			$this->Session->setFlash(__('The nombre mesa could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
