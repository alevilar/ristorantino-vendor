<?php

App::uses('ProductAppModel', 'Product.Model');

class Tag extends ProductAppModel{
 
    public $hasAndBelongsToMany = array(
    	'Producto' => array(
    		'className' => 'Product.Producto',
    		'order' => array('Producto.name'=>'asc'),
    		)
    	);
    public $actsAs = array(
    'Search.Searchable',
    'Containable',
    );
    public $filterArgs = array(
        'name' => array('type' => 'like'),
    );


}