<?php
App::uses('ObservacionAppModel', 'Comanda.Model');

class ObservacionComanda extends ObservacionAppModel 
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