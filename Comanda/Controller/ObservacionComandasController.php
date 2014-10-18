<?php
App::uses('ComandaAppController', 'Comanda.Controller');
class ObservacionComandasController extends ComandaAppController
{
    public $paginate = array(
        'order' => array('Observacion.created' => 'asc'),
        // 'paramType' => 'querystring',
    );
    var $scaffold;

    public function index() {

    $this->Prg->commonProcess();
    $conds = $this->ObservacionComanda->parseCriteria( $this->Prg->parsedParams() );
    $this->Paginator->settings['conditions'] = $conds;
    $this->ObservacionComanda->recursive = 0;
    $observacion = $this->Paginator->paginate('ObservacionComanda');
    $this->set('observacion',$observacion);
}


}
