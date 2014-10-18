<?php
App::uses('ComandaAppModel', 'Comanda.Model');

class Observacion extends ComandaAppModel 
{
	public $name = 'Observacion';
    public $actsAs = array(
        'Search.Searchable',
        'Containable',
    );
    public $filterArgs = array(
        'name' => array('type' => 'like'),
    );



}