<?php 
class StatsAppController extends AppController {
    

    public $layout = 'Stats.default';
    
    function beforeFilter() {
        parent::beforeFilter();
        
        $this->set('elementMenu', 'menu');

    }
 
}

