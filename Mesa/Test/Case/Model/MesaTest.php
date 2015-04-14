<?php

App::uses('AppModel', 'Model');
App::uses('CakeSchema', 'Model');
App::uses('CakeTestFixture', 'TestSuite/Fixture');


/**
 * CakeSchemaTest
 *
 * @package       Cake.Test.Case.Model
 */
class MesaTest extends CakeTestCase {

	public $nuevaMesaSavedId = null;
/**
 * fixtures property
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.mesa.mesa',
		'plugin.mesa.mozo',
		'plugin.mesa.estado',
		'plugin.mesa.pago',
		'plugin.mesa.cliente',
		'plugin.mesa.descuento',
		'plugin.mesa.comanda',
		'plugin.mesa.detalle_comanda',
		'plugin.mesa.detalle_sabor',
		'plugin.mesa.categoria',
		'plugin.mesa.producto',
		'plugin.mesa.sabor',
		'plugin.mesa.printer',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		ConnectionManager::getDataSource('test')->cacheSources = false;
		$this->Mesa = ClassRegistry::init('Mesa.Mesa');
		$this->Mesa->useDbConfig = 'test';

		
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		parent::tearDown();		
	}



	public function testVerificarModifiedMesaAfterComandaAdded () {
		$mesaId = 1;

		$this->Mesa->id = $mesaId;


		$comanda = array(
			'Comanda' => array(
				'mesa_id' => $mesaId,
				'impresa' => 0, // no imprimir
				),
			'DetalleComanda' => array(
				array( 
					'producto_id' => 1, 
					'cant' => 2 
				),
			)
		);
		

		$modified = $this->Mesa->field('modified');

		$this->assertNotNull( $modified );

		if ( !$this->Mesa->Comanda->DetalleComanda->saveComanda( $comanda ) ) {
			debug($comanda);
			$errores = implode( ', ', $this->Mesa->Comanda->DetalleComanda->validationErrors);
			debug($errores);
			throw new CakeException("No se pudo guardar la comanda para la mesa. Validation errors: $errores", 1);
		}

		$modified2 = $this->Mesa->field('modified');

		// debe de haberse modificado la fecha modified en la MESA luego del cambio en la comanda
		$this->assertNotEquals( $modified, $modified2 );
	}


	public function testCalcularTotalProductos () {
		$mesaId = 1;

		//$this->Mesa->useDbConfig = 'test';

		$this->Mesa->id = $mesaId;


		// primero verifico con los productos del fixture - - - -- -- - -

		$totalProductos = $this->Mesa->calcular_total_productos();
		$this->assertEqual($totalProductos, 100);


		$totalProductos = $this->Mesa->calcular_total_productos( 3 );
		$this->assertEqual($totalProductos, 300);
	}

	public function testCalcularTotalProductosAgregados () {
		$mesaId = 1;

		//$this->Mesa->useDbConfig = 'test';

		$this->Mesa->id = $mesaId;

		// ahora pruebo agregando productos  - - -  - -- -- -


		$comanda = array(
			'Comanda' => array(
				'mesa_id' => $mesaId,
				'impresa' => 0, // no imprimir
				),
			'DetalleComanda' => array(
				array( 
					'producto_id' => 1, 
					'cant' => 3 
				),
			)
		);
		
		if ( !$this->Mesa->Comanda->DetalleComanda->saveComanda( $comanda ) ) {
			debug($comanda);
			$errores = implode( ', ', $this->Mesa->Comanda->DetalleComanda->validationErrors);
			debug($errores);
			throw new CakeException("No se pudo guardar la comanda para la mesa. Validation errors: $errores", 1);
		}

		$totalProductos = $this->Mesa->calcular_total_productos();
		$this->assertEqual($totalProductos, 400);



		// ahora elimino un producto  - - -  - -- -- -

		$comanda = array(
			'Comanda' => array(
				'mesa_id' => $mesaId,
				'impresa' => 0, // no imprimir
				),
			'DetalleComanda' => array(
				array( 
					'producto_id' => 1, 
					'cant' => 0,
					'cant_eliminada' => 1
				),
			)
		);


		if ( !$this->Mesa->Comanda->DetalleComanda->saveComanda( $comanda ) ) {
			debug($comanda);
			$errores = implode( ', ', $this->Mesa->Comanda->DetalleComanda->validationErrors);
			debug($errores);
			throw new CakeException("No se pudo guardar la comanda para la mesa. Validation errors: $errores", 1);
		}


		$totalProductos = $this->Mesa->calcular_total_productos();

		$this->assertEqual($totalProductos, 300);
	}


	public function testCalcularSubtotalNoMesaIdException() {

		try{
		    $total = $this->Mesa->calcular_subtotal();
		    $this->assertTrue( false );
		} catch (Exception $e){
			// Not Found Exception
		    $this->assertEquals( 404, $e->getCode());
		}
	}


	public function testCalcularSubtotal() {

		$total = $this->Mesa->calcular_subtotal( $mesaId = 1 );
		$this->assertEqual($total, 100);

		$total = $this->Mesa->calcular_subtotal( 3 );
		$this->assertEqual($total, 300);
	}


	public function testCalcularTotal() {
		$mesaId = 1;
		$total = $this->Mesa->calcular_total( $mesaId);
		$this->assertEqual($total, 100);

		$mesaId = 3;
		$total = $this->Mesa->calcular_total( $mesaId );
		$this->assertEqual($total, 300);
	}


	public function testCerrarMesa() {
		$save = true;
		$silent = true;

		$mesaId = 1;
		$this->Mesa->id = $mesaId;
		$mesaEstadoId = $this->Mesa->field('estado_id');
		$this->assertEqual( $mesaEstadoId, MESA_COBRADA );
		$cerrada = $this->Mesa->cerrar_mesa( $mesaId, $save, $silent);
		$this->assertTrue( $cerrada );
		$mesaEstadoId = $this->Mesa->field('estado_id');
		$this->assertEqual( $mesaEstadoId, MESA_CERRADA );
		$this->assertNotEmpty(  $this->Mesa->field('total') );
		$this->assertNotEmpty( $this->Mesa->field('subtotal') );



		$mesaId = 3;
		$this->Mesa->id = $mesaId;
		$mesaEstadoId = $this->Mesa->field('estado_id');
		$this->assertEqual( $mesaEstadoId, MESA_ABIERTA );
		$cerrada = $this->Mesa->cerrar_mesa( $mesaId, $save, $silent);
		$this->assertTrue( $cerrada );
		$mesaEstadoId = $this->Mesa->field('estado_id');
		$this->assertEqual( $mesaEstadoId, MESA_CERRADA );
		$total = $this->Mesa->field('total');
		$this->assertNotEqual( 0, $total );
		$this->assertNotEmpty(  (boolean) $total );
		$sub = $this->Mesa->field('subtotal');
		$this->assertNotEmpty( $sub );
		$this->assertNotEqual( 0, $sub );


	}



	public function testCerrarMesaSilentTrigger() {
		$save = true;
		$silent = false;

		$mesaId = 1;
		$this->Mesa->id = $mesaId;
		$mesaEstadoId = $this->Mesa->field('estado_id');
		$this->assertEqual( $mesaEstadoId, MESA_COBRADA );
		$cerrada = $this->Mesa->cerrar_mesa( $mesaId, $save, $silent);
		$this->assertTrue( $cerrada );
		$mesaEstadoId = $this->Mesa->field('estado_id');
		$this->assertEqual( $mesaEstadoId, MESA_CERRADA );
		$this->assertNotEmpty(  $this->Mesa->field('total') );
		$this->assertNotEmpty( $this->Mesa->field('subtotal') );



	}


	

}

