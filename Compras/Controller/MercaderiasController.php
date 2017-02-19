<?php
App::uses('ComprasAppController', 'Compras.Controller');
/**
 * Mercaderias Controller
 *
 */
class MercaderiasController extends ComprasAppController {



	public function index() {
		$this->Prg->commonProcess();
        $conds = $this->Mercaderia->parseCriteria( $this->Prg->parsedParams() );
        $this->Mercaderia->recursive = 0;
        $this->Paginator->settings['conditions'] = $conds; 

        $mercaderias = $this->Paginator->paginate();
        foreach ($mercaderias as &$m ) {

            $pendiente = $this->Mercaderia->PedidoMercaderia->find("first", array(
                    'recursive' => -1,
                    'conditions' => array(
                        'PedidoMercaderia.pedido_id IS NULL',
                        'PedidoMercaderia.mercaderia_id' => $m['Mercaderia']['id'],
                    ),
                    'group' => array(
                        'PedidoMercaderia.mercaderia_id',
                        ),
                    'fields' => array(
                        'PedidoMercaderia.mercaderia_id',
                        'count(PedidoMercaderia.mercaderia_id) as cant',
                        'sum(PedidoMercaderia.cantidad) as sum',
                        ),
                ));
            if ($pendiente) {
                $m['Pendiente'] = $pendiente[0];
            }
        }
        $defaultProveedor = $this->Mercaderia->Proveedor->find('list');
        $unidadDeMedidas = $this->Mercaderia->UnidadDeMedida->find('list');
        $this->set(compact('mercaderias', 'defaultProveedores', 'unidadDeMedidas'));
	}

    public function asignar_rubros() {
        if ($this->request->is(array('post', 'put'))) {
            if ( $this->Mercaderia->save($this->request->data) ) {
                $this->Session->setFlash("Se ha guardado correctamente a la mercaderia");
            } else {
                $this->Session->setFlash("Error al guardar la mercaderia", 'Risto.flash_error');
            }
        }

        $this->Prg->commonProcess();
        $conds = $this->Mercaderia->parseCriteria( $this->Prg->parsedParams() );

        $conds[] = 'Mercaderia.rubro_id IS NULL';
        $this->Paginator->settings['conditions'] = $conds; 

        $this->Paginator->settings['limit'] = 1; 


        $mercaderias = $this->Paginator->paginate();
        if ( !empty($mercaderias)) {
            $this->request->data = $mercaderias[0];
        }
        $rubros = $this->Mercaderia->Rubro->find('list');
        $defaultProveedores = $this->Mercaderia->Proveedor->find('list');
        $unidadDeMedidas = $this->Mercaderia->UnidadDeMedida->find('list');
        $this->set(compact('mercaderias', 'defaultProveedores', 'unidadDeMedidas', 'rubros'));
    }

    public function view($id, $name) {
        $this->comprobarExistenciaMercaderia($id);

        $datosmercaderia = $this->Mercaderia->buscarMercaderia($id);
        $mercaderias = $this->Mercaderia->buscarMercaderia(null, $name);
        $rubros = $this->Mercaderia->Rubro->find('list');
        $defaultProveedores = $this->Mercaderia->Proveedor->find('list');
        $this->set(compact('mercaderias', 'defaultProveedores', 'unidadDeMedidas','id', 'datosmercaderia'));
    }


	public function add() {
		if ($this->request->is(array('put','post'))){
			if ( $this->Mercaderia->save($this->request->data) ) {
				$this->Session->setFlash('Se ha guardado correctamente');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Error al guardar', 'error');
			}
		}

		$rubros = $this->Mercaderia->Rubro->find('list');
        $defaultProveedores = $this->Mercaderia->Proveedor->find('list');
        $unidadDeMedidas = $this->Mercaderia->UnidadDeMedida->find('list');    
        $this->set(compact('defaultProveedores', 'unidadDeMedidas', 'rubros'));
	}



	public function edit( $id ) {
		if ($this->request->is(array('put','post'))){
			if ( $this->Mercaderia->save($this->request->data) ) {
				$this->Session->setFlash('Se ha guardado correctamente');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash('Error al guardar', 'error');
			}
		}

        $this->Mercaderia->id = $id;
		$this->request->data = $this->Mercaderia->read();

        $defaultProveedores = $this->Mercaderia->Proveedor->find('list');
        $rubros = $this->Mercaderia->Rubro->find('list');
        $unidadDeMedidas = $this->Mercaderia->UnidadDeMedida->find('list');
        $this->set(compact('mercaderias', 'defaultProveedores', 'unidadDeMedidas', 'rubros'));
        $this->set('_serialize', array('mercaderias'));
        $this->render('add');
	}


	 public function delete( $id = null ) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Comanda'), 'Risto.flash_error');            
        }
        if ($this->Mercaderia->delete($id)) {
            $this->Session->setFlash(__('Mercaderia deleted'), 'Risto.flash_success');
        } else {
            $this->Session->setFlash(__('No se pudo eliminar la Mercaderia'), 'Risto.flash_error');
        }
        if ($this->request->is('ajax')) {
            return 1;
        } 
        $this->redirect($this->referer());
    }

    public function comprobarExistenciaMercaderia($id) {
        if (!$this->Mercaderia->exists($id)) {
            $this->Session->setFlash(__('Invalid id for Mercaderia'), 'Risto.flash_error');
            $this->redirect(array('action' => 'index'));            
        } 

    }


    public function verDuplicados($id, $name) {

        $this->comprobarExistenciaMercaderia($id);

        $this->Mercaderia->recursive = 0;

        $datosmercaderia = $this->Mercaderia->buscarMercaderia($id);

        $mercaderias = $this->Mercaderia->buscarMercaderia(null, $name);

        $this->set(compact('mercaderias', 'defaultProveedores', 'unidadDeMedidas','id', 'datosmercaderia'));

    }

    public function unificarMercaderia($id, $name) {

        $this->comprobarExistenciaMercaderia($id);

        $mercaderias = $this->Mercaderia->buscarMercaderia(null, $name);
        
        foreach ($mercaderias as $m) {

        if ($m['Mercaderia']['id'] != $id) {  

        $id_mercaderia = $m['Mercaderia']['id'];  
        if ($this->Mercaderia->unificarMercaderia($id_mercaderia, $name, $id) == true) {
            $this->Session->setFlash(__('¡Mercadería unificada con exito!'), 'Risto.flash_success');
        } else {
            $this->Session->setFlash(__('Problemas al unificar la mercadería, intentelo nuevamente.'), 'Risto.flash_error');
        }

           }
       }


        $this->redirect(array('action' => 'index'));

    }
	


}
