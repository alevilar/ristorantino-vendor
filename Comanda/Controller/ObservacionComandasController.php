<?php
App::uses('ComandaAppController', 'Comanda.Controller');
class ObservacionComandasController extends ComandaAppController
{
    public $paginate = array(
        'order' => array('Observacion.created' => 'asc'),
    );
    var $scaffold;

    public function index() {

        $this->Prg->commonProcess();
        $conds = $this->ObservacionComanda->parseCriteria( $this->Prg->parsedParams() );
        $this->Paginator->settings['conditions'] = $conds;
        $this->ObservacionComanda->recursive = -1;
        $observacion = $this->Paginator->paginate();
        $this->set('observacion',$observacion);
    }
    public function add() {

        if (!empty($this->request->data)) {
            $this->ObservacionComanda->create();
            if ($this->ObservacionComanda->save($this->request->data)) {
                $this->Session->setFlash(__('La Observación Comandas ha sido guardada'), 'Risto.flash_success');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('La Observación Comandas no ha podido ser guardada, vuelva a intentar.'), 'Risto.flash_error');
            }
        }
        $this->render('form');
    }

    public function edit($id = null) {

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('La Observación Comandas Inválida.'), 'Risto.flash_error');
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->ObservacionComanda->save($this->request->data)) {
                $this->Session->setFlash(__('La Observación Comandas ha sido guardada'), 'Risto.flash_success');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('La Observación Comandas no ha podido ser guardada, vuelva a intentar.'), 'Risto.flash_error');
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->ObservacionComanda->read(null, $id);
        }
        $this->render('form');
    }

    public function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('ID de la Observación Comandas Inválida'), 'Risto.flash_error');
        }
        if ($this->ObservacionComanda->delete($id)) {
            $this->Session->setFlash(__('La Observación Comandas Borrada'), 'Risto.flash_success');
        }
        $this->redirect(array('action'=>'index'));
    }
}
