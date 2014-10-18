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
}