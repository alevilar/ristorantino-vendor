<?php


App::uses('RistoAppController', 'Risto.Controller');

class TipoFacturasController extends RistoAppController {
    public $paginate = array(
        'order' => array('TipoFactura.created' => 'asc'),
        // 'paramType' => 'querystring',
    );
	public $name = 'TipoFacturas';

	public $scaffold;
    public function index() {
        $this->Prg->commonProcess();
        $conds = $this->TipoFactura->parseCriteria( $this->Prg->parsedParams() );
        $this->Paginator->settings['conditions'] = $conds;
        $this->TipoFactura->recursive = 0;
        $tipoFacturas = $this->Paginator->paginate('TipoFactura');
        $this->set('tipoFacturas',$tipoFacturas);
    }


}
?>