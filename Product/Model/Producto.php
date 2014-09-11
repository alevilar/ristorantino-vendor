<?php

App::uses('ProductAppModel', 'Product.Model');

class Producto extends ProductAppModel {

	public $name = 'Producto';
    public $order = 'Producto.name';
    
    public $actsAs = array(
        'SoftDelete', 
        'Search.Searchable',
        'MtSites.MultiTenant',
        'Containable',
        );





/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'abrev' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'description' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
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
        'precio' => array(
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



/**
 * belongsTo associations
 *
 * @var array
 */
    public $belongsTo = array(
        'Categoria' => array(
            'className' => 'Product.Categoria',
            'foreignKey' => 'categoria_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Printer' => array(
            'className' => 'Printers.Printer',
            'foreignKey' => 'printer_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );



    public $hasOne = array('Product.ProductosPreciosFuturo');



/**
 * hasMany associations
 *
 * @var array
 */
    public $hasMany = array(
        'DetalleComanda' => array(
            'className' => 'Comanda.DetalleComanda',
            'foreignKey' => 'producto_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'HistoricoPrecio' => array(
            'className' => 'Product.HistoricoPrecio',
            'foreignKey' => 'producto_id',
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
    );


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
    public $hasAndBelongsToMany = array(
        'GrupoSabor' => array(
            'className' => 'Product.GrupoSabor',
            'joinTable' => 'grupo_sabores_productos',
            'foreignKey' => 'producto_id',
            'associationForeignKey' => 'grupo_sabor_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        ),
        'Tag' => array(
            'className' => 'Product.Tag',
            'joinTable' => 'productos_tags',
            'foreignKey' => 'producto_id',
            'associationForeignKey' => 'tag_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );




    public $filterArgs = array(
        'name' => array(
            'type' => 'like',
            ),
        'precio_futuro' => array(
            'type' => 'value',
            'field' => 'ProductosPreciosFuturo.precio'
            ),
        'categoria_name' => array(
            'type' => 'value',
            'field' => 'Categoria.name'
            ),
        'abrev' => array(
            'type' => 'like',
            ),
        'printer_id' => array(
            'type' => 'value',
            ),
        'categoria_id' => array(
            'type' => 'value',
            ),  
        'deleted' => array(
            'type' => 'value',
            ),        
        'created_from' => array(
            'type' => 'value',
            'field' => 'Producto.created >='
            ),
        'created_to' => array(
            'type' => 'value',
            'field' => 'Producto.created <='
            ),        
        );
    
    
    
//	public $validate = array(
//	'abrev' => array(
//		'letras_correctas' => array(
//                                //'rule' => '/^[a-zA-Z0-9 -\.\/&]+$/',
//                                'rule' => '/^[a-zA-Z_0-9 \/\-]+$/mu',
//                                'required' => true,
//                                'allowEmpty' => false,
//                                'message' => 'La impresora fiscal no soporta acentos, eñes, puntos, ni caracteres raros. Los únicos símbolos raros admitidos son "-" y "/"'
//                        )
//		),
//	);


    // function buscarPorNombre($texto){
    //     return $this->find('all',array('conditions'=>array('Producto.name REGEXP'=>"$texto")));
    // }



    public function save($data = null, $validate = true, $fieldList = array())
    {            
        // cargo el precio futuro si es que lo tiene
        $pf = $this->__getPrecioFuturoData( $data );
        
        // cargo con el precio historico si es que lo tiene
        $hp = $this->__getPrecioHistoricoData( $data );
        // if ( $hp ) {
        //     $data['HistoricoPrecio'] = $hp['HistoricoPrecio'];
        // }
       
        if ( !parent::save($data, $validate, $fieldList) ) {
            return false;
        }

        // finalmente guardo el precio historico
        if ( $hp && !$this->HistoricoPrecio->save($hp) ) {
            $this->validationErrors = $this->HistoricoPrecio->validationErrors;            
            return false;
        }
        
        if ( $pf && !$this->ProductosPreciosFuturo->save($pf) ) {
            $this->validationErrors = $this->ProductosPreciosFuturo->validationErrors;
            return false;
        }

        return true;
    }


    private function __getPrecioFuturoData ($data) {
        $precioFutData = null;

        if ( isset($data['ProductosPreciosFuturo'])){
            $precioFutData['ProductosPreciosFuturo'] = $data['ProductosPreciosFuturo'];    
        }
        if ( !empty($data['ProductosPreciosFuturo']['precio']) ) {

            $data['ProductosPreciosFuturo']['producto_id'] = $data['Producto']['id'];

            $precioFutData = $this->ProductosPreciosFuturo->find('first', array(
                'recursive' => -1,
                'conditions'=> array(
                    'ProductosPreciosFuturo.producto_id' => $data['Producto']['id']
                )));
            if ( !empty($precioFutData) ) {
                $precio = $data['ProductosPreciosFuturo']['precio'];
                $precioFutData['ProductosPreciosFuturo'] = $precioFutData['ProductosPreciosFuturo'];
                $precioFutData['ProductosPreciosFuturo']['precio'] = $precio;
            } else {
                $precioFutData['ProductosPreciosFuturo'] = $data['ProductosPreciosFuturo'];
            }
        }        
        return $precioFutData;
    }


    private function __getPrecioHistoricoData ($data = null ) {
        $hpData = null;

        if ( !empty($data['Producto']['id']) && !empty($data['Producto']['precio']) ) {            
            $precioViejo = $this->field( 'precio', array( 'Producto.id'=> $data['Producto']['id'] ) );
            if ( !empty($precioViejo) && ( $precioViejo != $data['Producto']['precio'])) {

                $hpData = array(
                    'HistoricoPrecio' => array(
                        'precio' => $precioViejo ,
                        'producto_id' => $data['Producto']['id'],
                        )
                );
            }
        }
        return $hpData;
    }


}
?>
