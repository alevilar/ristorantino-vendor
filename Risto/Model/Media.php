<?php


App::uses('AppTenantModel', 'Model');

class Media extends AppTenantModel {

    public $name = "Media";

    public $validate = array(
    	'type' => array(
	        'rule'    => 'notEmpty',
	        'message' => 'Se debe guardar el tipo del archivo'
	    ),
	    'file' => array(
	        'rule'    => 'uploadError',
	        'allowEmpty' => false,
	        'required' => true,
	        'message' => 'Error subiendo archivo'
	    ),
	);


}
