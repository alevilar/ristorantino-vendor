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
class RistoNoModelAppController extends RistoAppController {


    public $uses = false;


    public $components = array(
        'Session',
        'Cookie',
        'RequestHandler',
        'MtSites.MtSites',
        'Auth' => array(
            'loginAction' => array('plugin'=>'users','controller' => 'users', 'action' => 'login'),
            'logoutRedirect' => array('plugin'=>'users','controller' => 'users', 'action' => 'login'),
            'loginError' => 'Usuario o Contraseña Incorrectos',
            'authError' => 'Usted no tiene permisos para acceder a esta página.', 
            'authorize' => array('MtSites.MtSites'),
            'authenticate' => array(
                'Form' => array(
                    'recursive' => 1
                )
            ),        
        ),
        'ExtAuth.ExtAuth',
        
        'DebugKit.Toolbar',        
    );

   
}
