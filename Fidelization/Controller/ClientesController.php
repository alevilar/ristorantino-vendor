<?php
App::uses('FidelizationAppController', 'Fidelization.Controller');
/**
 * Clientes Controller
 *
 * @property Cliente $Cliente
 * @property PaginatorComponent $Paginator
 */
class ClientesController extends FidelizationAppController {

   // public $presetVars = true; // using the model configuration
         
/**
 * Components
 *
 * @var array
 */
	//public $components = array('Paginator', 'Session', 'Search.Prg');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Prg->commonProcess();
        $conds = $this->Cliente->parseCriteria( $this->Prg->parsedParams() );
		$this->Cliente->recursive = 0;
                
        $descuentoMaximo = Configure::read('Mozo.descuento_maximo');
        $currentRole = $this->Session->read('Auth.User.role');
             
        
        if ( strtolower($currentRole) == 'mozo' && is_numeric( $descuentoMaximo ) ) {                
            $conds['OR'] = array(
                    "Descuento.porcentaje <= $descuentoMaximo",
                    'Descuento.porcentaje IS NULL'
                );
        }
        $this->Paginator->settings['conditions'] = $conds;
        
        $descuentos = $this->Cliente->Descuento->find('list');
		$tipoDocumentos = $this->Cliente->TipoDocumento->find('list');
		$ivaResponsabilidades = $this->Cliente->IvaResponsabilidad->find('list');
		$this->set(compact('descuentos', 'tipoDocumentos', 'ivaResponsabilidades'));
		$this->set('clientes', $this->Paginator->paginate());
		$this->set('_serialize', array('clientes'));
	}



	public function jqm_clientes($tipo = 't'){

            $this->conHeader = false;
            $this->pageTitle = __('Listado de %s', Inflector::pluralize( Configure::read('Mesa.tituloCliente')));
             
            $clientes = $this->Cliente->todos();
            // $this->layout = 'jqm' ;
            $this->set('title_for_layout', Inflector::pluralize( Configure::read('Mesa.tituloCliente')) );
            $this->set('tipo', $tipo);
            $this->set('clientes',$clientes);
        }


	// addFacturaA
    function simple_add() {
        $this->pageTitle = 'Agregar Factura A';
        $this->layout = false;
		if (!empty($this->request->data)) {
			$this->Cliente->create();
			if ($this->Cliente->save($this->request->data)) {
				$this->Session->setFlash(__('Se agregó un nuevo %s', Configure::read('Mesa.tituloCliente') ));
            	$this->set('cliente_id', $this->Cliente->id);
            	$this->render('jqm_result');
			} else {
				$this->Session->setFlash(__('El %s no pudo ser gardado, intente nuevamente.', Configure::read('Mesa.tituloCliente')), 'Risto.flash_error');
				throw new InternalErrorException("Error al guardar el cliente");
				
			}
		}
		
		$tipo_documentos = $this->Cliente->TipoDocumento->find('list');
		$iva_responsabilidades = $this->Cliente->IvaResponsabilidad->find('list');

		$descuentos = $this->Cliente->Descuento->find('list');
		$tipoDocumentos = $this->Cliente->TipoDocumento->find('list');
		$ivaResponsabilidades = $this->Cliente->IvaResponsabilidad->find('list');
		$this->set(compact('descuentos', 'tipoDocumentos', 'ivaResponsabilidades'));

		$this->set(compact('descuentos', 'tipoDocumentos', 'ivaResponsabilidades'));
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
		$this->render('form');
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
		$this->render('form');
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
