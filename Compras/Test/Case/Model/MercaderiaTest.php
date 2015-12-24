<?php
App::uses('Mercaderia', 'Compras.Model');

/**
 * Mercaderia Test Case
 */
class MercaderiaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.compras.mercaderia'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mercaderia = ClassRegistry::init('Compras.Mercaderia');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mercaderia);

		parent::tearDown();
	}

}
