<?php

App::uses('AppModel', 'Mesa.Model');

class Pago extends MesaAppModel {

	public $name = 'Pago';


	public $actsAs = array(
        'Search.Searchable',
        'Containable', 
        'Utils.SoftDelete',   
        'Risto.DiaBuscable' => array(
                'fechaField' => 'created',
                'fieldsParaSumatoria' => array(
                        "valor",
                ),
            ),    
        );


    
    public $validate = array(
        'mesa_id' => array(
            'notBlank' => array(
                'rule'     => 'notBlank',
            ),
            'numeric' => array(
                'rule'     => 'numeric',
            ),     
            'comparison'    => array(
                'rule' => array('comparison', '>', 0),
                'message' => 'El ID debe ser mayor a cero'
            ),
        ),
    );



	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
			'Mesa' => array('className' => 'Mesa.Mesa',
								'foreignKey' => 'mesa_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'TipoDePago' => array('className' => 'Risto.TipoDePago',
								'foreignKey' => 'tipo_de_pago_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

//        function afterSave() {
//            $this->Mesa->id = $this->data[$this->name]['mesa_id'];
//            $this->Mesa->saveField('modified', date('Y-m-d H:i:s', strtotime('now')), false);
//            return true;
//        }

	public $filterArgs = array(
        'mozo_id' => array(
            'type' => 'value',
            'field' => 'Mesa.mozo_id'
            ),
        'mesa_numero' => array(
            'type' => 'value',
            'field' => 'Mesa.numero'
            ),
        'valor' => array(
            'type' => 'value'
            ),        
        'created_from' => array(
            'type' => 'value',
            'field' => 'Pago.created >='
            ),
        'created_to' => array(
            'type' => 'value',
            'field' => 'Pago.created <='
            ),        
        );


    public function porTipoDePagoDesdeHasta ( $desde, $hasta) {
        $horarioCorte = Configure::read('Horario.corte_del_dia');
            $sqlHorarioDeCorte = "DATE(SUBTIME(Pago.created, '$horarioCorte:00:00'))";
            
            $pagos = $this->find('all', array(
                'conditions' => array(
                    "DATE(SUBTIME(Pago.created, '$horarioCorte:00:00')) BETWEEN ? AND ?" => array(
                        $desde,
                        $hasta
                    ) , 
                ),
                'fields' => array(
                    "DATE(SUBTIME(Pago.created, '$horarioCorte:00:00')) as fecha",
                    'sum(Pago.valor) as total',
                    'TipoDePago.*'
                ),
                'group' => array(
                    "fecha",
                    'TipoDePago.id',
                ),
                'order' => array(
                    'Pago.created DESC',
                    'TipoDePago.name ASC',
                ),
                'contain' => array(
                    'TipoDePago'
                )
            ));
            // traer array de fechas
            $fechas = array_flip(crear_fechas($desde, $hasta));
            $fechas = array_reverse($fechas);
            // aray de los mozos que estan en este intervalo de mesas
            $tipoPagos = $tipoPagosList = $totales = array();
            foreach ($pagos as &$m) {
                $tipoPagos[$m['TipoDePago']['id']] = null;
                $tipoPagosList[$m['TipoDePago']['id']] = array(
                    'name' => $m['TipoDePago']['name'],
                    'media_id' =>  $m['TipoDePago']['media_id'],
                ) ;
                
                if ( empty($totales[$m['TipoDePago']['id']]) ) {
                    $totales[$m['TipoDePago']['id']] = array(
                        'total' => 0,
                    );
                }
                $totales[$m['TipoDePago']['id']]['total'] += $m[0]['total'];
            }

            // convertir matriz con fechas y mozos
            foreach ($fechas as &$f) {
                $f = $tipoPagos;
            }
            // colocar el dato en la matriz
            foreach ($pagos as &$m) {
                $fechas[$m[0]['fecha']][$m['TipoDePago']['id']] = $m;
            }
            
            return array(
                    'fechas' => $fechas,
                    'tipoPagosList' => $tipoPagosList,
                    'totales' => $totales,
                );
    }

}
