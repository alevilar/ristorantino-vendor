<?php
App::uses('RistoTenantAppModel', 'Risto.Model');

class TipoDocumento extends RistoTenantAppModel {

	var $name = 'TipoDocumento';
	var $validate = array(
		'codigo_fiscal' => array('notempty'),
		'name' => array('notempty')
	);
    public $actsAs = array(
        'Search.Searchable',
        'Containable',
    );
    public $filterArgs = array(
        'name' => array('type' => 'like'),
    );
}
?>