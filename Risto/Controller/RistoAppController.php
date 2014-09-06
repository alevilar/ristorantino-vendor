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

    public $helpers = array(
        'Html' => array(
            'className' => 'Bs3Html'
            ),
        'Form' => array(
            'className' => 'PxForm'
            ),
        'Session',
        'Paginator',
        'Number',
    );

    public $components = array(
        'Auth' => array(
            'loginAction' => array('plugin'=>'users','controller' => 'users', 'action' => 'login'),
            'logoutRedirect' => array('plugin'=>'users','controller' => 'users', 'action' => 'login'),
            'loginError' => 'Usuario o Contraseña Incorrectos',
            'authError' => 'Usted no tiene permisos para acceder a esta página.',   
        ),
        'Acl',
        'Paginator',      
        'RequestHandler',
        'Session',
        'Cookie',
        'Search.Prg' => array(
            'presetForm' => array(
                'paramType' => 'querystring'
                )
            ),
        
        'DebugKit.Toolbar',        
    );

    public function beforeFilter()
     {

        if ( Configure::read('Site.multiTenant') ) {
            $this->Auth->authorize = array('MtSites.MtSites');
        }

        parent::beforeFilter();     


        // Add header("Access-Control-Allow-Origin: *"); for print client node webkit
        $this->response->header('Access-Control-Allow-Origin', '*');


        return true;
        
      }
   
}
