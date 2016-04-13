<?php
App::uses('CakeEventListener', 'Event');
App::uses('Cache', 'Cache');
App::uses('Persona', 'Afigestion.Model');
/**
 * Nodes Event Handler
 *
 * @category Event
 * @package  Croogo.Nodes.Event
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class ComandasEventHandler implements CakeEventListener {
/**
 * implementedEvents
 */
	public function implementedEvents() {
		return array(
			'Model.afterSave' => array(
				'callable' => 'onAfterSave',
			),
		);
	}
	public function onAfterSave ($event) {
		if ( $event->data[0] == true && !empty( $event->subject->data['Comanda'] )) {			
			$printerId = $event->subject->data['Comanda']['printer_id'];
	 		Cache::write("Comandero.ultima_comanda_id.$printerId",$event->subject->id);
		}
	}
}
