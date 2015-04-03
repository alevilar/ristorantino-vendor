<?php
App::uses('PrintersAppController', 'Printers.Controller');
App::uses('ReceiptPrint', 'Printers.Utility');
App::uses('FiscalPrint', 'Printers.Utility');

/**
 * Printers Controller
 *
 * @property Printer $Printer
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PrintersController extends PrintersAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');


	public $drivers = array(
		'Afip'=> 'Afip Web Services',
		'Fiscal'=> 'Fiscal', 
		'Receipt'=> 'Comandera'
		);

	public $driver_models = array(
			'Afip' => array(
				'AfipWsFeV1'=>'Web Service Factura Electronica v1',
			),
			'Fiscal' => array(
				'Hasar441'=>'Hasar441', 
				'Hasar1120f'=>'Hasar1120f',
				'HasarSMHP321f'=>'Hasar SMHP 32X'
				), 
			'Comandera' => array(
				'Bematech' => 'Bematech',
				'EscP' => 'EscP',
				)
			);

	public $outputs = array(
			'Cups' => 'Cups',
			'Database' => 'Database',
			'AfipFacturas' => 'Afip Facturas Online',
		);


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Printer->recursive = 0;
		$this->set('printers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Printer->exists($id)) {
			throw new NotFoundException(__('Invalid printer'));
		}
		$options = array('conditions' => array('Printer.' . $this->Printer->primaryKey => $id));
		$this->set('printer', $this->Printer->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Printer->create();
			if ($this->Printer->save($this->request->data)) {
				$this->Session->setFlash(__('The printer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printer could not be saved. Please, try again.'));
			}
		}
		$this->request->data['Printer']['output'] = Configure::read('Printers.output');

		$this->set('drivers', $this->drivers );
		$this->set('driver_models', $this->driver_models);
		$this->set('outputs', $this->outputs);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Printer->exists($id)) {
			throw new NotFoundException(__('Invalid printer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Printer->save($this->request->data)) {
				$this->Session->setFlash(__('The printer has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The printer could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Printer.' . $this->Printer->primaryKey => $id));
			$this->request->data = $this->Printer->find('first', $options);
		}

		$this->request->data['Printer']['output'] = Configure::read('Printers.output');

		$this->set('drivers', $this->drivers );
		$this->set('driver_models', $this->driver_models);
		$this->set('outputs', $this->outputs);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Printer->id = $id;
		if (!$this->Printer->exists()) {
			throw new NotFoundException(__('Invalid printer'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Printer->delete()) {
			$this->Session->setFlash(__('The printer has been deleted.'));
		} else {
			$this->Session->setFlash(__('The printer could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}




	public function print_comanda ( $comanda_id) {
		

		ReceiptPrint::comanda($comanda_id);

		$this->Session->setFlash("Se envió a imprimir comanda");
	}



	/**
	 * @param string $type puede ser X o Z. 
	 * 		El cierre X realiza un cierre parcial, típico para cambio de cajero
	 * 		El cierre Z es un cierre fiscal, y pone los contadopres del impresor fiscal en cero
	 */
	public function cierre( $type = "X"){
		FiscalPrint::cierre($type);

		$this->set('type', strtoupper($type));
    }




    public function nota_credito(){
		if ( $this->request->is(array('post', 'put')) ) {
                   
        	$numeroTicket = $this->request->data['Cajero']['numero_ticket'];
        	$importe = $this->request->data['Cajero']['importe'];
        	$tipo_factura = $this->request->data['Cajero']['tipo'];
        	$descrip = $this->request->data['Cajero']['descripcion'];        	
        	$cliente = array(
        		'nombre' => $this->request->data['Cliente']['razonsocial'],
        		'nrodocumento' => $this->request->data['Cliente']['numerodoc'],
        		'domicilio' => '.',
        		) ;

            if ( FiscalPrint::imprimirNotaDeCredito($numeroTicket, $importe, $tipo_factura, $descrip, $cliente) )  {
            	$this->Session->setFlash("Se envió a imprimir una nota de crédito", 'Risto.flash_success');
            }
        }
	}


	public function mesa_ticket ( $mesa_id ) {
		throw new NotImplementedException(__('Ticket fiscal Mesa'));
	}


	public function mesa_detail ( $mesa_id ) {
		throw new NotImplementedException(__('Detalle de Mesa'));
	}

}
