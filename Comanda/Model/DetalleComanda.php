<?php
App::uses('ComandaAppModel', 'Comanda.Model');


class DetalleComanda extends ComandaAppModel {

	public $name = 'DetalleComanda';
	public $validate = array(
		'producto_id' => array('numeric'),
		'cant' => array('numeric'),
		'mesa_id' => array('numeric')
	);

	
	public $actsAs = array(
        'Search.Searchable',
        'Containable',
        );
	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
			'Producto' => array('className' => 'Product.Producto',
								'foreignKey' => 'producto_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Comanda' => array('className' => 'Comanda.Comanda',
								'foreignKey' => 'comanda_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''			
			)
	);
	
	public $hasMany = array(
			'DetalleSabor' => array(
								'className' => 'Comanda.DetalleSabor',
								'foreignKey' => 'detalle_comanda_id',
								'dependent' => true,
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



	public $filterArgs = array(
        'producto_id' => array(
            'type' => 'value',
            ),
        'categoria_id' => array(
            'type' => 'value',
            'field' => 'Producto.categoria_id'
            ),        
        'desde' => array(
            'type' => 'value',
            'field' => 'DetalleComanda.created >='
            ),
        'hasta' => array(
            'type' => 'value',
            'field' => 'DetalleComanda.created <='
            ),
        );

       
	
	
	public function guardar($data){		
		$this->save($data);
		unset($this->id);
		return $this;
	}



	public function saveComanda ( $fullData ) {
		$imprimir = $fullData['Comanda']['imprimir'] ? true : false;
		
		// este array contine la prioridad y la mesa_id ---> todos datos de Modelo Comanda
		$comanda = $fullData['Comanda'];		

		//cuento la cantidad de comanderas involucradas en este pedido para genrar la cantidad de comandas correspondientes
		$v_comanderas = array();		
		foreach( $fullData['DetalleComanda'] as $dc ) {

			if ( array_key_exists('cant_eliminada', $dc)) {
				$dc['cant'] = $dc['cant'] - $dc['cant_eliminada'];	
				$dc['cant_eliminada'] = 0;
			}

			if ( !array_key_exists('printer_id', $dc)) {
				// buscar a que comendara se debe imprimir este producto
				$this->Producto->id = $dc['producto_id'];
				$dc['printer_id'] = $this->Producto->field('printer_id');
			}


			$v_comanderas[ $dc['printer_id'] ]['DetalleComanda'][] = $dc;
		}
		$comandas = array();
		foreach ( $v_comanderas as $printer_id => $dcDc) {
			$comanda['printer_id'] = $printer_id;
			$comandas[] = array(
				'Comanda' => $comanda,
				'DetalleComanda' => $dcDc['DetalleComanda']
				);
		}

		return $this->Comanda->saveAll($comandas, array('deep' => true) );  
	}

}
?>