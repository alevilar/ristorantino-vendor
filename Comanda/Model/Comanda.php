
<?php

App::uses('ComandaAppModel', 'Comanda.Model');

define('DETALLE_COMANDA_TRAER_TODO', 0);
define('DETALLE_COMANDA_TRAER_PLATOS_PRINCIPALES', 1);
define('DETALLE_COMANDA_TRAER_ENTRADAS', 2);


class Comanda extends ComandaAppModel {

	var $name = 'Comanda';
	
	

	public $actsAs = array(
		'Containable',
		'Utils.SoftDelete', 
		);

	

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'DetalleComanda' => array('className' => 'Comanda.DetalleComanda',
								'foreignKey' => 'comanda_id',
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
	
	
	var $belongsTo = array(
			'Mesa' => array(
				'className' => 'Mesa.Mesa',
				'foreignKey' => 'mesa_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			),
			'Printer' => array(
				'className' => 'Printers.Printer',
				'foreignKey' => 'printer_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
				),
			'ComandaEstado' => array(
				'className' => 'Comanda.ComandaEstado',
				'foreignKey' => 'comanda_estado_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
				),
	);
        



	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct( $id, $table, $ds );

		App::uses('ComandasEventHandler','Comanda.Event');
		App::uses('ClassRegistry','Utility');

		$this->getEventManager()->attach( new ComandasEventHandler );
	}


        


	/**
	 * 
	 * 
	 * 	Realiza un find all basado en las $conditions
	 * y devuelve el resutlado pero separando los platos principales
	 * de las entradas
	 * 
	 **/
	public function buscarSeparandoEntradasYPrincipales( $type = 'all', $conditions = array(), $contain =array()) {

		if (empty($contain)){
			$contain = array(
                'Printer',
                'ComandaEstado',
                'Mesa' => 'Mozo',                
                );
		}
		$comandas = $this->find( $type, array(
            'conditions' => $conditions,
            'order' => array('Comanda.created' => 'ASC'),
            'contain' => $contain
            ));

		if ( $type == 'first' ) {
			$comandas = array($comandas);
		}
        foreach ($comandas as &$comanda) {
            # code...
            $contain = array(
                'Producto'=>array('Printer'),
                'DetalleSabor'=>array('Sabor')
            );

            $principales = $this->listado_de_productos_con_sabores($comanda['Comanda']['id'], DETALLE_COMANDA_TRAER_PLATOS_PRINCIPALES, $contain);

            $entradas = $this->listado_de_productos_con_sabores($comanda['Comanda']['id'], DETALLE_COMANDA_TRAER_ENTRADAS, $contain);

            $comanda['Principal'] = $principales;
            $comanda['Entrada'] = $entradas;
        }

        if ( $type == 'first' && !empty($comandas) ) {
        	// retornar solo 1 comanda,
			return $comandas[0];
		} else {
        	return $comandas;
		}
	}


	
	
	
	/**
	 * @param comanda_id
	 * @param con_entrada 	0 DETALLE_COMANDA_TRAER_TODOS si quiero todos los productos
	 * 						1 DETALLE_COMANDA_TRAER_PLATOS_PRINCIPALES si quiero solo platos principales
	 * 						2 DETALLE_COMANDA_TRAER_ENTRADAS si quiero solo las entradas
	 *
	 */
	public function listado_de_productos_con_sabores($id, $con_entrada = DETALLE_COMANDA_TRAER_TODOS, $contain = null){
		//inicialiozo variable return
		$items = array();

		if($id != 0){
			$this->id = $id;
		}

		
		$this->DetalleComanda->order = 'Producto.categoria_id';
		/*
		$this->DetalleComanda->recursive = 2;
		
		// le saco todos los modelos que no necesito paraqe haga mas rapido la consulta
		$this->DetalleComanda->Producto->unBindModel(array('hasMany' => array('DetalleComanda'), 
																 'belongsTo'=> array('Categoria')));
												 
		$this->DetalleComanda->DetalleSabor->unBindModel(array('belongsTo' => array('DetalleComanda')));
		*/
		unset($condiciones);
		$condiciones[]['DetalleComanda.comanda_id'] = $this->id;
		
		switch($con_entrada){
			case DETALLE_COMANDA_TRAER_PLATOS_PRINCIPALES: // si quiero solo platos principales
				$condiciones[]['DetalleComanda.es_entrada'] = 0;
				break;
			case DETALLE_COMANDA_TRAER_ENTRADAS: // si quiero solo entradas
				$condiciones[]['DetalleComanda.es_entrada'] = 1;
				break;
			default: // si quiero todo = DETALLE_COMANDA_TRAER_TODoS
				break;
		}

		if (empty($contain) ) {
			$contain = array(
				'Producto'=>array('Printer'),
				'Comanda'=> array('Mesa'=>array('Mozo')),
				'DetalleSabor'=>array('Sabor')
			);
		}
		
		$items = $this->DetalleComanda->find('all',array('conditions'=>$condiciones,
														'contain'=>$contain));
		return $items;
	}
	
	
	/**
	 * @param comanda_id
	 * @return array() de printer_id
	 */
	public function comanderas_involucradas($id){
		$this->recursive = 2;
		$group = array('Producto.printer_id');
		$result =  $this->DetalleComanda->find('all',array(	
                    'conditions' => array('DetalleComanda.comanda_id'=> $id),
                            'group'=>$group,
                            'fields'=>$group));
		$v_retorno = array();
		foreach($result as $r){
			$v_retorno[] = $r['Producto']['printer_id'];
		}
		return $v_retorno;
	}


	public function afterSave(  $created, $options = array() ) {
		$comanda = $this->find('first', array(
				'contain'=> false,
				'conditions' => array('Comanda.id' => $this->id),
		));
		if ( $comanda ) {
			$this->Mesa->id = $comanda['Comanda']['mesa_id'];
			return $this->Mesa->saveField('modified', date('Y-m-d H:i:s'));
		}
	}



	/**
	*
	*	Metodo usado en el PrintaitorViewObj para
	*	generar los datos que seran enviados, en este caso al
	*	comanda.ctp
	* 	@param integer $id ID de la Comanda
	*	@return array de datos que seran expuestos en la vista como variables "$this->set()"
	**/
	public function getViewDataForComandas ( $id = null ) {
		
		$observacion = $this->field('observacion');
		$this->contain(array(
			'Mesa.Mozo'
			));
		$comanda = $this->read();
		$entradas = $this->listado_de_productos_con_sabores($this->id, DETALLE_COMANDA_TRAER_ENTRADAS);
		$platos_principales = $this->listado_de_productos_con_sabores($this->id, DETALLE_COMANDA_TRAER_PLATOS_PRINCIPALES);

		$productos = array_merge($entradas, $platos_principales);

		return array(
			'productos'=> $productos,
			'entradas' => $entradas,
			'observacion' => $observacion,
			'comanda' => $comanda,
			);
	}






	/**
	 * 
	 * 	Guarda 1 comanda por printer_id
	 * 
	 **/
	public function saveComanda ( $fullData ) {
		$imprimir = !empty($fullData['Comanda']['imprimir']) ? true : false;
		$fullData['Comanda']['impresa'] = $imprimir;
		
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
				$this->DetalleComanda->Producto->id = $dc['producto_id'];
				$dc['printer_id'] = $this->DetalleComanda->Producto->field('printer_id');
			}


			// convertir [DetalleSabor] en sabores, porque viene asi del JS
			if ( !empty($dc['DetalleSabor']) ) {
				$detalleSabores = array();
				foreach ( $dc['DetalleSabor'] as $ds ) {
					$detalleSabores[] = array('Sabor'=>$ds);
				}
				unset( $dc['DetalleSabor'] );
				$dc['DetalleSabor'] = $detalleSabores;
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

		return $this->saveAll($comandas, array('deep' => true) );  
	}

	
}
