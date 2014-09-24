<?php

 App::uses('Bs3FormHelper', 'Bs3Helpers.View/Helper');



class PxFormHelper extends Bs3FormHelper {


	public function date($fieldName, $dateFormat = 'yyyy-MM-dd', $timeFormat = null, $attributes = array()) {
		die("asas");
		debug($dateFormat);
		if ( !empty($timeFormat) ) {
			$dateFormat = $dateFormat." hh:mm A/PM";
		}

		return $this->text($fieldName, array(				
                'class' => 'datepicker form-control',
                'data-format' =>  $dateFormat,
            ));
	}


	public function dateTime($fieldName, $dateFormat = 'yyyy-MM-dd', $timeFormat = 'hh:mm A/PM', $attributes = array()) {
		
		if ( !empty($timeFormat) ) {
			$clasname = 'datetimepicker';
			$dateFormat = $dateFormat.' '.$timeFormat ;
		} else {
			$clasname = 'datepicker';
			$dateFormat = 'yyyy-MM-dd';
		}

		return $this->text($fieldName, array(				
                'class' => $clasname.' form-control',
                'data-format' =>  $dateFormat,
            ));
	}



}