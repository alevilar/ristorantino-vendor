<?php
App::uses('ComandaEstado', 'Risto.Model');

/**
 * ComandaEstado Test Case
 */
class ComandaEstadoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.risto.comanda_estado',
		'plugin.risto.comanda'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ComandaEstado = ClassRegistry::init('Risto.ComandaEstado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ComandaEstado);

		parent::tearDown();
	}

}
