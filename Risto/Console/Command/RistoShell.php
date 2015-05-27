<?php
/**
 * AppShell file
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v 2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Shell', 'Console');
App::uses('AppModel', 'Model');
App::uses('ConnectionManager', 'Model');

/**
 * Application Shell
 *
 * Add your application-wide methods in the class below, your shells
 * will inherit them.
 *
 * @package       app.Console.Command
 */
class RistoShell extends Shell {

	public $datasource = 'paxacarilo';

	public $imgFolder = '/home/alejandro/Work/paxacarilo_mig/webroot/img/';


	public function main () {
		$this->out("iniciando");

		$this->__loadOldModels();

		$this->imageToMedia('Egreso');
		$this->imageToMedia('Gasto');
	}




	private function imageToMedia ( $model ) {
		$modellist = $this->{$model}->find('all', array(
			'conditions' => array(
				"$model.file IS NOT NULL",
				"OR" => array(
					"$model.media_id IS NULL",
					"$model.media_id < 0",
					),
				),
			'recursive' => -1,
			//'limit' => 3000,
			)
		);

		$total = sizeof($modellist);
		$this->out("Se va a comenzar a guardar imagenes de $model. Hay $total en total.");

		$cont = 0;
		foreach ( $modellist as $e ) {
			$im = $this->imgFolder . $e[$model]['file'];

			if ( file_exists( $im ) ) {
				$media = array('Media' => array(
								'model' => $model,
								'type' 	=> "image/" . pathinfo($im, PATHINFO_EXTENSION),
								'size'	=> filesize($im),
								'name'	=> $e[$model]['file'],
								'file'	=> file_get_contents($im)
						));

				if ( fmod( $cont++, 50) == 0 ){
					$contSum = $cont-1;
					$this->out("******************************************");
					$this->out("*****   Van $contSum de $total *****");
					$this->out("******************************************");
				}

				$this->Media->create();
				if ( $this->Media->save($media) ) {
					$e[$model]['media_id'] = $this->Media->id;
					$this->{$model}->save($e);
				} else {
					throw new CakeException("Error al guardar Media");
				}
				$this->out("$cont) SAVED: $im");
			} else {
				$e[$model]['media_id'] = -1;
				$this->{$model}->save($e);

				$this->out("<warning>La imagen $im NO EXISTE</warning>");
			}

		}
		
	}




	private function __loadOldModels () {
		$this->Media = new AppModel(array(
                'table' => 'media',
                'ds' => $this->datasource,
                'name' => 'Media',
                'alias' => 'Media',
                'primaryKey' => 'id',
        ));


		$this->Egreso = new AppModel(array(
                'table' => 'account_egresos',
                'ds' => $this->datasource,
                'name' => 'Egreso',
                'alias' => 'Egreso',
                'primaryKey' => 'id',
        ));

		if ( !$this->Egreso->hasField('media_id') ) {
			$this->Egreso->query("ALTER TABLE  `".$this->Egreso->table."` ADD  `media_id` INT NULL ;");
			$this->out('Se creó la columna media_id para la tabla: '.$this->Gasto->table);
		}

		
		$this->Gasto = new AppModel(array(
                'table' => 'account_gastos',
                'ds' => $this->datasource,
                'name' => 'Gasto',
                'alias' => 'Gasto',
                'primaryKey' => 'id',                
                ));

		if ( !$this->Gasto->hasField('media_id') ) {
			$this->Gasto->query("ALTER TABLE  `".$this->Gasto->table."` ADD  `media_id` INT NULL ;");
			$this->out('Se creó la columna media_id para la tabla: '.$this->Gasto->table);
		}





	}


}
