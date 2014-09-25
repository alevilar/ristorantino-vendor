<?php 


App::uses('AditionsAppController', 'Aditions.Controller');



class AditionsController extends AditionsAppController {
    
	public $uses = array('Mesa.Mozo','Mesa.Mesa','Product.Categoria');
	public $current_mozo_id;
	public $current_mesa_id;
	public $current_mesa_numero;
	public $layout = 'adicion';


	function home()
        {
            $this->set('mozos',$this->Mozo->dameActivos());
	}

	
	
	/**
	 * 
	 * esta es la accion para que adicione la adicion
	 * la diferencia aca es que se van amostrar todas las mesas abiertas independientemente del mozo
	 * @return unknown_type
	 */
	function adicionar()
        {
        	$this->set('categorias', $this->Categoria->array_listado());
            $this->set('tipo_de_pagos', $this->Mozo->Mesa->Pago->TipoDePago->find('all'));
            $this->set('mesas', $this->Mozo->mesasAbiertas());
            $this->set('mozos', $this->Mozo->dameActivos());
            $this->set('observaciones', ClassRegistry::init('Comanda.Observacion')->find('list', array('order' => 'Observacion.name')));
            $this->set('observacionesComanda', ClassRegistry::init('Comanda.ObservacionComanda')->find('list', array('order' => 'ObservacionComanda.name')));
	}
    

	
}