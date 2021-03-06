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
        'Flash',
        'Cookie',
        'RequestHandler',
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

        App::uses('MtSites', 'MtSites./Utility/MtSites');


        // Add header("Access-Control-Allow-Origin: *"); for print client node webkit
        $this->response->header('Access-Control-Allow-Origin', '*');

        $this->__ipBanned();


        return parent::beforeFilter();
        
      }

      public function __ipBanned(){
        $ipBanned = array();
        
        if ( in_array( $this->request->clientIp(), $ipBanned ) ) {
            throw new ForbiddenException(__("La IP fue banneada"));
        }
      }


      public function isAuthorized () {
        return true;
      }



   
}
