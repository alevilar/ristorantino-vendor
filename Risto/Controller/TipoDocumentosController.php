<?php
class TipoDocumentosController extends RistoAppController {

	var $name = 'TipoDocumentos';

    public $paginate = array(
        'order' => array('TipoDocumento.id' => 'asc'),
    );

	public $scaffold;
    public function index() {
        $this->Prg->commonProcess();
        $conds = $this->TipoDocumento->parseCriteria( $this->Prg->parsedParams() );
        $this->Paginator->settings['conditions'] = $conds;
        $this->TipoDocumento->recursive = 0;
        $tipoDocumentos = $this->Paginator->paginate('TipoDocumento');
        $this->set('tipoDocumentos',$tipoDocumentos);
    }

    public function edit($id = null) {

        if ( $this->request->is('post') || $this->request->is('put') ) {
            if ($this->TipoDocumento->save($this->request->data)) {
                $this->Session->setFlash(__('El tipo de Documentos fue guardado'));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('El tipo de Documentos no fue guardado, Intentelo nuevamente.'),'Risto.flash_error');
            }
        }

        if (empty($this->request->data) && $id ) {
            $this->request->data = $this->TipoDocumento->read(null, $id);
        }

        $this->render('form');
    }

    public function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('El Id del Tipo de Documento'),'Risto.flash_error');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->TipoDocumento->delete($id)) {
            $this->Session->setFlash(__('El Tipo de Documento fue eliminado'));
            $this->redirect(array('action'=>'index'));
        }
    }
}
?>