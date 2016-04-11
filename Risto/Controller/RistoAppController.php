<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         DebugKit 0.1
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Class RistoAppController
 *
 * @since         DebugKit 0.1
 */
class RistoAppController extends Controller {

    public $layout = 'Risto.default';

    public $elementMenu = 'menu';
    

    public $helpers = array(
        'Html' => array(
            'className' => 'Risto.PxHtml'
            ),
        'Form' => array(
            'className' => 'Risto.PxForm'
            ),
        'Session',
        'Paginator',
        'Number',
        'Time',
        'Text',
    );

    public $components = array(
        'Session',
        'Cookie',
        'RequestHandler',
        'Auth' => array(
            'loginAction' => array('plugin'=>'users', 'controller' => 'users', 'action' => 'login', 'admin' => false ),
            'logoutRedirect' => array('plugin'=>'users','controller' => 'users', 'action' => 'login'),
            'loginError' => 'Usuario o Contraseña Incorrectos',
            'authError' => 'Usted no tiene permisos para acceder a esta página.', 
            'authorize' => array('Controller','MtSites.MtSites'),
            'authenticate' => array(
                'Form' => array(
                    'recursive' => 1,
                    'contain' => array('Site')
                )
            ),        
            'flash' => array('element'=>'Risto.flash_error'),
        ),
        'ExtAuth.ExtAuth',
        'MtSites.MtSites',
        'Paginator',      
        'Search.Prg' => array(
            'callback' => 'startup',
            'commonProcess' => array(
                'formName' => null,
                'keepPassed' => true,
                'action' => null,
                'modelMethod' => 'validateSearch',
                'allowedParams' => array(),
                'paramType' => 'querystring',
                'filterEmpty' => false
            ),
            'presetForm' => array(
                'model' => null,
                'paramType' => 'querystring'
            ),
        ),
        'DebugKit.Toolbar',        
    );

    public function beforeRender() {
        $this->set('elementMenu', $this->elementMenu);
    }

    public function beforeFilter()
     {            
        // Add header("Access-Control-Allow-Origin: *"); for print client node webkit
        $this->response->header('Access-Control-Allow-Origin', '*');


        $this->Auth->allow(array('auth_callback', 'auth_login'));

        $this->Auth->loginAction = array(
                'plugin' => 'users',
                'controller' => 'users',
                'action' => 'login', 
                'admin' => false, 
                );

        return parent::beforeFilter();
        
      }


      public function isAuthorized () {
        return true;
      }



   
}
