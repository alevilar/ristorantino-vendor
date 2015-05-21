<?php
/**
 * AppShell file
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
 * @since         CakePHP(tm) v 2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Shell', 'Console');
App::uses('AppModel', 'Model');

/**
 * Application Shell
 *
 * Add your application-wide methods in the class below, your shells
 * will inherit them.
 *
 * @package       app.Console.Command
 */
class RistoShell extends Shell {

	public $datasource = 'paxacarilo';

	public function main () {
		$this->out("aaasas");
		$this->__loadOldModels();
	}



	private function __loadOldModels () {
		$this->Egreso = new AppModel(array(
                'table' => 'account_egresos',
                'ds' => $this->datasource,
                'name' => 'Egreso',
                'alias' => 'Egreso',
                'primaryKey' => 'id',
                'hasMany' => array(
                    'InvoiceDetail' => array(
                        'foreignKey' => 'SOPNUMBE',
                        'counterCache' => false
                ))));

		$cant = $this->Egreso->find('count');

		$this->out("la cantidad es $cant");
	}
}
