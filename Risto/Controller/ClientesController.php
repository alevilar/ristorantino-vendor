<?php
App::uses('AppController', 'Controller');
/**
 * Clientes Controller
 *
 * @property Cliente $Cliente
 * @property PaginatorComponent $Paginator
 */
class ClientesController extends AppController {

       public $presetVars = true; // using the model configuration
         


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Cliente->recursive = 0;
                
                $descuentoMaximo = Configure::read('Mozo.descuento_maximo');
                $currentRole = $this->Session->read('Auth.User.role');
                
                $this->Prg->commonProcess();
                $this->Paginator->settings['conditions'] = $this->Article->parseCriteria($this->Prg->parsedParams());
        
                $condiciones = array();
                
                if ( strtolower($currentRole) == 'mozo' && is_numeric( $descuentoMaximo ) ) {                
                    $condiciones['OR'] = array(
                            "Descuento.porcentaje <= $descuentoMaximo",
                            'Descuento.porcentaje IS NULL'
                        );
                }
                $this->paginate->settings['conditions'] = $condiciones;
                
                $this->set('tipo_documentos', $this->Cliente->TipoDocumento->find('list'));
		$this->set('clientes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Cliente->exists($id)) {
			throw new NotFoundException(__('Invalid cliente'));
		}
		$options = array('conditions' => array('Cliente.' . $this->Cliente->primaryKey => $id));
		$this->set('cliente', $this->Cliente->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Cliente->create();
			if ($this->Cliente->save($this->request->data)) {
				$this->Session->setFlash(__('The %s has been saved.', Configure::read('Mesa.tituloCliente')));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.', Configure::read('Mesa.tituloCliente')));
			}
		}
		$descuentos = $this->Cliente->Descuento->find('list');
		$tipoDocumentos = $this->Cliente->TipoDocumento->find('list');
		$ivaResponsabilidades = $this->Cliente->IvaResponsabilidad->find('list');
		$this->set(compact('descuentos', 'tipoDocumentos', 'ivaResponsabilidades'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Cliente->exists($id)) {
			throw new NotFoundException(__('Invalid %s', Configure::read('Mesa.tituloCliente')));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Cliente->save($this->request->data)) {
				$this->Session->setFlash(__('The %s has been saved.', Configure::read('Mesa.tituloCliente')));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.', Configure::read('Mesa.tituloCliente')));
			}
		} else {
			$options = array('conditions' => array('Cliente.' . $this->Cliente->primaryKey => $id));
			$this->request->data = $this->Cliente->find('first', $options);
		}
		$descuentos = $this->Cliente->Descuento->find('list');
		$tipoDocumentos = $this->Cliente->TipoDocumento->find('list');
		$ivaResponsabilidades = $this->Cliente->IvaResponsabilidad->find('list');
		$this->set(compact('descuentos', 'tipoDocumentos', 'ivaResponsabilidades'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Cliente->id = $id;
		if (!$this->Cliente->exists()) {
			throw new NotFoundException(__('Invalid %s', Configure::read('Mesa.tituloCliente')));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Cliente->delete()) {
			$this->Session->setFlash(__('The %s has been deleted.', Configure::read('Mesa.tituloCliente')));
		} else {
			$this->Session->setFlash(__('The %s could not be deleted. Please, try again.', Configure::read('Mesa.tituloCliente')));
		}
		return $this->redirect(array('action' => 'index'));
	}}
