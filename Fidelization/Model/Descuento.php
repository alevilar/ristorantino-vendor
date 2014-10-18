<?php

App::uses('FidelizationAppModel', 'Fidelization.Model');


class Descuento extends FidelizationAppModel {

	public $name = 'Descuento';

    public $actsAs = array(
        'SoftDelete', 
        'Containable',
        'Search.Searchable',
        );


	public $validate = array(
		'name' => array('notempty'),
		'porcentaje' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'required' => true,
                'message' => 'Solo números'
                )
        )
	);
    public $filterArgs = array(
        'name' => array('type' => 'like'),
    );


}
?>