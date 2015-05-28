<?php
App::uses('ObservacionAppModel', 'Comanda.Model');

class Observacion extends ObservacionAppModel 
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