<?php
App::uses('FidelizationAppController', 'Fidelization.Controller');
/**
 * Clientes Controller
 *
 * @property Cliente $Cliente
 * @property PaginatorComponent $Paginator
 */
class DescuentosController extends FidelizationAppController {


	public $scaffoldFields = array("name", "description", "porcentaje");

	public $scaffold;

	public function beforeRender ( ) {
		$this->set('scaffoldFields', $this->scaffoldFields);
	}

    public function index() {
        $this->Prg->commonProcess();
        $conds = $this->Descuento->parseCriteria( $this->Prg->parsedParams() );
        $this->Paginator->settings['conditions'] = $conds;
        $this->Descuento->recursive = 0;
        $descuentos = $this->Paginator->paginate('Descuento');
        $this->set('descuentos',$descuentos);
    }
    public function add() {

        if (!empty($this->request->data)) {
            $this->Descuento->create();
            if ($this->Descuento->save($this->request->data)) {
                $this->Session->setFlash(__('La Observación Comandas ha sido guardada'), 'Risto.flash_success');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('La Observación Comandas no ha podido ser guardada, vuelva a intentar.'), 'Risto.flash_error');
            }
        }
    }

    public function edit($id = null) {

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('La Observación Comandas Inválida.'), 'Risto.flash_error');
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Descuento->save($this->request->data)) {
                $this->Session->setFlash(__('La Observación Comandas ha sido guardada'), 'Risto.flash_success');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('La Observación Comandas no ha podido ser guardada, vuelva a intentar.'), 'Risto.flash_error');
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Descuento->read(null, $id);
        }
        $this->render('form');
    }

    public function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('ID de la Observación Comandas Inválida'), 'Risto.flash_error');
        }
        if ($this->Descuento->delete($id)) {
            $this->Session->setFlash(__('La Observación Comandas Borrada'), 'Risto.flash_success');
        }
        $this->redirect(array('action'=>'index'));
    }
}