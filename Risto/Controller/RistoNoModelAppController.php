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

App::uses('RistoAppController', 'Risto.Controller');

/**
 * Class RistoAppController
 *
 * @since         DebugKit 0.1
 */
class RistoNoModelAppController extends Controller {


    public $uses = false;


    public $layout = 'Risto.default';


    public $helpers = array(
        'Html' => array(
            'className' => 'Bs3Helpers.Bs3Html'
            ),
        'Form' => array(
            'className' => 'Bs3Helpers.Bs3Form'
            ),
        'Session',
        'Number',
        'Time',
        'Text'
    );

    public $components = array(
        'Session',
        'Cookie',
        'RequestHandler',
        'MtSites.MtSites',
        'Auth' => array(
            'className' => 'Risto.RistoAuth',
            'loginError' => 'Usuario o Contraseña Incorrectos',
            'authError' => 'Usted no tiene permisos para acceder a esta página.', 
            'authorize' => array('Controller','MtSites.MtSites'),
            'authenticate' => array(
                'Risto.Pin',
                'Form' => array(
                    'contain' => array('Site'),
                    'recursive' => 1,
                    'fields' => array(
                        'username' => 'email',
                        'password' => 'password'),
                    'userModel' => 'Users.User',
                    'scope' => array(
                        'User.active' => 1,
                        // $this->modelClass . '.email_verified' => 1
                    )
                ),
            ),        
            'flash' => array('element'=>'Risto.flash_error'),
        ),
        
        'ExtAuth.ExtAuth',
        'DebugKit.Toolbar',        
    );



    public function beforeFilter()
     {    

       

        parent::beforeFilter();
        // Add header("Access-Control-Allow-Origin: *"); for print client node webkit
        $this->response->header('Access-Control-Allow-Origin', '*');
        return true;
        
      }

      public function isAuthorized () {
        return true;
      }
   
}
