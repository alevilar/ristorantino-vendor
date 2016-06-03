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
		if (!empty($options['input-addon-before']) ){
			$options['before'] = '<span class="input-group-addon">'. $options['input-addon-before'] .'</span>';
			$options['div'] = array(
					'class' => 'input-group',
					);
		}

		if (!empty($options['input-addon-after']) ){
			$options['after'] = '<span class="input-group-addon">'. $options['input-addon-after'] .'</span>';
			$options['div'] = array(
					'class' => 'input-group',
					);
		}

		if (!empty($options['fa']) ){
				// verifico si no esta vacio parfa que siga funcionando con los input-addon previamente marcados
				if ( empty($options['div']['class']) ) {
					$options['div']['class'] = '';
				}
				$options['after'] = '<i class="fa fa-'. $options['fa'] .' form-control-feedback"></i>';
				$options['div']['class'] = $options['div']['class'].' form-group has-feedback';
		}


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