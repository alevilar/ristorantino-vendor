<?php
App::uses('ComprasUnidadDeMedida', 'Compras.Model');

/**
 * ComprasUnidadDeMedida Test Case
 */
class ComprasUnidadDeMedidaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.compras.compras_unidad_de_medida'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ComprasUnidadDeMedida = ClassRegistry::init('Compras.ComprasUnidadDeMedida');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ComprasUnidadDeMedida);

		parent::tearDown();
	}

}
