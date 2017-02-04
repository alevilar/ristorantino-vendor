<?php
App::uses('RistoTenantAppModel', 'Risto.Model');

class IvaResponsabilidad extends RistoTenantAppModel {

	public $name = 'IvaResponsabilidad';

	
	public $validate = array(
		'codigo_fiscal' => array('notBlank'),
		'name' => array('notBlank')
	);

    public $actsAs = array(
        'Search.Searchable',
        'Containable',
    );
    public $filterArgs = array(
        'name' => array('type' => 'like'),
        'codigo_fiscal' => array ('type' => 'like')
    );

	public $belongsTo = array(
		'TipoFactura' => array(
			'className' => 'Risto.TipoFactura',
			'foreignKey' => 'tipo_factura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);



	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		/*
		'Cliente' => array(
			'className' => 'Fidelization.Cliente',
			'foreignKey' => 'iva_responsabilidad_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
		*/
	);

	
}
