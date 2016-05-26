<?php

App::uses('AppController', 'Controller');

class FidelizationAppController extends AppController {

	public function beforeFilter()
    {
        parent::beforeFilter();
        $this->set('elementMenu', 'menu');
    }
}
