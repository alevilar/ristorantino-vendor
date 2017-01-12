<?php
App::uses('ProductAppModel', 'Product.Model');
/**
 * Sabor Model
 *
 * @property Categoria $Categoria
 * @property DetalleComanda $DetalleComanda
 */
class Sabor extends ProductAppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
        
        public $actsAs = array(
            'Utils.SoftDelete', 
            'Search.Searchable'
            );
      
       public $filterArgs = array(
			'name' => array('type' => 'like'),
						        'categoria_id' => array(
            'type' => 'value',
            'field' => 'Categoria.id'
            ),
                        'precio' => array('type' => 'value'),
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
		),
		'categoria_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'deleted' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Product.GrupoSabor',
		'Categoria' => array(
			'className' => 'Product.Categoria',
			'foreignKey' => 'categoria_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
      
}