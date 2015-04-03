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
	*	Nombre de la vista renderizada
	**/
	public $viewName = '';


	public $hostName = '';


	/**
	*
	*	
	*
	**/
	public function __construct ( $dataToView, $printer_id, $viewName ) {
		$this->printerId = $printer_id;
		$this->dataToView = $dataToView;
		$this->viewName = $viewName;
		
        $Printer = ClassRegistry::init("Printers.Printer");
        $Printer->recursive = -1;
        $printer = $Printer->read(null, $this->printerId );
        $this->printer = $printer;

        $this->viewTextRender = Printaitor::getView( $this );
	}

}