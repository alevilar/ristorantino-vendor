<?php
App::uses('MtSites', 'MtSites.Utility');

/**
 * Afip Web Services exception - usado para recibir errores de la afip
 *
 * @package       Cake.Error
 */
class AfipWsException extends CakeException {

	protected $_messageTemplate = 'Error del WS Afip: %s';

//@codingStandardsIgnoreStart
	public function __construct($message, $code = 404) {
		// tratamiento si es un objeto
		if ( is_object( $message ) {
				return parent::__construct( $message->Msg, $message->Code);
		}

		// tratamiento si es un array
		if ( is_array( $message ) {
			$errors = $message;
			$messages = array();
			foreach ( $errors as $e ) {
				$messages[] = $e->Msg;
				$code = $e->Code;
			}
			$messages = implode (', ',$messages);
		}

		// tratamiento string
		if ( is_string($message)) {
			parent::__construct( "ERROR AFIP (sitio: " . MtSites::getSiteName() . ") ". $message, $code);
		}
	}
//@codingStandardsIgnoreEnd

}