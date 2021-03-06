<?php

App::uses('MesaAppModel', 'Mesa.Model');

class Mozo extends MesaAppModel {

	public $name = 'Mozo';

    public $useDbconfig = 'tenant';

    public $actsAs = array(
        'Utils.SoftDelete', 
        'Containable',
        'Risto.MediaUploadable',
        'Search.Searchable',
        );
    

    public $displayField = 'numero_y_nombre';
    
    public $order = array(
        'Mozo.activo DESC', 
        'Mozo.numero'
    );



    public $filterArgs = array(
        'search' => array(
            'type' => 'like',
            'field' => array('Mozo.numero','Mozo.nombre','Mozo.apellido'),
            ),
    );

    
    public $virtualFields = array(
      'numero_y_nombre' => "CONCAT(Mozo.numero,' (', Mozo.nombre, ' ', Mozo.apellido, ')')",
    );
    

    public $validate = array(
        'numero' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Debe ingresar un alias'
            ),
        ),
        );

	
        

	public $hasMany = array(
			'Mesa' => array('className' => 'Mesa.Mesa',
                            'foreignKey' => 'mozo_id',
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
	
	
	/**
	 * Me devuelve todo los mozos activos
	 *
	 * @param recursive -1 por default
	 * @ return array del find(all)
	 */
	function dameActivos($recursive = 1)
	{
		$this->recursive = $recursive;
		return $this->find('all',array(
                    'recursive' => -1,
                    'conditions'=>array('Mozo.activo'=>1),
                    'order'=>'Mozo.numero ASC'));
	}
     
	
	
	
	function getNumero($mozo_id = 0){
		if($mozo_id != 0){
			$this->id = $mozo_id;
		}
		$mozo = $this->read();
		return $mozo['Mozo']['numero'];	
	}


    /**
     * Para todos los mozos activos, me trae sus mesas abiertas
     * @param int $mozo_id id del mozo, en caso de que no le pase ninguno, me busca todos
     * @return array Mozos con sus mesas, Comandas, detalleComanda, productos y sabores
     */
    public function mesasAbiertas($mozo_id = null, $lastAccess = null){
            $conditions = array();
            
            // si vino el mozo por parametro, es porque solo quiero las mesas de ese mozo
            if ( !empty($mozo_id) ){
               $conditions['Mozo.id'] =  $mozo_id;
            } else {
                // todos los mozos activos
                $conditions['Mozo.activo'] =  1;
            }
            
            // condiciones para traer mesas abiertas y pendientes de cobro
            if ( Configure::read('Site.type') == SITE_TYPE_HOTEL ) {
                // si es hotel
                $conditionsMesa = array(
                    'Mesa.deleted' => 0,        
                    'Mesa.checkin >' => date('Y-m-d', strtotime('-1 month')),
                );
            } else {
                // es restaurante u otros comercios
                $conditionsMesa = array(
                    "Mesa.estado_id" => array( MESA_ABIERTA, MESA_CERRADA, MESA_COBRADA),
                    'Mesa.deleted' => 0,    
                );
            }
            
            // si vino el parametro lastAccess, traer solo las mesas actualizadas luego del ultimo pedido
            if ( !empty($lastAccess) ) {
                $conditionsMesa['Mesa.modified >='] = $lastAccess;
            }
            
            $contain = $this->Mesa->defaultContain;
            $contain['conditions'] = $conditionsMesa;
            unset($contain[0]);
            $optionsCreated = array(
                'contain' => array('Mesa' => $contain),
                'conditions'=> $conditions,
            );
			$mesasABM = $this->find('all', $optionsCreated);

            $mozosMesa = array();
            foreach ( $mesasABM as $abmMesas ) {
                // traer todos los mozos, con su array de mesas
                $abmMesas['Mozo']['mesas'] = $abmMesas['Mesa'];

                if ( !empty($lastAccess) ) {
                    // enviar solo los que tienen mesas modificadas
                    if (!empty($abmMesas['Mesa']) ) {
                        $mozosMesa['mozos'][] = $abmMesas['Mozo'];    
                    }
                } else {
                    // enviar a todos
                    $mozosMesa['mozos'][] = $abmMesas['Mozo'];    
                }
            }
            

            return $mozosMesa;
        }




     /**
     * Para todos los mozos activos, me trae sus mesas eliminadas entre cada actualizacion de datos
     * @param int $mozo_id id del mozo, en caso de que no le pase ninguno, me busca todos
     * @return array Mozos con sus mesas, Comandas, detalleComanda, productos y sabores
     */
    public function mesasBorradas($mozo_id = null, $lastAccess = null){
            if ( empty($lastAccess) ) {
                return array();
            }


            $conditions = array();
            
            // si vino el mozo por parametro, es porque solo quiero las mesas de ese mozo
            if ( !empty($mozo_id) ){
               $conditions['Mozo.id'] =  $mozo_id;
            } else {
                // todos los mozos activos
                $conditions['Mozo.activo'] =  1;
            }
                       
            
            // traer solo las mesas actualizadas luego del ultimo pedido
            $conditionsMesa = array(
                    'OR' => array (
                        array(
                            'Mesa.deleted' => 1,
                            'Mesa.deleted_date >=' => $lastAccess,
                        ),
                        array(
                            'Mesa.estado_id' => MESA_CHECKOUT,
                            'Mesa.checkout >=' => $lastAccess,
                            )
                        )
                );
            $contain = $this->Mesa->defaultContain;
            $contain['conditions'] = $conditionsMesa;
            unset($contain[0]); // saco al Mozo del contain
            $optionsCreated = array(
                'contain' => array('Mesa' => $contain),
                'conditions'=> $conditions,
            );
            $mesasABM = $this->find('all', $optionsCreated);

            $mozosMesa = array();
            foreach ( $mesasABM as $abmMesas ) {
                // traer todos los mozos, con su array de mesas
                $abmMesas['Mozo']['mesas'] = $abmMesas['Mesa'];

                // enviar solo los que tienen mesas borradas
                if (!empty($abmMesas['Mesa']) ) {
                    $mozosMesa['mozos'][] = $abmMesas['Mozo'];    
                }
            }
            

            return $mozosMesa;
        }
        
        
        
        public function listFullName () {
            return $this->find('list', array(
                'fields'=>array(
                    'Mozo.id',
                    'numero_y_nombre',
                    ),
                'conditions' => array(
                    'Mozo.activo' => 1
                )
                ));
        }

        public function cantidadMozosRegistrados() {
            return $this->find('count');
        }
        

}
