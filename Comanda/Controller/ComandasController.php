<?php

App::uses('ComandaAppController', 'Comanda.Controller');
App::uses('ReceiptPrint', 'Printers.Utility');

class ComandasController extends ComandaAppController {

	public $name = 'Comandas';


    public function imprimir( $comanda_id ){
        $this->Comanda->id = $comanda_id;
        ReceiptPrint::comanda( $this->Comanda );
        $this->redirect( $this->referer() );
    }
    
    
	public function add( $mesa_id = null ){
            
            if (isset($this->request->data)) {                
                $this->Comanda->create();
                if ($this->Comanda->save($this->request->data)) {
                    $this->Session->setFlash( __("Comanda Guardada"), 'Risto.flash_success' );
                } else {
                    $this->Session->setFlash(__('The Comanda could not be saved. Please, try again.'), 'Risto.flash_error');
                }
                $this->redirect($this->request->data['Comanda']['redirect']);
            } else {
                $this->request->data['Comanda']['redirect'] = $this->referer();
            }
            $this->set('mesa_id', $mesa_id);                 
	}


    /**
     * 
     * Listado de comandas activas para ser utilizado por el comandero
     * en el restaurante
     * 
     * @param integer $printer_id si no se selecciona ningna impresora trae a todas
     * 
     * 
     **/
    public function comandero( $printer_id = null ){
        $conditions = array(
                'comanda_estado_id !=' => COMANDA_ESTADO_LISTO,
                'comanda_estado_id IS NOT NULL',
                );

        if (!empty($printer_id)) {
            $conditions['printer_id'] = $printer_id;
        }
        $comandas = $this->Comanda->find('all', array(
            'conditions' => $conditions,
            'order' => array('Comanda.created' => 'ASC'),
            'contain' => array(
                'Printer',
                'ComandaEstado',
                'Mesa' => 'Mozo',
                'DetalleComanda' => array(
                    'Producto',
                    'DetalleSabor' => array('Sabor'),
                    ),
                )
            ));

        $printers = $this->Comanda->Printer->find('list');
        $comandaEstados = $this->Comanda->ComandaEstado->find('list');

        $this->set(compact('comandas', 'printers', 'printer_id', 'comandaEstados'));
    }
	

    /**
     *
     *  Pasa una comanda a otro estado
     * 
     *  @param integer $comanda_id ID de la comanda
     *  @param integer $comanda_estado_id ID del estado que quiero modificar
     * 
     **/
    public function comandero_estado_change( $comanda_id, $comanda_estado_id ){
        $this->Comanda->id = $comanda_id;
        $this->Comanda->saveField('comanda_estado_id', $comanda_estado_id);
        $this->redirect( $this->referer() );
    }

	

    public function edit ( $id ) {
        if (!empty($this->request->data)) {
            if ( $this->Comanda->save($this->request->data) ) {
                $this->Session->setFlash('Se guardó correctamente la comanda', 'Risto.flash_success');
            } else {
                $this->Session->setFlash('Error al guardar la comanda', 'Risto.flash_error');
            }
            $this->redirect($this->request->data['Comanda']['redirect']);
        } else {
            $this->request->data = $this->Comanda->read(null, $id);    
            $this->request->data['Comanda']['redirect'] = $this->referer();
        }
        
        $mesas = $this->Comanda->Mesa->find('list', array('conditions'=>array('Mesa.estado_id'=>MESA_ABIERTA)));
        $mesa = $this->request->data['Mesa'];
        $mesas[$mesa['id']] = $mesa['numero'];
        $this->set('mesas', $mesas);
        
    }


    public function delete( $id = null ) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Comanda'), 'Risto.flash_error');            
        }
        if ($this->Comanda->delete($id)) {
            $this->Session->setFlash(__('Comanda deleted'), 'Risto.flash_success');
        } else {
            $this->Session->setFlash(__('No se pudo eliminar la Comanda'), 'Risto.flash_error');
        }
        if ($this->request->is('ajax')) {
            return 1;
        } 
        $this->redirect($this->referer());
    }

}
