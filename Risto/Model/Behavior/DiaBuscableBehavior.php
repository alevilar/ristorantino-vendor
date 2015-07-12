<?php

class DiaBuscableBehavior extends ModelBehavior {



	/**
	*
	*	El campo de la tabla que quiero buscar por fecha
	*
	**/
	public $fechaField = 'created';


	/**
	*
	*	Listado de campos que quiero aplicarle el SUM(Nombre_del_campo)
	*	Ej:
	* 	   array('total', 'subtotal', 'neto') 
	**/
	public $fieldsParaSumatoria = array();

	/**
    * Setup the behavior
    */
	public function setUp ( Model $Model, $options	 = array() ) {
		 
		 if ( !empty($options['fieldsParaSumatoria']) ) {
		 	$this->fieldsParaSumatoria = $options['fieldsParaSumatoria'];
		 }

		 if ( !empty($options['fechaField']) ) {
		 	$this->fechaField = $options['fechaField'];
		 }
	}



    public function delDia( Model $Model, $desde, $hasta ) {
        return $this->__desdeHasta($Model, $desde, $hasta);
    }



    public function sumaDelDia( Model $Model, $desde, $hasta ) {
    	$modelName = $Model->name;

    	$gasOps = array();
    	$resField = array();
    	foreach ( $this->fieldsParaSumatoria as $field ) {
            $gasOps['fields'][] = "sum($modelName.$field) as $field";
            $resField[$field] = 0;
    	}

        $res = $this->__desdeHastaSum( $Model, $desde, $hasta, $gasOps);            
        // les pongo los valores a cada campo
        if ( !empty($res[0]) ) {
            foreach ( $resField as $field=>$val ) {
        		if (!empty($res[0][$field])) {
        			$resField[$field] = $res[0][$field];
        		}
	        }            
    	}    
        return $resField;
    }



    /**
    *
    *   Busca por su fecha desde-hasta
    *
    **/
    public function __desdeHastaSum( Model $Model, $desde, $hasta, $ops = array() ) {
    	$horarioCorte = Configure::read('Horario.corte_del_dia');
		if ( $horarioCorte < 10 ) {
			$horarioCorte = "0$horarioCorte";
		}


    	$modelName = $Model->name;
    	$fechaField = $this->fechaField;


    	$sqlHorarioDeCorte  = "DATE( SUBTIME( $modelName.$fechaField , '$horarioCorte:00:00') )";

        $default = array(            
            'group' => array(
                "DATE($modelName.$fechaField)"
            ),
            'recursive' => -1
        );
        $conds = $default + $ops;


 		$conds['conditions']["$sqlHorarioDeCorte BETWEEN ? AND ?"] = array($desde, $hasta );
 		$list = $Model->find('first', $conds);
 		if ( !empty($list) && array_key_exists($modelName, $list)) {
 			$list = $list[$modelName];
 		}
	 	
		return $list;
    }




    /**
    *
    *   Busca por su fecha desde-hasta
    *
    **/
    public function __desdeHasta( Model $Model, $desde, $hasta, $ops = array() ) {
    	$horarioCorte = Configure::read('Horario.corte_del_dia');
		if ( $horarioCorte < 10 ) {
			$horarioCorte = "0$horarioCorte";
		}


    	$modelName = $Model->name;
    	$fechaField = $this->fechaField;


    	$sqlHorarioDeCorte  = "DATE( SUBTIME( $modelName.$fechaField , '$horarioCorte:00:00') )";

        $default = array(            
            'group' => array(
                "DATE($modelName.$fechaField)"
            ),
            'recursive' => -1
        );
        $conds = $default + $ops;


        $dias = crear_fechas($desde, $hasta);
	 	$diasData = array();
	 	
	 	foreach ($dias as $dia) {
	 		$conds['conditions']["$sqlHorarioDeCorte"] = $dia;
	 		$list = $Model->find('first', $conds);
	 		if ( !empty($list) && array_key_exists($modelName, $list)) {
	 			$list = $list[$modelName];
	 		}
	 		$diasData[$dia] = $list;
	 	}
		return $diasData;
    }


}