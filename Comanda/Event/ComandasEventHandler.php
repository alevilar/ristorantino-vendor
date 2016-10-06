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
		$this->__cacheUltimaComandaIdXPrinter( $event );
		$this->__updateMesaModified( $event );
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


	/**
	 * 
	 *  Actualiza la mesa como que fue modificada cada 
	 *  vez que se realizo una actualizacion o creacion de una comanda
	 * 
	 **/
	private function __updateMesaModified( $event ){
		$Comanda = $event->subject;
		
		if ( !empty($Comanda->data['Comanda']['mesa_id']) ) {
			$Comanda->Mesa->id = $Comanda->data['Comanda']['mesa_id'];
		} else {
			$Comanda->Mesa->id = $Comanda->field('mesa_id');
		}

		return $Comanda->Mesa->saveField('modified', date('Y-m-d H:i:s'));
	}
}
