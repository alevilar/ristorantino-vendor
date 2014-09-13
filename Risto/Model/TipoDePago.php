<?php
App::uses('RistoTenantAppModel', 'Risto.Model');

class TipoDePago extends RistoTenantAppModel {

	var $name = 'TipoDePago';
	var $validate = array(
		'name' => array('notempty')
	);


}
?>