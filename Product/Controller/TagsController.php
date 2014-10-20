<?php
App::uses('ProductAppController', 'Product.Controller');


class TagsController extends ProductAppController {
    public $paginate = array(
        'order' => array('Tag.created' => 'asc'),
    );


    public $scaffold;

    public function index() {
        $this->Prg->commonProcess();
        $conds = $this->Tag->parseCriteria( $this->Prg->parsedParams() );
        $this->Paginator->settings['conditions'] = $conds;
        $this->Tag->recursive = 0;
        $tag = $this->Paginator->paginate('Tag');
        $this->set('tag',$tag);
    }
    public function add() {

        if (!empty($this->request->data)) {
            $this->Tag->create();
            if ($this->Tag->save($this->request->data)) {
                $this->Session->setFlash(__('La Etiqueta ha sido guardada'), 'Risto.flash_success');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('La Etiqueta no ha podido ser guardada, vuelva a intentar.'), 'Risto.flash_error');
            }
        }
        $productos = $this->Tag->Producto->find('list');
        $this->set(compact('productos'));
        $this->render('form');
    }

    public function edit($id = null) {

        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('La Etiqueta Inválida.'), 'Risto.flash_error');
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Sabor->save($this->request->data)) {
                $this->Session->setFlash(__('La Etiqueta ha sido guardada'), 'Risto.flash_success');
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('La Etiqueta no ha podido ser guardada, vuelva a intentar.'), 'Risto.flash_error');
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Sabor->read(null, $id);
        }
        $productos = $this->Tag->Producto->find('list');
        $this->set(compact('productos'));
        $this->render('form');
    }

    public function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('ID de la Etiqueta Inválida'), 'Risto.flash_error');
        }
        if ($this->Sabor->delete($id)) {
            $this->Session->setFlash(__('La Etiqueta Borrada'), 'Risto.flash_success');
        }
        $this->redirect(array('action'=>'index'));
    }
}