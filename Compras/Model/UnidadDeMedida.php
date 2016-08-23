<?php
App::uses('ComprasAppModel', 'Compras.Model');
/**
 * ComprasUnidadDeMedida Model
 *
 */
class UnidadDeMedida extends ComprasAppModel {


/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	public $order = array("UnidadDeMedida.name");


	public $actsAs = array(
		'Search.Searchable',
		);



	public $filterArgs = array(
		
        'search' => array(
        	'field' => 'UnidadDeMedida.name',
            'type' => 'like',
            ),
        );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'El nombre no se puede repetir',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
