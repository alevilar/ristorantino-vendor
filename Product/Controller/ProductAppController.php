<?php

App::uses('AppController', 'Controller');

class ProductAppController extends AppController {

	public $layout = 'Risto.administracion';

	
    public function beforeFilter()
    {
        parent::beforeFilter();
            $this->set('elementMenu', 'menu');
    }
}
