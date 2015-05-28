<?php

App::uses('MesaAppController', 'Mesa.Controller');


class PagosController extends MesaAppController 
{

	public $name = 'Pagos';
	

   public function index() {
    $this->Prg->commonProcess();
    $conds = $this->Pago->parseCriteria( $this->Prg->parsedParams() );



    $this->Pago->recursive = 0;
    $this->Paginator->settings = array(
        'contain' => array(
            'Mesa.Mozo',
            'TipoDePago'
            ),
        'conditions' => $conds,
        'order' => 'Pago.created DESC'
        );

    $tipo_de_pagos = $this->Pago->TipoDePago->find('list');        
    $mozos = $this->Pago->Mesa->Mozo->listFullName();
    $pagos = $this->paginate();
    $this->set(compact('tipo_de_pagos', 'mozos', 'pagos'));
}

public function view($id = null) {
  if (!$id) {
     $this->Session->setFlash(__('Invalid Pago.'));
     $this->redirect(array('action'=>'index'));
 }
 $this->set('pago', $this->Pago->read(null, $id));
}


public function addForMesa ( $mesa_id ) {
  if (!$this->Pago->Mesa->exists( $mesa_id ) ) {
      throw new NotFoundException(__('Invalid %s', Configure::read('Mesa.tituloMesa')));
  }

  if ($this->request->is('post') || $this->request->is('put')) {
      $this->Pago->create();
      if ($this->Pago->save($this->request->data)) {
        $this->Session->setFlash(__('The Pago has been saved.'));
        $this->redirect( $this->request->data['Pago']['redirect'] );
      } else {
        debug($this->Pago->validationErrors);
        $this->Session->setFlash(__('The Pago could not be saved. Please, try again.'),'Risto.flash_error');
      }
  } else {
    // completar valores para formulario
    $this->request->data['Pago']['redirect'] = $this->referer();
    $this->request->data['Pago']['mesa_id'] = $mesa_id;
    $this->request->data['Pago']['valor'] = $this->Pago->Mesa->field('total', array( 'Mesa.id' => $mesa_id));
    $this->request->data['Pago']['created'] = date('Y-m-d H:i');
  }
  $this->set('mesaId', $mesa_id);
  $this->set('tipo_de_pagos', $this->Pago->TipoDePago->find('list'));
}



public function add() {
  if ( $this->request->is('post') || $this->request->is('put') ) {
    
    $mesa = $this->request->data['Mesa'];    
    $mesa['time_cobro'] = date( "Y-m-d H:i:s", strtotime('now'));
    $importeMesa = $this->Pago->Mesa->calcular_total($mesa['id']);

    if ( !empty( $this->request->data['Pago'] ) ) {
      if ( count($this->request->data['Pago']) == 1 && empty($this->request->data['Pago'][0]['valor']) ) {
            // si vino 1 solo pago y sin valor, le agrego el valor total de la
            $this->request->data['Pago'][0]['valor'] = $importeMesa;
      }

      $sumaPagos = 0;    
      foreach ( $this->request->data['Pago'] as $key=>$pago ) {
          if ( !array_key_exists('valor', $pago ) || empty($pago['valor']) ) {
              unset($this->request->data['Pago'][$key]);
          } else {
              $sumaPagos += $pago['valor'];
          }
      }

      if ( $sumaPagos > $importeMesa ) {
          // Hay que restar el cambio o vuelto
          $vuelto =  $sumaPagos - $importeMesa;
          // al primer pago en efectivo que encuentro le resto el Vuelto, para que me quede correcto el pago
          foreach ( $this->request->data['Pago'] as $key=>$pago ) {
              if ( $this->request->data['Pago'][$key]['tipo_de_pago_id'] == TIPO_DE_PAGO_EFECTIVO ) {
                $this->request->data['Pago'][$key]['valor'] -= $vuelto;
                if ( $this->request->data['Pago'][$key]['valor'] == 0 ) {
                  // si da cero borrarlo porque no tiene sentido guardarlo
                  unset($this->request->data['Pago'][$key]);
                }
                break;
              }
          }
      }

      if ($sumaPagos >= $importeMesa) {
        // si se pago la totalidad de la mesa
        $mesa['estado_id'] = MESA_COBRADA;
      }

      $newPagos = array(
        'Mesa' => $mesa,
        'Pago' => $this->request->data['Pago'],
        );

      if ( $this->Pago->Mesa->saveAll( $newPagos ) ) {
          $this->Session->setFlash(__('The Pago has been saved'));
      } else {
          $this->Session->setFlash(__('The Pago could not be saved. Please, try again.'), 'Risto.flash_error');
      }
    }
  }
  if (!$this->request->is('ajax')) {
      $this->redirect($this->referer());
  } else {
      exit;
  }
}



  public function edit($id = null) {
    if (!$id && empty($this->request->data)) {
       $this->Session->setFlash(__('Invalid Pago'));
       $this->redirect(array('action'=>'index'));
    }
    if (!empty($this->request->data)) {
       if ($this->Pago->save($this->request->data)) {
          $this->Session->setFlash(__('The Pago has been saved'));
          $this->redirect(array('action'=>'index'));
      } else {
          $this->Session->setFlash(__('The Pago could not be saved. Please, try again.'));
      }
    }
    if (empty($this->request->data)) {
      $this->request->data = $this->Pago->read(null, $id);
    }
    $mesa = $this->Pago->Mesa->read(null, $this->request->data['Pago']['mesa_id']);
    $tipoDePagos = $this->Pago->TipoDePago->find('list');
    $this->set(compact('mesa','tipoDePagos'));
  }

  public function delete($id = null) {
    if (!$id) {
       $this->Session->setFlash(__('Invalid id for Pago'));
       $this->redirect( $this->referer() );
   }
   if ($this->Pago->delete($id)) {
       $this->Session->setFlash(__('Pago deleted'));
       $this->redirect($this->referer());
   }
  }

}
?>