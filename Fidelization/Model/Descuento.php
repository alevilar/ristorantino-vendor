<?php

App::uses('FidelizationAppModel', 'Fidelization.Model');


class Descuento extends FidelizationAppModel {

	public $name = 'Descuento';

    public $actsAs = array(
        'Utils.SoftDelete', 
        'Containable',
        'Search.Searchable',
        );


	public $validate = array(
		'name' => array('notBlank'),
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