<?php
App::uses('PrintersAppController', 'Printers.Controller');

class PrinterJobsController extends PrintersAppController {

	//public $components = array('RequestHandler');

	public function beforeFilter()
	{      
        $this->Auth->allow('*');
    }

	public function index () {
		
		//Configure::write('debug', 0);

		$pjs = $this->PrinterJob->find('all');

		$printerJobs = array();
		foreach ( $pjs as $pj) {
			if ($pj['PrinterJob']['printer_id'] == 0 ) {
				$if = Configure::read('ImpresoraFiscal');
				$pj['Printer'] = $if;
				$pj['Printer']['name'] = $pj['Printer']['nombre'];
				$pj['Printer']['fiscal'] = true;
			}
			$printerJobs[] = $pj;
		}
		$this->set(compact('printerJobs'));

	}


	public function delete($id = null) {
		$this->Auth->allow('*');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Print Job', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PrinterJob->delete($id)) {
			$this->Session->setFlash(__('Print Job deleted', true));			
		}
		exit;
	}



	public function monitor(){
		//die("asasas MONITOR");
		$this->layout = false;
	}
}