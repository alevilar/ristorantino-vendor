<?php


App::uses('MesaAppController', 'Mesa.Controller');

class MozosController extends MesaAppController {

    public $paginate = array(
        'limit' => 40,
        'order' => array(
            'Mozo.activo' => 'desc',
            'Mozo.numero' => 'asc',
        )
    );
    

    public function beforeFilter() {
        parent::beforeFilter();
    }
        
	function index() {
		$this->Prg->commonProcess();
        $conds = $this->Mozo->parseCriteria( $this->Prg->parsedParams() );

        $cantidadmozos = $this->Mozo->cantidadMozosRegistrados();

        $this->Paginator->settings = array(
        		'recursive' => 0,
        		'order' => array(
					'Mozo.activo'=> 'DESC', 
					'Mozo.alias'=> 'ASC', 
					'Mozo.name' => 'ASC'
				),
        		'conditions' => $conds,
        	);

		$this->set('mozos', $this->Paginator->paginate());
		$this->set(compact('cantidadmozos'));
	}

	public function view($id = null) {
		$this->redirect(array('action'=>'edit', $id));
	}




	public function edit_activo($id = null) {		
		$this->Mozo->id = $id;
		if (!$this->Mozo->exists()) {
			throw new NotFoundException(__('Invalid mozo'));
		}

		if ($this->request->is( array('put', 'post')) && isset($this->request->data['Mozo']['activo']) ) {
			if ( $this->Mozo->saveField('activo', $this->request->data['Mozo']['activo']) ) {
				$this->Session->setFlash(__("Se ha modificado el estado correctamente"));
			} else {
				$this->Session->setFlash(__("Error al modificar el estado"), 'Risto.flash_error');
			}
		}
		$this->redirect(array('controller'=>'mozos','action' => 'index'));

	}



	public function add_first_time() {
		$this->layout = 'Install.default';
		$this->index();		
	}

        
                
	public function edit($id = null) {
		if ( !is_null($id) ) {
			$this->Mozo->id = $id;
			if (!$this->Mozo->exists()) {
				throw new NotFoundException(__('Invalid mozo'));
			}
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Mozo->save($this->request->data)) {
				$this->Session->setFlash(__('%s guardado correctamente',  Configure::read('Mesa.tituloMozo')), 'Risto.flash_success');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The %s could not be saved. Please, try again.',  Configure::read('Mesa.tituloMozo') ),'Risto.flash_error');
			}
		}

		$this->request->data = $this->Mozo->read(null, $id);
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for %s',  Configure::read('Mesa.tituloMozo')));
			$this->redirect(array('action'=>'index'),'Risto.flash_error');
		}
		$this->Mozo->delete($id);
		$this->redirect($this->referer());
	}

        /**
         * Me devuelve las mesas abiertas de cada mozo
         * @param boolean $microtime microtime desde donde yo quiero tomar omo referencia a la hora de traer las mesas
         */
        public function mesas_abiertas( $microtime = 0 ) {
            
            $lastAccess = null;
            $type = 'created';
            if ( $microtime != 0 ) {
            	$type = 'modified';
                $lastAccess = $this->Session->read('lastAccess');


                // setear el nuevo lastAccess
                $nowTime = date('Y-m-d H:i:s', strtotime('now'));
                $this->Session->write('lastAccess', $nowTime );

                // ver las borradas o con checkout
	            $borradas = $this->Mozo->mesasBorradas( null, $lastAccess);
	            if ( !empty($borradas) ) {
		            $mesas['borradas'] = $borradas;
	            }
            }

            $mesas[$type] = $this->Mozo->mesasAbiertas( null, $lastAccess);

            

            
            $this->set('mesasLastUpdatedTime', 1 );
            $this->set('modified', $lastAccess );
            $this->set('mesas', $mesas );
            
        }

}
