<?php
App::uses('MercaderiasProveedor', 'Compras.Model');

/**
 * MercaderiasProveedor Test Case
 */
class MercaderiasProveedorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.compras.mercaderias_proveedor',
		'plugin.compras.mercaderia',
		'plugin.compras.proveedor'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MercaderiasProveedor = ClassRegistry::init('Compras.MercaderiasProveedor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MercaderiasProveedor);

		parent::tearDown();
	}

}
