<?php 
class StatsAppController extends AppController {
    

    
    
    function beforeFilter() {
        parent::beforeFilter();
        
        $this->set('elementMenu', 'menu');

    }
 
}

