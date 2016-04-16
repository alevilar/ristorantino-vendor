<?php
/**
 * Authentication component
 *
 * Manages user logins and permissions.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Controller.Component
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AuthComponent', 'Controller/Component');


/**
 * Authentication control component class
 *
 * Binds access control with user authentication and session management.
 *
 * @package       Cake.Controller.Component
 * @link http://book.cakephp.org/2.0/en/core-libraries/components/authentication.html
 */
class RistoAuthComponent extends AuthComponent {




/**
 * Al contrario que el isAuthorized que viene en CakePhp
 * este se fija si algun Adapter retorna false, y entonces retorna false.
 * 
 * el orioginal de Cake hace al reves: con que venga un true. ya le da acceso 
 * a todos
 *
 * @param array|null $user The user to check the authorization of. If empty the user in the session will be used.
 * @param CakeRequest|null $request The request to authenticate for. If empty, the current request will be used.
 * @return bool True if $user is authorized, otherwise false
 */
	public function isAuthorized($user = null, CakeRequest $request = null) {
		if (empty($user) && !$this->user()) {
			return false;
		}
		if (empty($user)) {
			$user = $this->user();
		}
		if (empty($request)) {
			$request = $this->request;
		}
		if (empty($this->_authorizeObjects)) {
			$this->constructAuthorize();
		}
		foreach ($this->_authorizeObjects as $authorizer) {
			if ($authorizer->authorize($user, $request) === false) {
				return false;
			}
		}
		return true;
	}
}