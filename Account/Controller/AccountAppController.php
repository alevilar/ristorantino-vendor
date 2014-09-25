<?php
App::uses('AppController', 'Controller');

class AccountAppController extends AppController
{

    
    function beforeFilter() {
        parent::beforeFilter();
        
        $this->set('elementMenu', 'menu');
      
    }

}

?>
