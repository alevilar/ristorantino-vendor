<?php


class TipoDocumentosController extends RistoAppController {

	var $name = 'TipoDocumentos';

    public $paginate = array(
        'order' => array('TipoDocumento.id' => 'asc'),
        // 'paramType' => 'querystring',
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

}
?>