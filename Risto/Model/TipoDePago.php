<?php
App::uses('RistoTenantAppModel', 'Risto.Model');

class TipoDePago extends RistoTenantAppModel {

	public $name = 'TipoDePago';
	public $validate = array(
		'name' => array('notBlank')
	);



	public $actsAs = array(
        'Containable',
        'Risto.MediaUploadable' ,
    );


    public $belongsTo = array('Risto.Media');




    /**
	 * Called before every deletion operation.
	 *
	 * @param bool $cascade If true records that depend on this record will also be deleted
	 * @return bool True if the operation should continue, false if it should abort
	 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforedelete
	 */
	public function beforeDelete($cascade = true) {
		if ($this->id  == TIPO_DE_PAGO_EFECTIVO ) {
			return false;
		}

		return true;
	}

}
