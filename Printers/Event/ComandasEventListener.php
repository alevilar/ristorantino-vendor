<?php

App::uses('CakeEventListener', 'Event');
App::uses('Printaitor', 'Printers.Utility');
App::uses('ReceiptPrint', 'Printers.Utility');


/**
 * Nodes Event Handler
 *
 * @category Event
 * @package  Croogo.Nodes.Event
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class ComandasEventListener implements CakeEventListener {

/**
 * implementedEvents
 */
	public function implementedEvents() {
		return array(
			'Model.afterSaveAll' => array(
				'callable' => 'onComandaPrint',
				//'passParams' => true,
			),			
		);
	}


	public function onComandaPrint( $event ) {
		if ($event->subject()->name == 'Comanda') {
			$event->subject()->id;

			$comanda = ClassRegistry::init('Comanda.Comanda')->find('first', array(
					'recursive' => -1,
					'conditions' => array(
						'Comanda.id' => $event->subject()->id
					),
				)
			);
			if ( $comanda && $comanda['Comanda']['impresa']) {
				return ReceiptPrint::comanda( $event->subject() );
			}	
		}	
	}

}