<?php
App::uses('ComandaAppController', 'Comanda.Controller');


class ObservacionesController extends ComandaAppController
{
    public $paginate = array(
        'order' => array('Observacion.created' => 'asc'),
        // 'paramType' => 'querystring',
    );


    public $scaffold;

    public function index() {
        $this->Prg->commonProcess();
        $conds = $this->Observacion->parseCriteria( $this->Prg->parsedParams() );
        $this->Paginator->settings['conditions'] = $conds;

        $this->Observacion->recursive = 0;

        $observacion = $this->Paginator->paginate('Observacion');

        $this->set('observacion',$observacion);
    }
    public function add() {

        if (!empty($this->request->data)) {
            $this->Observacion->create();
            if ($this->Observacion->save($this->request->data)) {
                $this->Session->setFlash(__('La Observación ha sido guardada'), 'Risto.flash_success');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('La Observación no ha podido ser guardada, vuelva a intentar.'), 'Risto.flash_error');
            }
        }
        $this->render('form');
    }

    public function edit($id = null) {

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('La Observación Inválida.'), 'Risto.flash_error');
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Observacion->save($this->request->data)) {
                $this->Session->setFlash(__('La Observación ha sido guardada'), 'Risto.flash_success');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('La Observación no ha podido ser guardada, vuelva a intentar.'), 'Risto.flash_error');
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Observacion->read(null, $id);
        }
        $this->render('form');
    }

    public function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('ID de la Observación Inválida'), 'Risto.flash_error');
        }
        if ($this->Observacion->delete($id)) {
            $this->Session->setFlash(__('La Observación Borrada'), 'Risto.flash_success');
        }
        $this->redirect(array('action'=>'index'));
    }

}
