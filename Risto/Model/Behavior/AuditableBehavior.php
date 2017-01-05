<?php
App::uses('CakeSession', 'Model/Datasource');



class AuditableBehavior extends ModelBehavior {

	/**
	*
	*	El campo de la tabla created_by
	*
	**/
	public $createdBy = 'created_by';


	public function setup(Model $model, $config = array()) {
	
		$model->bindModel(array('belongsTo' => array(
				 'Creator' => array(
                    'className' => 'Users.User',
                    'foreignKey' => 'created_by',
                    'conditions' => '',
                    'fields' => '',
                    'order' => ''
                )
			)));
	}





	public function beforeSave(Model $model, $options = array()) {

		// verifico que NO tenga ID, porque solo debo guardar cuando se esta creando el registro
		if ( empty($model->data[$model->name]['id'])) {
			if ( CakeSession::check("Auth.User.id") ) {
				$userId = CakeSession::read("Auth.User.id");
				$model->data[$model->name]['created_by'] = $userId;
			}
		}

		return true;
	}

}