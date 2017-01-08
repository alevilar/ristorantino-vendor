<?php
App::uses('WsPaxaposConnect', 'Risto.Utility/WsPaxaposConnect');

/**
 * ComandaEstado Test Case
 */
class WsPaxaposConnectTest extends CakeTestCase {


/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.risto.mesa',
	);

/**
 * tearDown method
 *
 * @return void
 */
	public function testFuncion() {
		//WsPaxaposConnect

		WsPaxaposConnect::sendMesa(1);

	}

}
