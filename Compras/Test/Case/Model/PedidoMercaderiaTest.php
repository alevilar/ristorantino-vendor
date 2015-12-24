<?php
App::uses('PedidoMercaderia', 'Compras.Model');

/**
 * PedidoMercaderia Test Case
 */
class PedidoMercaderiaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.compras.pedido_mercaderia',
		'plugin.compras.pedido',
		'plugin.compras.pedido_estado',
		'plugin.compras.medida_unidad'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PedidoMercaderia = ClassRegistry::init('Compras.PedidoMercaderia');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PedidoMercaderia);

		parent::tearDown();
	}

}
