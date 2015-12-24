<?php
App::uses('Pedido', 'Compras.Model');

/**
 * Pedido Test Case
 */
class PedidoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.compras.pedido',
		'plugin.compras.compras_pedido_mercaderia',
		'plugin.compras.pedido_mercaderia'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Pedido = ClassRegistry::init('Compras.Pedido');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pedido);

		parent::tearDown();
	}

}
