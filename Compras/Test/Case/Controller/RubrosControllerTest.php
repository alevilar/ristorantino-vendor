<?php
App::uses('RubrosController', 'Compras.Controller');

/**
 * RubrosController Test Case
 */
class RubrosControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.compras.rubro',
		'plugin.compras.proveedor',
		'plugin.compras.gasto',
		'plugin.compras.clasificacion',
		'plugin.compras.tipo_factura',
		'plugin.compras.iva_responsabilidad',
		'plugin.compras.cierre',
		'plugin.compras.media',
		'plugin.compras.impuesto',
		'plugin.compras.tipo_impuesto',
		'plugin.compras.account_impuesto',
		'plugin.compras.egreso',
		'plugin.compras.tipo_de_pago',
		'plugin.compras.account_egresos_gasto',
		'plugin.compras.compras_proveedores_rubro'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$this->markTestIncomplete('testIndex not implemented.');
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$this->markTestIncomplete('testView not implemented.');
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$this->markTestIncomplete('testAdd not implemented.');
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$this->markTestIncomplete('testEdit not implemented.');
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
		$this->markTestIncomplete('testDelete not implemented.');
	}

}
