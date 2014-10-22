<?php

App::uses('AppController', 'Controller');

class ProductAppController extends AppController {
    public function beforeFilter()
    {
        parent::beforeFilter();
            $this->set('elementMenu', 'menu');
    }
}
