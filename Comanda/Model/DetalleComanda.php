<?php
App::uses('ComandaAppModel', 'Comanda.Model');


class DetalleComanda extends ComandaAppModel {

	public $name = 'DetalleComanda';
	public $validate = array(
		'producto_id' => array('numeric'),
		'cant' => array('numeric'),
		'mesa_id' => array('numeric')
	);


	public $actsAs = array(
		'Utils.SoftDelete', 
		'Containable',
		'Search.Searchable',
		);

	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
			'Producto' => array('className' => 'Product.Producto',
								'foreignKey' => 'producto_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Comanda' => array('className' => 'Comanda.Comanda',
								'foreignKey' => 'comanda_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''			
			)
	);
	
	public $hasMany = array(
			'DetalleSabor' => array(
								'className' => 'Comanda.DetalleSabor',
								'foreignKey' => 'detalle_comanda_id',
								'dependent' => true,
								'conditions' => array('DetalleSabor.deleted'=>0),
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);



	public $filterArgs = array(
        'producto_id' => array(
            'type' => 'value',
            ),
        'categoria_id' => array(
            'type' => 'value',
            'field' => 'Producto.categoria_id'
            ),   
        'tags' => array(
            'type' => 'subquery',
            'field' => 'DetalleComanda.producto_id',
            'method' => '__searchSubqueryProductTags'
            ),        
        'desde' => array(
            'type' => 'value',
            'field' => 'DetalleComanda.created >='
            ),
        'hasta' => array(
            'type' => 'value',
            'field' => 'DetalleComanda.created <='
            ),
        );
	

       
   public function __searchSubqueryProductTags($data = array()) {
        $tags = $this->Producto->Tag->find('all', array('conditions'=>array(
        		    'Tag.id' => $data['tags']
        			),
        ));
        $prods = Hash::extract($tags, '{n}.Producto.{n}.id');

        $query = $this->Producto->getQuery('all', array(
            'conditions' => array(
                'Producto.id' => $prods
            ),
            'fields' => array('Producto.id')
        ));
        return $query;
    }
	
	
	public function guardar($data){		
		$this->save($data);
		unset($this->id);
		return $this;
	}



}
