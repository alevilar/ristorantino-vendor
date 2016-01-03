<?php
App::uses('ComprasAppController', 'Compras.Controller');
/**
 * Mercaderias Controller
 *
 */
class MercaderiasController extends ComprasAppController {



	public function index() {
		$this->Prg->commonProcess();
        $conds = $this->Mercaderia->parseCriteria( $this->Prg->parsedParams() );

        $this->Paginator->settings['conditions'] = $conds; 

        $mercaderias = $this->Paginator->paginate();

        $this->set(compact('mercaderias'));
	}

}
