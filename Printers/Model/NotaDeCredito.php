<?php
App::uses('Model', 'Model');

class NotaDeCredito extends Model {

	public $useTable = false;


	public function getViewDataForNotaDeCredito () {

    	return array(
			'numero_ticket' => $this->numero_ticket,
			'importe' => $this->importe,
			'tipo_factura' => $this->tipo,
			'descripcion' => $this->descripcion,
			'cliente' => $this->cliente,
			);
    }

}