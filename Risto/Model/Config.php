<?php


App::uses('RistoTenantAppModel', 'Risto.Model');

class Config extends RistoTenantAppModel {

    public $name = "Config";

    public $actsAs = array(
        'Containable',
        );


    public $belongsTo = array('Risto.ConfigCategory');
}
?>