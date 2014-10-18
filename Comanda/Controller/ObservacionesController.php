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







}
