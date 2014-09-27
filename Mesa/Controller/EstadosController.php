<?php

App::uses('MesaAppController', 'Mesa.Controller');


class EstadosController extends MesaAppController 
{

	public $name = 'Estados';

	public $scaffold;
	

   


	public function add() {
	  if ( $this->request->is('post') ) {
	  	 $this->Estado->create();
	   	if ( $this->Estado->save($this->request->data ) ) {
	   		$this->Session->setFlash(__('Nuevo estado "'. $this->request->data['Estado']['name'] .'" guardado'));
   			$this->redirect(array('action'=>'index'));
	   	} else {
	   		$this->Session->setFlash(__('No se pudo guardar el estado.'), 'flash_error');
	   	}
	  }	
	  $this->render('form');
	}



	  public function edit($id = null) {
	    if ( $this->request->is('post') || $this->request->is('put')) {
		   	if ( $this->Estado->save($this->request->data ) ) {
		   		$this->Session->setFlash(__('Nuevo estado "'. $this->request->data['Estado']['name'] .'" guardado'));
	   			$this->redirect(array('action'=>'index'));
		   	} else {
		   		$this->Session->setFlash(__('No se pudo guardar el estado.'), 'flash_error');
		   	}
		  }
		  $this->request->data = $this->Estado->read(null,$id);
		  $this->render('form');
	  }

	  public function delete($id = null) {
	    if (!$id) {
	       $this->Session->setFlash(__('Invalid id for Estado'));
	       $this->redirect(array('action'=>'index'));
	   }
	   if ($this->Estado->delete($id)) {
	       $this->Session->setFlash(__('Estado deleted'));
	       $this->redirect(array('action'=>'index'));
	   }
	  }

}
?>