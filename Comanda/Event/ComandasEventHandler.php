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
			)
		);
	}


	public function onAfterSave ($event) {
		$this->__cacheUltimaComandaIdXPrinter( $event );
	}


	private function __cacheUltimaComandaIdXPrinter ( $event ) {
		if ( !empty( $event->subject->data['Comanda'] )) {
			$time = time();		
	 		Cache::write("Comandero.ultima_comanda_id", $time);
			$printerId = $event->subject->field('printer_id');
			if ( $printerId ) {
	 			Cache::write("Comandero.ultima_comanda_id.$printerId", $time);
			}
		}
	}



}
