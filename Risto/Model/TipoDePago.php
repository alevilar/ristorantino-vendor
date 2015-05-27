<?php
App::uses('RistoTenantAppModel', 'Risto.Model');

class TipoDePago extends RistoTenantAppModel {

	public $name = 'TipoDePago';
	public $validate = array(
		'name' => array('notempty')
	);



	public $actsAs = array(
        'Containable',
        'Risto.MediaUploadable' ,
    );


    public $belongsTo = array('Risto.Media');

}
