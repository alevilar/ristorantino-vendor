<?php
App::uses('RistoTenantAppModel', 'Risto.Model');

class TipoDocumento extends RistoTenantAppModel {

	public $name = 'TipoDocumento';

	public $validate = array(
		'name' => array('notBlank')
	);

    public $actsAs = array(
        'Search.Searchable',
        'Containable',
    );
    
    public $filterArgs = array(
        'name' => array('type' => 'like'),
    );
}
