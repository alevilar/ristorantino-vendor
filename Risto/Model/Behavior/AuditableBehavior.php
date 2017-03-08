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
                ),
				 'CreatorGeneric' => array(
                    'className' => 'Users.GenericUser',
                    'foreignKey' => 'created_by',
                    'conditions' => '',
                    'fields' => '',
                    'order' => ''
                )
			)));
	}



	public function __completarConCreatedBy( $model, $modelName ) {
		// verifico que NO tenga ID, porque solo debo guardar cuando se esta creando el registro
		if ( isset($model->data[$modelName]) && empty($model->data[$modelName]['id'])) {
			if ( CakeSession::check("Auth.User.id") ) {
				$userId = CakeSession::read("Auth.User.id");
				$model->data[$modelName]['created_by'] = $userId;
			}
		}
	}



	public function beforeSave(Model $model, $options = array()) {
		$asociados = $model->getAssociated();
		foreach ($asociados as $modelName => $relationType) {
			if ( $relationType == 'hasMany' || $relationType == 'hasOne') {
				$this->__completarConCreatedBy( $model->{$modelName}, $modelName );
			}
		}

		// verifico que NO tenga ID, porque solo debo guardar cuando se esta creando el registro
		$this->__completarConCreatedBy( $model, $model->name );


		return true;
	}



	public function esUsuarioPrivilegiado() {
		$userId         = CakeSession::check("Auth.User.id");
        $userIsAdmin    = CakeSession::read("Auth.User.is_admin");
        $userIsEncargado = CakeSession::read("Auth.User.rol_id")  == ROL_ID_ENCARGADO;
        $userIsDuenio   = CakeSession::read("Auth.User.rol_id") === null;
        $puedeVerTodo   = ($userIsAdmin || $userIsEncargado || $userIsDuenio);
        return $puedeVerTodo;
	}
}