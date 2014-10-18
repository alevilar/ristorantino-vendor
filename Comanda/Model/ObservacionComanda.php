<?php
App::uses('ComandaAppModel', 'Comanda.Model');

class ObservacionComanda extends ComandaAppModel 
{
	public $name = 'ObservacionComanda';
    public $actsAs = array(
        'Search.Searchable',
        'Containable',
    );
    public $filterArgs = array(
        'name' => array('type' => 'like'),
    );
}