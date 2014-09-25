<?php

class MediaUploadableBehavior extends ModelBehavior {

	protected $_form_field_name = 'media_file';
	protected $_form_fk = 'media_id';

 	/**
    * Setup the behavior
    */
  function setUp(Model $Model, $options = array()) {
  	if ( array_key_exists('mediaUploadFieldName', $options) ) {
  		$this->_form_field_name = $options['mediaUploadFieldName'];
  	}

  	if ( array_key_exists('mediaUploadFk', $options) ) {
  		$this->_form_fk = $options['mediaUploadFk'];
  	}

  	$Model->bindModel(
	        array('belongsTo' => array(
	                'Media' => array(
	                    'className' => 'Risto.Media'
	                )
	            )
	        )
	    );


  	$Model->validate['media_file'] = array(
                'rule'    => 'uploadError',
                'message' => __('Falló al subir el archivo. Es mas grande que %s?', ini_get('upload_max_filesize')),
            );

  }



  /**
    * beforeSave if a file is found, upload it, and then save the filename according to the settings
    *
   **/
	  function beforeSave( Model $Model, $options = array() ){
	  	if ( !array_key_exists('Media', $Model->belongsTo) ) {
		  	$Model->bindModel(
		        array('belongsTo' => array(
		                'Media' => array(
		                    'className' => 'Risto.Media'
		                )
		            )
		        )
		    );
	  	}
	    if(isset($Model->data[$Model->alias][$this->_form_field_name])){
	      $data = array('Media' => $Model->data[$Model->alias][$this->_form_field_name]);
	      debug($data);
	      $data['Media']['file'] = file_get_contents($Model->data[$Model->alias][$this->_form_field_name]['tmp_name']);
	      $data['Media']['model'] = $Model->name;
	      if ( !$Model->Media->save($data)) {
	      	// error
	      	$Model->validationErrors[$_form_field_name] = $this->Media->validationErrors;
	      	return false;
	      }
	      $Model->data[$Model->alias][$this->_form_fk] = $Model->Media->id;
	    }
	    return $Model->beforeSave();
	  }
}
  