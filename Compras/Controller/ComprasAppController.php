<?php

App::uses('AppController', 'Controller');

class ComprasAppController extends AppController {

	public $layout = 'Compras.default';

	
	function beforeFilter() {
        parent::beforeFilter();
        
        $this->set('elementMenu', 'menu');
	      
    }
}
