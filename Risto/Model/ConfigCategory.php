<?php
App::uses('RistoTenantAppModel', 'Risto.Model');

class ConfigCategory extends RistoTenantAppModel {

    public $name = "ConfigCategory";

    public $hasMany = array('Risto.Config');
}
?>