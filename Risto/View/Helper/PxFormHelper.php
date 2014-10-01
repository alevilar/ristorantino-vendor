<?php

 App::uses('Bs3FormHelper', 'Bs3Helpers.View/Helper');



class PxFormHelper extends Bs3FormHelper {



	public function dateTime($fieldName, $dateFormat = 'yyyy-MM-dd', $timeFormat = null, $attributes = array()) {
		$dateFormat = 'yyyy-MM-dd';
		if ( !empty($timeFormat) ) {
			$timeFormat = 'hh:mm';
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