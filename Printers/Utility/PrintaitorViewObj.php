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
	*	@param Model $Model con el ID inicializado
	*
	**/
	public function __construct ( $Model, $printer_id, $viewName ) {
		$this->Model = $Model;
		if ( empty($this->Model->id ) ) {
			throw new CakeException(sprintf("Se debe incializar el ID del Model '%s' para poder enviar a imprimir". $Model->name )) ;
		}
		$this->printerId = $printer_id;
		$camelViewName = Inflector::camelize($viewName);
		$methodName = 'getViewDataFor'.$camelViewName;
		if ( method_exists($Model, $methodName ) ) {
			$dataToView = $Model->{$methodName}();
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
		 return $this->viewTextRender;
	}

}