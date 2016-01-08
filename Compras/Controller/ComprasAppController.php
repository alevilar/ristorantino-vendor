<?php

App::uses('AppController', 'Controller');

class ComprasAppController extends AppController {
	function beforeFilter() {
        parent::beforeFilter();
        
        $this->set('elementMenu', 'menu');
	      
    }
}
