<?php
App::uses('Printaitor', 'Printers.Utility');

class PrintaitorViewObj {

	public $viewTextRender = '';

	public $printerId = null;


	/**
	*
	*	Printer Array del Model save
	*
	**/
	public $printer = array();

	/**
	*	Array de parametros que van a ir a la vista como "$this->set"
	*	@param array
	**/
	public $dataToView = array();


	/**
	*
	*	@param Model $Model Modelo que voy a imprimir
	*	
	**/
	public $Model;


	/**
	*	Nombre de la vista renderizada
	**/
	public $viewName = '';


	public $hostName = '';


	/**
	*
	*	@param Model $Model Mesa o Comanda Model con el ID inicializado
	*
	**/
	public function __construct ( $Model, $printer_id, $viewName ) {
		$this->Model = $Model;
		$this->printerId = $printer_id;
		if ( method_exists($Model, 'getFullDataForTicket' ) ) {
			$dataToView = $Model->getFullDataForTicket();
			$this->dataToView = $dataToView;
		}

		$this->viewName = $viewName;
		
        $Printer = ClassRegistry::init("Printers.Printer");
        $Printer->recursive = -1;
        $printer = $Printer->read(null, $this->printerId );
        $this->printer = $printer;

       
	}


	public function getView () {
		 $this->viewTextRender = Printaitor::getView( $this );
	}

}