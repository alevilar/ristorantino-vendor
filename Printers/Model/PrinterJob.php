<?php

App::uses('PrintersAppModel', 'Printers.Model');
App::uses('MtSites', 'MtSites.Utility');


class PrinterJob extends AppModel {

	public $name = 'PrinterJob';
	

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
			'Printer' => array(
				'className' => 'Printers.Printer',
				'foreignKey' => 'printer_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			)
	);




	public function setup( Model $model, $config = array() ) {

		App::uses('ComandasEventListener', 'Printers.Event');
		App::uses('ClassRegistry', 'Utility');


		ClassRegistry::init('Comanda.Comanda')->getEventManager()->attach( new ComandasEventListener );


	}


	public function beforeSave($options = array()) {
		$this->data['PrinterJob']['site_alias'] = MtSites::getSiteName();
		return true;
	}
	

}