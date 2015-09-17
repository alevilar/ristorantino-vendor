<?php
App::uses('GrupoSabor', 'Product.Model');

/**
 * GrupoSabor Test Case
 *
 */
class GrupoSaborTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.product.grupo_sabor',
		'plugin.product.sabor',
		'plugin.product.categoria',
		'plugin.product.media',
		'plugin.product.producto',
		'plugin.product.printer',
		'plugin.product.productos_precios_futuro',
		'plugin.product.detalle_comanda',
		'plugin.product.comanda',
		'plugin.product.mesa',
		'plugin.product.estado',
		'plugin.product.mozo',
		'plugin.product.cliente',
		'plugin.product.descuento',
		'plugin.product.tipo_documento',
		'plugin.product.iva_responsabilidad',
		'plugin.product.tipo_factura',
		'plugin.product.pago',
		'plugin.product.tipo_de_pago',
		'plugin.product.detalle_sabor',
		'plugin.product.historico_precio',
		'plugin.product.grupo_sabores_producto',
		'plugin.product.tag',
		'plugin.product.productos_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GrupoSabor = ClassRegistry::init('Product.GrupoSabor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GrupoSabor);

		parent::tearDown();
	}

}
