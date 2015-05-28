<?php

App::uses('AppTenantModel', 'Model');

class RistoSoftDeleteTenantAppModel extends AppTenantModel {
	public function exists($id = null) {
	    if ($this->Behaviors->attached('SoftDelete')) {
	        return $this->existsAndNotDeleted($id);
	    } else {
	        return parent::exists($id);
	    }
	}


	public function delete($id = null, $cascade = true) {
	    $result = parent::delete($id, $cascade);
	    if ($result === false && $this->Behaviors->enabled('SoftDelete')) {
	    	$this->_deleteDependent($id, $cascade);
	       return (bool)$this->field('deleted', array('deleted' => 1));
	    }
	    return $result;
	}
}
