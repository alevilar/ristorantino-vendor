<?php

App::uses('ProductAppModel', 'Product.Model');

class Tag extends ProductAppModel{
 
    public $hasAndBelongsToMany = array('Product.Producto');


}