<?php
/**
 * Debug Kit App Model
 *
 * PHP 5
 *
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
 **/

App::uses('Model', 'Model');

/**
 * Class RistoAppModel
 *
 * @since         RistoAppModel
 */
class RistoAppModel extends Model {

	public $actsAs = array( 'Containable', 'Search.Searchable');

//	public $filterArgs = array();

	public function saveAll ( $data = array(), $options = array() ) {
	    $return = parent::saveAll($data, $options);

	    $event = new CakeEvent('Model.afterSaveAll', $this );
        $this->getEventManager()->dispatch($event);

	    return $return;
	}

}
