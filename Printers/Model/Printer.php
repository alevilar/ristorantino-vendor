<?php
App::uses('PrintersAppModel', 'Printers.Model');

App::uses('Printaitor', 'Printers.Utility');


/**
 * Printer Model
 *
 */
class Printer extends PrintersAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';



	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $hasMany = array(
			'Producto' => array('className' => 'Product.Producto',
								'foreignKey' => 'printer_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);



/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'alias' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'driver' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);


	public function listarComanderas () {
		$printers = $this->Producto->Printer->find('list'
							,array(
								'fields'=>array(
									'id',
									'name'
									)
							, 'conditions' => array(
								'Printer.driver <>'=>'Fiscal') 
							)
							);		
		return $printers;
	}


	/**
	 * @param int $id Printer Id
	 */
	public function imprimirCierre ( $type = "X", $id = null ) {
		Printaitor::close( $type );
	}


	public function imprimirTicket ( $id = null ) {
		return Printaitor::send($dataToView, $printerName, $viewName);
	}


	public function imprimirNotaDeCredito ( $id = null ) {
		throw new NotImplementedException("imprimirNotaDeCredito no implementado");
	}

	

	public function imprimirComanda ( $id = null ) {
		throw new NotImplementedException("imprimirComanda no implementado");
	}

	public function imprimirTexto ( $id = null ) {
		throw new NotImplementedException("imprimirTexto no implementado");
	}

	public function checkearImpresoraProductos($id) {
        
		if ($this->Producto->find('count', array(
			'fields' =>array(
				'printer_id' => $id
				),
			'conditions' => array(
				'printer_id' => $id))) >= 1) {

			return true;

		} else {
			return false;
		}
	}

	public function desvincularImpresoraProductos($id) {
	    if ($this->Producto->find('count', array(
			'fields' =>array(
				'printer_id' => $id
				),
			'conditions' => array(
				'printer_id' => $id))) >= 1) {

	    	$this->Producto->updateAll(array('printer_id' => null),array('printer_id' => $id));

		} 
	}


}
