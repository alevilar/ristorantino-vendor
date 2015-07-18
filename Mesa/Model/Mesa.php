<?php

App::uses('MesaAppModel', 'Mesa.Model');

class Mesa extends MesaAppModel {

	public $name = 'Mesa';

	public $displayField = 'numero';

	public $actsAs = array(
		'Containable',
		'Search.Searchable',
		'Utils.SoftDelete', 
		);

	public $mozoNumero = 0;

	public $validate = array(
		'mozo_id' => array(
		 'notempty',
		 'numeric',
		 ),
		'numero' => array(
		 'notempty',
		 )
		);


	public $defaultContain = array(
					'Mozo',
					'Pago.TipoDePago',
					'Cliente' => array(
						'Descuento',
						'TipoDocumento',
						'IvaResponsabilidad.TipoFactura',
						),
					'Descuento',
					'Estado',
					'Comanda' => array(
						'DetalleComanda' => array(
							'Producto',
							'DetalleSabor.Sabor'),
					),
	);

	public $filterArgs = array(
		
        'numero' => array(
            'type' => 'value',
            ),
        'estado_id' => array(
            'type' => 'value',
            ),
        'mozo_id' => array(
            'type' => 'value',
            ),
        'mozo_numero' => array(
            'type' => 'value',
            'field' => 'Mozo.numero'
            ),
        'total' => array(
            'type' => 'value'
            ),        
        'created_from' => array(
            'type' => 'value',
            'field' => 'Mesa.created >='
            ),
        'created_to' => array(
            'type' => 'value',
            'field' => 'Mesa.created <='
            ),
        'time_cerro_from' => array(
            'type' => 'value',
            'field' => 'Mesa.time_cerro >='
            ),
        'time_cerro_to' => array(
            'type' => 'value',
            'field' => 'Mesa.time_cerro <='
            ),
        'time_cobro_from' => array(
            'type' => 'value',
            'field' => 'Mesa.time_cobro >='
            ),
        'time_cobro_to' => array(
            'type' => 'value',
            'field' => 'Mesa.time_cobro <='
            ),
        'checkin' => array(
            'type' => 'value',
        ),
        'checkout' => array(
            'type' => 'value',
        ),
        'checkin_from' => array(
            'type' => 'value',
            'field' => 'Mesa.checkin >='
            ),
        'checkin_to' => array(
            'type' => 'value',
            'field' => 'Mesa.checkin <='
            ),

        'checkout_from' => array(
            'type' => 'value',
            'field' => 'Mesa.checkout >='
            ),
        'checkout_to' => array(
            'type' => 'value',
            'field' => 'Mesa.checkout <='
            ),
        );


		/**
		 * belongsTo associations
		 *
		 * @var array
		 */
		public $belongsTo = array(
			'Mesa.Estado',
			'Mesa.Mozo',
			'Fidelization.Cliente',
			'Fidelization.Descuento',
		);



		public $hasMany = array(   
		  'Comanda' => array(
			'className' => 'Comanda.Comanda',
			'dependent' => true,
			'order' => 'Comanda.created DESC',
			'conditions' => array(
				'Comanda.deleted' => 0
				)
			), 
		  'Pago' => array(
			'className' => 'Mesa.Pago',
			'dependent' => true,
			'order' => 'Pago.created',
			'conditions' => array(
				'Pago.deleted' => 0
				)
			),         
		);


	public $changedState = null;


	public $order = array('Mesa.created' => 'desc');


		

	public function beforeSave($options = array() ) {
		parent::beforeSave($options);

		unset( $this->data['modified'] );

		if ( empty($this->data['Mesa']['id']) && empty($this->data['Mesa']['estado_id'])) {
			$this->data['Mesa']['estado_id'] = MESA_ABIERTA;

			// NEW MESA
			// al crear, si el checkin vino vacio hacer que sea AHORA (== a created)
			if (empty($this->data['Mesa']['checkin'])) {
				$this->data['Mesa']['checkin'] = date('Y-m-d H:i:s');
			}
		}

		if ( !empty($this->data['Mesa']['id']) ) {
			// UPDATE
			// update totals

			$this->__processStateChanges();

			// en caso de pasar de estado abierta a cerrada, aplicar cierre ejecutando cerrar_mesa()
			$this->__cerrarMesaSiEstabaAbiertaYAhoraEstadoEsCerrada();

			$this->__completeWithTotals();
		}

		return true;
	}


	public function afterSave($created, $options = array()) {
		if ( !$created && $this->changedState ) {
			$this->__sendEventStateChange( 'After');			
		}

		return parent::afterSave($created, $options);
	}



	/**
	*
	*	Completa colocando los totales con cada modificacion que sufre la mesa
	*
	**/
	private function __completeWithTotals () {
		$this->data['Mesa']['subtotal'] = $this->calcular_subtotal( $this->data['Mesa']['id'] );
		$this->data['Mesa']['total'] = $this->calcular_total( $this->data['Mesa']['id'] );
	}


	/**
	*
	*
	*	Genera un CakeEvent con el parametro $nuevoEstado
	*
	*	Mesa.{Before|After}Abierta
	*	Mesa.{Before|After}Cerrada
	*	Mesa.{Before|After}Cobrada
	*	Mesa.{Before|After}Estado{ID_ESTADO} EJ: Mesa.BeforeEstado2
	*
	*
	*
	*	@param Int $nuevoEstado ID del estado
	*	@param String $evName es un prefijo para poder usar el dispache de eventos en un BeforeSave y en un afterSave
	*
	**/
	private function __sendEventStateChange ( $evName  = 'Before') {
		$event = null;
		$oldState = $this->changedState;
		$nuevoEstado = $this->changedNewState;

		if  ( $nuevoEstado ) {
			$event = new CakeEvent("Mesa.".$evName."Estado".$nuevoEstado, $this);				
		}

		
		if  ( $nuevoEstado == MESA_ABIERTA ) {
			$event = new CakeEvent("Mesa.".$evName."Abierta", $this);				
		}

		if  ( $nuevoEstado == MESA_CERRADA ) {
			$event = new CakeEvent("Mesa.".$evName."Cerrada", $this);				
		}

		if  ( $nuevoEstado == MESA_COBRADA ) {
			$event = new CakeEvent("Mesa.".$evName."Cobrada", $this);				
		}

		if ( empty( $this->data['Mesa']['silent']) && $event ) {
			return $this->getEventManager()->dispatch($event);
		}
	}

	/**
	*	Procesa el Cambio de estado llenando el atributo $this->changedState
	*	con el nuevo ID del estado que fue moficiado
	*	Si el estado no fue modificado la funcion devuelve FALSE, al igual que 
	* 	$this->changedState permanecera en FALSE
	*
	*	@param String $evName Nombre prefixo del evento, generalemnte voy a usar "Before" y "After"
	*	@return false si nada cambio, sino el ID del nuevo estado
	*
	**/
	private function __processStateChanges ( $evName = 'Before') {
		$this->changedState = false;
		$this->changedNewState = false;

		$estadoAnterior = $this->field('estado_id');
		
		if ( empty($this->data['Mesa']['estado_id']) ) {
			return false;
		}
		$nuevoEstado = $this->data['Mesa']['estado_id'];
		if ( $estadoAnterior != $nuevoEstado ) {
			// set new estado_id		
			$this->changedState = $estadoAnterior;
			$this->changedNewState = $nuevoEstado;
		}

		return $this->changedState;
	}



	public function delDia($fechaDesde, $fechaHasta) {

		$horarioCorte = Configure::read('Horario.corte_del_dia');
		if ( $horarioCorte < 10 ) {
			$horarioCorte = "0$horarioCorte";
		}
		$sqlHorarioDeCorteCheckin  = "DATE( SUBTIME(Mesa.checkin , '$horarioCorte:00:00') )";
		$sqlHorarioDeCorteCheckout = "DATE( SUBTIME(Mesa.checkout, '$horarioCorte:00:00') )";


	 	$dias = crear_fechas($fechaDesde, $fechaHasta);
	 	$diasData = array();
	 	
	 	foreach ($dias as $dia) {
	 		$mesas = $this->find('first', array(
	 			'recursive' => -1,
	 			'fields' => array(
	 				'count(*) as cant',
	 				'sum(Mesa.cant_comensales) as suma',
					'sum(Mesa.subtotal) as "subtotal"',
					'sum(Mesa.total) as "total"',
					'sum(Mesa.total)/sum(Mesa.cant_comensales) as "promedio_cubiertos"',
					"DATEDIFF(Mesa.checkin, Mesa.checkout) as cant_dias",
	 				),
	 			'conditions' => array(
	 				"$sqlHorarioDeCorteCheckin <=" => $dia,
 					"$sqlHorarioDeCorteCheckout >=" => $dia,	 				
	 				'Mesa.deleted' => 0
	 				),
	 			));
	 		
	 		if ( !empty($mesas[0]['suma']) ) {
	 			$suma = (int)$mesas[0]['suma'];
	 		} else {
	 			$suma = 0;
	 		}
	 		$diasData[$dia] = array(
	 			'cant' => $mesas[0]['cant'],
	 			'cant_dias' => $mesas[0]['cant_dias'] + 1,
	 			'cubiertos' => $suma,
	 			'subtotal' => $mesas[0]['subtotal'],
	 			'total' => $mesas[0]['total'],
	 			'promedio_cubiertos' => $mesas[0]['promedio_cubiertos'],
 			);
	 	}
	 	return $diasData;
	}


	 private function __cerrarMesaSiEstabaAbiertaYAhoraEstadoEsCerrada ( $options = array() ) {
	 	if (    !empty($this->data['Mesa']['id'])
			 && !empty($this->data['Mesa']['estado_id'])
			 && $this->data['Mesa']['estado_id'] == MESA_CERRADA
			 && $this->estaAbierta()
			 ) 
	 	{               
	 		$silent = empty( $this->data['Mesa']['silent'] ) ? false : true;
	 		return $this->cerrar_mesa( $this->data['Mesa']['id'], false, $silent);
		}
		return false;
	 }




	//  function getMozoNumero($id = null)
	//  {
	//     if (!empty($id)) {
	//         $this->id = $id;
	//     }
	//     if(empty($this->mozoNumero)){
	//         $mozo = $this->find('first', array(
	//             'conditions' => array('Mesa.id'=>$this->id),
	//             'contain' => array('Mozo')
	//             ));
	//         $this->mozoNumero = $mozo['Mozo']['numero'];
	//     }

	//     return $this->mozoNumero;
	// }


	function cerrar_mesa( $mesa_id = null, $save = true, $silent = false )
	{		
		if ( !empty( $this->data['Mesa']['id'] ) ) {
			$this->id = $this->data['Mesa']['id'];
		}
		$this->id = ( $mesa_id == null ) ? $this->id : $mesa_id;

		if ( !$this->exists( $this->id ) ) {
			throw new NotFoundException(__('La Mesa ID# no existe', $this->id));
		}

		$data['Mesa']['id'] = $this->id;
		$data['Mesa']['estado_id'] = MESA_CERRADA;
		$data['Mesa']['time_cerro'] = date( "Y-m-d H:i:s");
		$data['Mesa']['time_cobro'] = DATETIME_NULL;
		//$data['Mesa']['silent'] = $silent; // no trigger del event

		// si no hay que guardar nada, regresar
		if ( $save ) {
			if ( !$this->save( $data ) ) {
				throw new CakeException("Error al guardar mesa cerrar mesa");
			}
		}
		
		return true;	
}



function calcular_total_productos ($id = null) {
	if (!empty($id)) $this->id = $id;

	$mesa = $this->find('first', array(
		'contain' => array(
			'Comanda' => array(
				'DetalleComanda' => array(
					'Producto',
					'DetalleSabor.Sabor'
					)
				),
			),
		'conditions'=> array('Mesa.id' => $this->id 
			)
		)
	);
	$comandas = $mesa['Comanda'];
	$total = 0;
	if ( $comandas ) {
		foreach ( $comandas as $c ) {
			$totParcial = 0;
			foreach ( $c['DetalleComanda'] as $dc ) {
				$totDetalleComanda = 0;			
				$cant = $dc['cant'] - $dc['cant_eliminada'];
				if ( $cant != 0 && !empty($dc['Producto']) ) {				
					$totDetalleComanda += $dc['Producto']['precio'];

					foreach ( $dc['DetalleSabor'] as $ds ) {
						$totDetalleComanda += $ds['Sabor']['precio'];
					}
					$totParcial += $totDetalleComanda * $cant;
				}
			}
			$total += $totParcial;
		}
	}
	return $total;
}


function calcular_descuentos($id = null) {
	if (!empty($id)) $this->id = $id;

	$this->contain(array('Descuento', 'Cliente.Descuento'));
	$mesa = $this->find('first', array('conditions' => array('Mesa.id'=>$this->id )));
	$descuento = 0;

	if (!empty($mesa['Descuento'])) {
		$descuento += $mesa['Descuento']['porcentaje'];
	}

	if ( !empty($mesa['Cliente']) && !empty($mesa['Cliente']['Descuento']) ) {
		$descuento += $mesa['Cliente']['Descuento']['porcentaje'];
	}

	return $descuento;
}



function calcular_subtotal($id = null){
	if ( !empty($id)) $this->id = $id;    
	
	if ( !$this->exists( $this->id ) ) {
		throw new NotFoundException(__('La Mesa ID# no existe', $this->id));
	}

	$totalProductos = $this->calcular_total_productos();
	$valor_cubierto = $this->calcular_valor_cubierto();
	
	return $totalProductos + $valor_cubierto;
}


/**
*	Funcion que calcula el precio del cubierto
*
*	@param Integer $mesaId default NULL
*	@return Float precio del cubierto
*
**/
function calcular_valor_cubierto ( $mesaId = null )  {
	if (!empty($mesaId)) {
		$this->id = $mesaId;
	}

	$cant_comensales = $this->field('cant_comensales');
	
	$precioCubierto = Configure::read('Restaurante.valorCubierto');
	$valor_cubierto = 0;
	if ($precioCubierto > 0) {
		$valor_cubierto =  $precioCubierto * $cant_comensales;
	}
	return $valor_cubierto;
}

	

	/**
	 * Calcula el total de la mesa cuyo id fue seteado en $this->Mesa->id 
	 * return @total el valor
	 */
	function calcular_total($id = null){
		if (!empty($id)) $this->id = $id;

		$subtotal = $this->calcular_subtotal();
		$totalPorcentajeDescuento = $this->calcular_descuentos();

		$conversionDescuento = 1-($totalPorcentajeDescuento/100);

		$total = cqs_round(  $subtotal * $conversionDescuento );

		return $total;
	}


	// function cantidadDeProductos($id = 0){
	// 	if($id != 0) 	$this->id = $id;
	// 	return null;
	// 	$items = $this->Comanda->DetalleComanda->find('count',array(
	// 		'conditions'=>array(
	// 			'Comanda.mesa_id'=>$this->id,
	// 			'(DetalleComanda.cant - DetalleComanda.cant_eliminada) >'=>0),
	// 		'order'=>'Comanda.id ASC, Producto.categoria_id ASC, Producto.id ASC',
	// 		'contain'=>array( 
	// 		  'Producto',
	// 		  'Comanda',
	// 		  'DetalleSabor' => 'Sabor(name,precio)'
	// 		  )
	// 		)
	// 	);

	// 	return $items;
	// }



	/**
	 * Me devuelve ellistado de productos de una mesa en especial
	 *
	 */
	function listado_de_productos($id = 0)
	{
		if($id != 0) 	$this->id = $id;	
		
		$items = $this->Comanda->DetalleComanda->find('all',array(
		   'conditions'=>array(
			  'Comanda.mesa_id'=>$this->id,
			  '(DetalleComanda.cant - DetalleComanda.cant_eliminada) >'=>0),
		   'order'=>'Comanda.id ASC, Producto.categoria_id ASC, Producto.id ASC',
		   'contain'=>array('Producto','Comanda','DetalleSabor'=>'Sabor(name,precio)')
		   ));
		for($i=0; $i<count($items); $i++){
			$items[$i]['DetalleComanda']['cant_final'] = $items[$i]['DetalleComanda']['cant']-	$items[$i]['DetalleComanda']['cant_eliminada'];
		}
		
		return $items;
	}


	function ultimasCobradas($limit = 20){

	  $conditions = array("Mesa.estado_id >=" => MESA_COBRADA);

	  $mesas = $this->find('all', array(
		'conditions'=>$conditions,
		'limit' => $limit,
		));

	  return $mesas;
  }



 //  function listado_de_abiertas($recursive = -1){

 //      $conditions = array("Mesa.estado_id" => MESA_ABIERTA);

 //      if($recursive>-1){
 //         $this->recursive = $recursive;			
 //         $mesas = $this->find('all', array('conditions'=>$conditions));
 //     }			
 //     else{
 //         $mesas = $this->find('all', array(
 //            'conditions'=>$conditions,
 //            'contain'=>array('Mozo(numero)')
 //            ));
 //     }
 //     return $mesas;
 // }


//  function listadoAbiertasYSinCobrar($recursive = -1){

//   $conditions = array("Mesa.estado_id <" => MESA_COBRADA);

//   if($recursive>-1){
//      $this->recursive = $recursive;
//      $mesas = $this->find('all', array(
//         'conditions'=>$conditions));
//  }
//  else{
//      $mesas = $this->find('all', array(
//         'conditions'=>$conditions,
//         'contain'=>array('Mozo(numero, id)')));
//  }

//             //debug($mesas);
//  return $mesas;
// }


	/**
	 * nos dice si el numero de mesa existe o no
	 * 
	 * @param integer numero demesa
	 * @return boolean
	 */
// 	function numero_de_mesa_existente($numero_mesa = 0){
// 		if($numero_mesa == 0){
//             if(!empty($this->data['Mesa']['numero'])){
//                $numero_mesa = $this->data['Mesa']['numero'];
//            }
//        }		

//        $this->recursive = -1;
//        $conditions = array(
//         'estado_id'=>MESA_ABIERTA, 
//         'numero'=>$numero_mesa);

//        if(!empty($this->id)){
//          if($this->id != ''){
//             $conditions = array_merge($conditions, array('Mesa.id <>'=> $this->id));

//         }
//     }

//     $result = $this->find('count',array('conditions'=>$conditions));

//     return ($result>0)?true:false;

// }


// function getNumero($mesa_id = 0){
//   if($mesa_id != 0){
//      $this->id = $mesa_id;
//  }
//  $mesa = $this->read();
//  return $mesa['Mesa']['numero'];

// }


		/**
		 *
		 * Esta funcion sirve para los casos en que no se quiere mostrar
		 * el detalle de los productos consumidos en el ticket.
		 * En ese caso sale impresa la leyenda "X MENU". La cantidad de menues
		 * (en este caso "X") viene dado por el parametro $cantMenues.
		 * El total de la mesa hay que pasarlo para luego dividirlo por la cantMenues
		 *
		 * @param integer $cantMenues cantidad, por ejemplo
		 * @param float $total
		 */
		// function getProductosSinDescripcion($cantMenues, $descripcion = 'Menu'){
		//     if ($descripcion == 'Menu' && ($descAux = Configure::read('Mesa.descripcionSinProductos'))){
		//         $descripcion = $descAux;
		//     }
		//     $prod[0]['nombre'] = $descripcion;
		//     $total = $this->calcular_subtotal();
		//     $prod[0]['precio'] = number_format( $total/$cantMenues, 2);
		//     $prod[0]['cantidad'] = $cantMenues;
		//     return $prod;
		// }


	public function dameProductosParaTicket( $id = 0 ){
	      if($id != 0) $this->id = $id;

	      if (empty($this->id)) {
	      	throw new CakeException("Id de mesa no puede ser vacio");
	      }
	      
     	  $items = $this->query("
	        select sum(cant-cant_eliminada) as cant, name as 'name', precio as precio from (
	            select
	            dc.cant,
	            dc.cant_eliminada,
	            p.abrev as name,
	            p.precio +  IFNULL((
	                select IFNULL(sum(s.precio),0) from detalle_sabores ds
	                left join sabores s on s.id = ds.sabor_id
	                where ds.detalle_comanda_id = dc.id
	                group by ds.detalle_comanda_id
	                ),0) precio,
	      dc.id,
	      p.order as orden
	      from
	      comandas c
	      left join detalle_comandas dc on dc.comanda_id = c.id
	      left join detalle_sabores ds on ds.detalle_comanda_id = dc.id
	      left join productos p on p.id = dc.producto_id
	      where c.mesa_id = $this->id
	      group by dc.id
	      ) as DetalleComanda
	      group by name, precio
	      having cant > 0
	      order by orden
	      ");

          $vItems = array();
	      $cont = 0;
	      foreach ($items as &$i) {
	        $vItems[$cont]['nombre'] = $i['DetalleComanda']['name'];
	        $vItems[$cont]['cantidad'] = $i[0]['cant'];
	        $vItems[$cont]['precio'] = cqs_round($i['DetalleComanda']['precio'],2);
	        $cont++;
	    }		
    	return $vItems;
	}



	/**
	 * devuelve todaslasmesas cerradas orcdenadas por fecha de cierre ASC
	 * @return array mesas find(all)
	 */
	function todasLasCerradas(){
		$this->recursive = 0;
		$conditions = array('estado_id' => MESA_CERRADA);
		return $this->find('all',array('conditions'=>$conditions, 'order'=>'time_cerro'));
	}



		/**
		 * Dice si una mesa esta cerrada o no
		 * @param integer $id
		 * @return boolean
		 */
		// function estaCerrada($id = null){
		//     if (!empty($id)){
		//         $this->id = $id;
		//     }
		//     // si lo tengo en memoria primero busco por aca
		//     if (!empty($this->data[$this->name]['estado_id'])){
		//         return $this->data[$this->name]['estado_id'] == MESA_CERRADA;
		//     }
		//     // lo busco en BBDD        
		//     $ret = $this->find('count', array(
		//         'conditions' => array(
		//             'Mesa.estado_id' => MESA_CERRADA,
		//             'Mesa.id' => $this->id,

		//             )
		//         ));

		//     if ($ret > 0) return false;
		//     else return true;
		// }
		
		
		/**
		 * Dice si una mesa esta cobrada o no
		 * @param integer $id
		 * @param boolean $force_db indica si quiero forzar para que busque en la BBDD
		 * @return boolean
		 */
		function estaCobrada($id = null, $force_db = false){
			$ret = false;
			if (!empty($id)){
				$this->id = $id;
			}
			
			if ( !empty($this->data[$this->name]['estado_id']) ){
				$ret = $this->data[$this->name]['estado_id'] == MESA_COBRADA;
			}
			
			if ( $force_db) {
				 // lo busco en BBDD        
				$ret = $this->find('count', array(
					'conditions' => array(
						'Mesa.estado_id' => MESA_COBRADA,
						'Mesa.id' => $this->id,
						)
					));
			}


			return $ret;
		}



		
		
		
		/**
		 * Dice si una mesa esta abierta o no
		 * @param integer $id
		 * @return boolean
		 */
		 function estaAbierta($id = null){
		     if (!empty($id)){
		         $this->id = $id;
		     }

		     // lo busco en BBDD        
		     $ret = $this->find('count', array(
		         'conditions' => array(
		             'Mesa.estado_id' => MESA_ABIERTA,
		             'Mesa.id' => $this->id,
	             )
         ));
	     return ($ret > 0);
		}


		function reabrir($mesa_id = null){
			$this->clear();
			if (!empty($mesa_id)) {
				$this->id = $mesa_id;
			}
			$this->set('checkout', null);
			$this->set('estado_id', MESA_ABIERTA);
			return $this->save();
		}


		function checkout($mesa_id = null){
			$this->clear();
			if (!empty($mesa_id)) {
				$this->id = $mesa_id;
			}
			$this->set('checkout', date('Y-m-d H:i:s'));
			$this->set('estado_id', MESA_CHECKOUT);
			return $this->save();
		}
		
		
		
		
		/**
		 * Me devuelve un listado agrupado por dia de mesas. Util para estadistica y contabilidad
		 * @param type $fechaDesde string formato de fecha debe ser del tip AÑO-mes-dia Y-m-d
		 * @param type $fechaHasta string formato de fecha debe ser del tip AÑO-mes-dia Y-m-d
		 * @param type $conds array de condiciones extra
		 */
		function totalesDeMesasEntre($fechaDesde = '', $fechaHasta = '', $conds = array()){
			$horarioCorte = Configure::read('Horario.corte_del_dia');
			if ( $horarioCorte < 10 ) {
				$horarioCorte = "0$horarioCorte";
			}
			$sqlHorarioDeCorte = "DATE(SUBTIME(Mesa.time_cerro, '$horarioCorte:00:00'))";
			$desde = empty($fechaDesde) ? date('Y-m-d', strtotime('now')) : $fechaDesde;
			$hasta = empty($fechaHasta) ? date('Y-m-d', strtotime('now')) : $fechaHasta;
			$defaultOrder = array();
			$defaultFields = array(
				'count(*) as "cant_mesas"',
				'sum(Mesa.cant_comensales) as "cant_cubiertos"',
				'sum(Mesa.subtotal) as "subtotal"',
				'sum(Mesa.total) as "total"',
				'sum(Mesa.total)/sum(Mesa.cant_comensales) as "promedio_cubiertos"',
				"$sqlHorarioDeCorte as fecha",                
				);
			
			$defaultGroup = array(
				"$sqlHorarioDeCorte"  ,
				);
			if ( empty($conds['order'])) {
				$defaultOrder = array(
					"Mesa.time_cerro DESC"
					);
			}
			
			
			$defaultConditions = array(
					'Mesa.deleted' => '0', // mesas no borradas
					"$sqlHorarioDeCorte BETWEEN '$desde' AND '$hasta'"
					);
			
			$ops = array(
				'fields' => $defaultFields,
				'conditions' => $defaultConditions,
				'group' => $defaultGroup,
				'order' => $defaultOrder,
				);
			$ops = array_merge_recursive($ops, $conds);
			$mesas =  $this->find('all', $ops);
			return $mesas;
		}



	   /**
	   * @param integer mesa_id Id de la mesa
	   * @throws InternalErrorException si no se le pasa un ID de mesa
	   */        
		function printFiscalEvent ( $mesa_id = null ) {
		  if (!empty($mesa_id)) {
			$this->id = $mesa_id;
		  }

		  if ( empty($this->id) ) {
			  throw new InternalErrorException("Se debe pasar el ID de la mesa para imprimir");
		  }

		  $this->getEventManager()->dispatch( new CakeEvent('Mesa.print', $this) );
		}



/**
 * Description
 * @param type $nombre_mesa_id 
 * @param type $left 
 * @param type $right 
 * @return type
 */
	public function getMesasForRoom($nombre_mesa_id, $left, $right) {
		$this->recursive = 0;
		$options = array('conditions' => array(
					'Mesa.checkin <=' => $right . ' 00:00:00',
					'Mesa.checkout >=' => $left . ' 23:59:59',
					'Mesa.nombre_mesa_id' => $nombre_mesa_id
		));
		// print_r($this->find('all', $options));die;
		return $this->find('all', $options);
	}

	public function hasRoomMesaInDate($room, $date) {
		$options = array('conditions' => array(
			'Mesa.nombre_mesa_id' => $room['Room']['id'],
			'Mesa.checkin <=' => $date . ' 23:59:59',
			'Mesa.checkout >=' => $date . ' 00:00:00',
		));
		$this->recursive = 0;
		$Mesa = $this->find('first', $options);
		return (!empty($Mesa)) ? true : false;
	}


	public function getMesasForRoomInDate($room, $date) {
		$Mesa_ids = array();
		$options = array(
			'conditions' => array(
				'Mesa.nombre_mesa_id' => $room['Room']['id'],
				'Mesa.checkin <=' => $date . ' 23:59:59',
				'Mesa.checkout >=' => $date . ' 00:00:00',
			),
			'fields' => array('id')
		);
		$this->recursive = 0;
		$Mesas = $this->find('all', $options);
		if ($Mesas) {
			$Mesa_ids = Hash::extract($Mesas, '{n}.Mesa.id');
		}
		return $Mesa_ids;
	}

/**
 * change the room state if today is between period of Mesa for a given nombre_mesa_id or room object
 * @param int|array $room
 * @param string $checkin 
 * @param string $checkout 
 * @return void
 */
	public function changeRoomStateIfTodayInPeriod($room, $checkin, $checkout) {
		if (!is_array($room) && (is_string($room) || is_int($room))) {
			$room = $this->Room->findById($room);
		}
		$today = date('Y-m-d');
		if ($this->hasRoomMesaInDate($room, $today)) {
			return $this->Room->changeRoomState($room, 2); // 2 = Ocupada
		} else {
			if ($room['Room']['room_state_id'] != 4) {
				return $this->Room->changeRoomState($room, 1);
			}
		}
	}




	/**
	*
	*	Metodo usado en el PrintaitorViewObj para
	*	generar los datos que seran enviados, en este caso al
	*	ticket.ctp
	* 	@param integer $mesaId ID de la mesa
	*	@return array de datos que seran expuestos en la vista como variables "$this->set()"
	**/
	public function getViewDataForTicket ( $mesaId = null ) {
		if ( empty($mesaId) ) {
			$mesaId = $this->id;
		}
		if (empty($mesaId )) {
        	throw new NotFoundException("No se encontro mesa con el ID $mesaId");
        }
		
		$tipo_factura_id = Configure::read('Afip.tipo_factura_id');
        $mesa = $this->find('first',array(
            'contain'=>array(
                'Mozo',
                'Cliente'=>array(
                    'Descuento',
                    'IvaResponsabilidad.TipoFactura',
                    'TipoDocumento',
                    ),
                'Descuento',
                ),
            'conditions' => array(
                'Mesa.id' => $mesaId
            ),
        ));

    	
        if( empty($mesa['Cliente']['id']) ){
            $mesa['Cliente'] = array();
        } elseif ( !empty($mesa['Cliente']['IvaResponsabilidad']['TipoFactura']['id']) ) {    		
    		$tipo_factura_id = $mesa['Cliente']['IvaResponsabilidad']['TipoFactura']['id'];
        }
        
        $mesa_numero = $mesa['Mesa']['numero'];
        $mozo_numero = $mesa['Mozo']['numero'];

        $cont  = 0;
        $total = 0;
        $prod = array();
        if ( $mesa['Mesa']['menu'] > 0 ) {
            $prod = $this->getProductosSinDescripcion($mesa['Mesa']['menu']);
        } else {
            $prod = $this->dameProductosParaTicket();
        }
        
        // agregar el valor del cubierto
        $valorCubierto = Configure::read('Restaurante.valorCubierto');
        
        if ( is_numeric($valorCubierto) && $valorCubierto >= 0 && is_numeric($mesa['Mesa']['cant_comensales']) ) {
            $prod[] = array(
                'nombre'   => 'Cubiertos',
                'cantidad' => $mesa['Mesa']['cant_comensales'],
                'precio'   => $valorCubierto,
                        );
        }

        $importe_descuento = 0;
        if(!empty($mesa['Cliente']['Descuento']['porcentaje'])) {
            //$porcentaje_descuento = $mesa['Cliente']['Descuento']['porcentaje'];
            $importe_descuento = cqs_round($mesa['Mesa']['subtotal'] - $mesa['Mesa']['total']);
        }



		$IvaResp = ClassRegistry::init('Risto.IvaResponsabilidad')->read(null, Configure::read('Restaurante.iva_responsabilidad'));
        $iva_responsabilidad =  $IvaResp;
        
        $dataFull = array(
        		'fullMesa' 			  => $mesa,
				'productos' 		  => $prod,
				'importe_descuento'   => $importe_descuento,
				'mozo' 				  => $mozo_numero,
				'mesa' 				  => $mesa_numero,
				'cliente' 			  => $mesa['Cliente'],
				'tipo_factura_id' 	  => $tipo_factura_id,
				'iva_responsabilidad' => $iva_responsabilidad
				);
        return $dataFull;
	}


}
	