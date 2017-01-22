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

	/**
	 * 
	 * 	Me devuelve la cantidad de productos relacionados con una impresora
	 * 
	 * 
	 **/
	public function cantidadDeProductosEnImpresora($id) {
        
        $cant = $this->Producto->find('count', array(			
			'conditions' => array(
				'printer_id' => $id
				)
			)
        );

		return $cant;

	}


	/**
	 * 
	 * 	Actualiza todos los productos relacionados con una impresora, colocandole
	 * el ID pasado como parametro
	 * por defecto lo que hace es eliminar la relacion con la impresora (o sea, pone en NULL el printer_id)
	 * 
	 * 	@param $id es el ID de la impresora actual a buscar en los productos
	 *  @param $nuevoId es el ID de la impresora que quiero actualizar en dichos productos. Por defecto es NULL, eliminando la relacion con los producto
	 * 	@return true o false si hizo el update correctamente o -1 si no hay productos que usen la impresora pasada por parametro
	 **/
	public function modificaImpresoraProductos($id, $nuevoId = null) {
	    if ( $this->cantidadDeProductosEnImpresora($id) ) {
	    	return $this->Producto->updateAll(array('printer_id' => $nuevoId),array('printer_id' => $id));
	    }
	    return -1;
	}


}
