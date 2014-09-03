<?php

App::uses('Component', 'Controller');

class ConfiguratorComponent extends Component {
    public $Config;
     
    public function startup (Controller $controller) {
        die("as a asas");
        $ccc = ClassRegistry::init('Risto.Config')->find('all');

        foreach( $ccc as $c){
            $confName = '';
            if (!empty($c['ConfigCategory']['name'])) {
                $confName = $c['ConfigCategory']['name'].'.';
            }
            $keyName = $confName.$c['Config']['key'];
            Configure::write($keyName, $c['Config']['value']);
        }
    }
}
