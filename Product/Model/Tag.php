<?php

App::uses('ProductAppModel', 'Product.Model');

class Tag extends ProductAppModel{
 
    public $hasAndBelongsToMany = array('Product.Producto');
    public $actsAs = array(
    'Search.Searchable',
    'Containable',
    );
    public $filterArgs = array(
        'name' => array('type' => 'like'),
    );


}