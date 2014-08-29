<?php

App::uses('AppController', 'Controller');


class ConfigsController extends AppController {

	public $name = 'Configs';


	public $scaffold;

    public function beforeFilter() {
        $this->Config->recursive = 1;
    }

    public function beforeRender() {        
        $this->set('scaffoldFields', array(
                'config_category_id',
                'key',
                'value',
                'description',
            ));
    }
        
        
    public function toggle_remito() {
            $par = array(                
                'ConfigCategory.name' => 'Mesa', 
                'Config.key' => 'imprimePrimeroRemito',
            );
            $conf = $this->Config->find('first', array(
                'conditions' => $par,
            ));
            
            $conf['Config']['value'] = !$conf['Config']['value'];
            $this->Config->save($conf);
            
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                return $conf['Config']['value'];
            }
        }


    public function basic_configuration () {
        if ( $this->request->is('post')){
            if ( !$this->Config->saveAll( $this->request->data ) ) {
                $this->Session->setFlash(__("Error al guardar"), 'Risto.flash_error');
                debug($this->Config->validationErrors);
                break;
            } else {
                $this->Session->setFlash(__("Configuración guardada con éxito")); 
            }
        }
        $configsId = array(2, 9, 10, 17, 22,  25, 26, 28, 31);
        unset($this->request->data);
        $this->request->data = $this->Config->find('all', array('conditions'=> array('id IN'=> $configsId), 'recursive'=>-1));
    }
}
?>