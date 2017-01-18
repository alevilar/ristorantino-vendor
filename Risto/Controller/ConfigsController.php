<?php

App::uses('AppController', 'Controller');


class ConfigsController extends AppController {

	public $name = 'Configs';


	public $scaffold;

    public function beforeFilter() {
        $this->Config->recursive = 1;
    }


    /**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Config->recursive = 0;
        $this->set('configs', $this->Paginator->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->Config->exists($id)) {
            throw new NotFoundException(__('Invalid config'));
        }
        $options = array('conditions' => array('Config.' . $this->Config->primaryKey => $id));
        $this->set('config', $this->Config->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->Config->create();
            if ($this->Config->save($this->request->data)) {
                $this->Flash->success(__('The config has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The config could not be saved. Please, try again.'));
            }
        }
        $configCategoryes = $this->Config->ConfigCategory->find('list');
        $this->set(compact('configCategoryes'));
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->Config->exists($id)) {
            throw new NotFoundException(__('Invalid config'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Config->save($this->request->data)) {
                $this->Flash->success(__('The config has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The config could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Config.' . $this->Config->primaryKey => $id));
            $this->request->data = $this->Config->find('first', $options);
        }
        $configCategoryes = $this->Config->ConfigCategory->find('list');
        $this->set(compact('configCategoryes'));
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->Config->id = $id;
        if (!$this->Config->exists()) {
            throw new NotFoundException(__('Invalid config'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Config->delete()) {
            $this->Flash->success(__('The config has been deleted.'));
        } else {
            $this->Flash->error(__('The config could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
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
            } else {
                $this->Session->setFlash(__("Configuración guardada con éxito")); 
            }
        }
        $configsId = array(2, 9, 10, 17, 22,  25, 26, 28, 31);
        unset($this->request->data);
        $this->request->data = $this->Config->find('all', array('conditions'=> array('id IN'=> $configsId), 'recursive'=>-1));
    }
}
