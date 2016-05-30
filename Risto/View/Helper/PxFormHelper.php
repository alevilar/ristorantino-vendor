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

		$attributesNew = array(
				'type' => 'text',
				'class' => $clasname.' form-control',
                'data-format' =>  $dateFormat,                
			);

		$attributes = array_merge($attributes, $attributesNew);

	
		$output = $this->text($fieldName, $attributes);


		return $output;
	}


	public function input($fieldName, $options = array()) {

		if (!empty($options['type']) && ($options['type'] == 'date' || $options['type'] == 'datetime') ) {
			if (empty( $options['after']) ) {
				$options['after'] = '<i class="fa fa-calendar form-control-feedback"></i>';
			}

			if (empty( $options['div']) ) {
				$options['div'] = array(
					'class' => 'form-group has-feedback',
					);
			}
		}

		return parent::input($fieldName, $options);
	}


}