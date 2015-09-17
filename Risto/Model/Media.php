<?php


App::uses('AppTenantModel', 'Model');

class Media extends AppTenantModel {

    public $name = "Media";


    protected $_schema = array(
							'id' => array(
								'type' => 'integer',
								'null' => false,
								'default' => null,
								'length' => 11,
								'unsigned' => false,
								'key' => 'primary'
							),
							'model' => array(
								'type' => 'string',
								'null' => true,
								'default' => null,
								'length' => 32,
								'collate' => 'utf8_general_ci',
								'charset' => 'utf8'
							),
							'type' => array(
								'type' => 'string',
								'null' => false,
								'default' => null,
								'length' => 48,
								'collate' => 'utf8_general_ci',
								'charset' => 'utf8'
							),
							'size' => array(
								'type' => 'integer',
								'null' => false,
								'default' => null,
								'length' => 6,
								'unsigned' => false
							),
							'name' => array(
								'type' => 'string',
								'null' => false,
								'default' => null,
								'length' => 48,
								'collate' => 'utf8_general_ci',
								'charset' => 'utf8'
							),
							'created' => array(
								'type' => 'timestamp',
								'null' => true,
								'default' => null,
								'length' => null
							),
							'modified' => array(
								'type' => 'timestamp',
								'null' => true,
								'default' => null,
								'length' => null
							)
						);

    public $validate = array(
    	'type' => array(
	        'rule'    => 'notBlank',
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
