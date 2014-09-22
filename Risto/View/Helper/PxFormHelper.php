<?php

 App::uses('Bs3FormHelper', 'Bs3Helpers.View/Helper');



class PxFormHelper extends Bs3FormHelper {



	public function dateTime($fieldName, $dateFormat = 'DMY', $timeFormat = '12', $attributes = array()) {
		$dataFormat = "yyyy-MM-dd";
		if ( !empty($timeFormat)) {
			$dataFormat = $dataFormat." hh:mm:ss";
		}
		return $this->text($fieldName, array(				
                'class' => 'datetimepicker form-control',
                'data-format' =>  $dataFormat,
            ));
	}



}