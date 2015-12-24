<?php
App::uses('PedidoEstado', 'Compras.Model');

/**
 * PedidoEstado Test Case
 */
class PedidoEstadoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.compras.pedido_estado',
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
		$this->PedidoEstado = ClassRegistry::init('Compras.PedidoEstado');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PedidoEstado);

		parent::tearDown();
	}

}
