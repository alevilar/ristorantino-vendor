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
App::uses('Model', 'Model');
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


	/**
	*
	*	Definido en risto.php
	*	Configure::read('Risto.migrationImageFolder');
	**/
	public $imgFolder;


	/**
	*
	*	Definido en risto.php
	*	Configure::read('Risto.migrationImageUrl');
	**/
	public $urlFolder;


	public function __construct($stdout = null, $stderr = null, $stdin = null) {
		parent::__construct($stdout, $stderr, $stdin);
		$this->imgFolder = Configure::read('Risto.migrationImageFolder');
		$this->urlFolder = Configure::read('Risto.migrationImageUrl');
	}

	public function main () {
		$this->out(' *-----------------------             ----------------------*/');
		$this->out(' *-----------------------  R I S T O  ----------------------*/');
		$this->out(' *-----------------------             ----------------------*/');

		$this->out('Puede ejecutar las siguientes funciones:');
		$this->out('    1) Risto.risto image_to_foto');
		$this->out('	      Es para migrar del viejo esquema de fotos file como un string en la BD a el nuevo sistema Medias donde se guarda todo en BBDD',2);
		$this->out('    2) Risto.risto update_tenant_schemas');
		$this->out('	      Es para actualizar los Tenant con el Schema de Risto. Actualiza la estructura de la BBDD. Usar con muchisimo ciudado', 2);
	}


	public function update_tenant_schemas () {
		$sites = ClassRegistry::init('Risto.Site')->find('list', array('fields'=>array('alias','name')));
		foreach ( $sites as $sAlias=>$sName ) {
			try {
				// listar sources actuales
				$sources = ConnectionManager::enumConnectionObjects();

				//copiar del default
				$tenantConf = $sources['default'];

				// colocar el nombre de la base de datos
				$tenantConf['database'] = $tenantConf['database'] ."_". $sAlias;

				// crear la conexion con la bd
				$sAlias = 'tenant_'.$sAlias;
				ConnectionManager::create( $sAlias, $tenantConf );

				$this->out("|||||||||||||||||||||||||					||||| ");
				$this->out("||||||||||||||||||||||||||||					||||| ");
				$this->out("||||||||||||||||||||||||||||||||					||||| ");
				$this->out(sprintf('Comporbando tenant %s', $sAlias));
				$this->dispatchShell('Risto.risto_schema update -y --plugin Risto --connection '.$sAlias);
				$this->out("", 2);
			} catch (Exception $e ) {
				$this->out("<error>".$e->getMessage()."</error>");
			}
		}
	}

	public function image_to_foto () {
		$this->out("iniciando");

		$this->__loadOldModels();

		$this->imageToMedia('Egreso');
		$this->imageToMedia('Gasto');
	}

	private function imageToMedia ( $model ) {		
		if ( !$this->__verifyFileFieldExists( $this->{$model} ) ) {
			throw new CakeException("No existe el campo field, probablemente se este usando una version nueva de la Base de Datos?");
		}
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
			if ( fmod( $cont++, 50) == 0 ){
					$contSum = $cont-1;
					$this->out("******************************************");
					$this->out("*****   Van $contSum de $total *****");
					$this->out("******************************************");
			}


			$im = $this->imgFolder . $e[$model]['file'];
			if ( !is_file( $im ) || !filesize( $im ) ) {
				$aFileName = explode( '/webroot/img/', $e[$model]['file']);
				if (!empty($aFileName[0]) ){
					$imUrl = $this->urlFolder . $aFileName[0];
					$imAux = file_get_contents($imUrl);
					if ( $imAux ) {
						$this->out('descargando  imagen ONLINE a '.$im);
						file_put_contents($im, $imAux);
						//unset($imAux);
					}
				}
			}

			if ( is_file( $im ) && filesize( $im ) ) {
				$media = array('Media' => array(
								'model' => $model,
								'type' 	=> "image/" . pathinfo($im, PATHINFO_EXTENSION),
								'size'	=> filesize($im),
								'name'	=> $e[$model]['file'],
								'file'	=> file_get_contents($im)
						));				

				$this->Media->create();
				if ( $this->Media->save($media) ) {
					$e[$model]['media_id'] = $this->Media->id;
					if ( $this->{$model}->save($e) ) {
						$this->out("<success>$cont) SAVED: $im</success>");
					} else {
						$this->log("[$im] error guardando en Model $model el media_id ".$this->Media->id);
					}
				} else {
					$this->log("[$im] error guardando Media");
				}
			} else {
				$e[$model]['media_id'] = 0;
				$this->{$model}->save($e);

				$this->out("<warning>La imagen $im NO EXISTE</warning>");
			}

		}
		
	}


	private function __verifyFileFieldExists ( Model $Model) {
		return (bool) $Model->schema('file');
	}



	private function __loadOldModels () {
		$this->Media = new Model(array(
                'table' => 'media',
                'ds' => $this->datasource,
                'name' => 'Media',
                'alias' => 'Media',
                'primaryKey' => 'id',
        ));


		$this->Egreso = new Model(array(
                'table' => 'account_egresos',
                'ds' => $this->datasource,
                'name' => 'Egreso',
                'alias' => 'Egreso',
                'primaryKey' => 'id',
        ));

		
		$this->Gasto = new Model(array(
                'table' => 'account_gastos',
                'ds' => $this->datasource,
                'name' => 'Gasto',
                'alias' => 'Gasto',
                'primaryKey' => 'id',                
                ));


		if ( !$this->Egreso->hasField('media_id') ) {
			$this->Egreso->query("ALTER TABLE  `".$this->Egreso->table."` ADD  `media_id` INT NULL ;");
			$this->out('Se creó la columna media_id para la tabla: '.$this->Gasto->table);
		}


		if ( !$this->Gasto->hasField('media_id') ) {
			$this->Gasto->query("ALTER TABLE  `".$this->Gasto->table."` ADD  `media_id` INT NULL ;");
			$this->out('Se creó la columna media_id para la tabla: '.$this->Gasto->table);
		}

	}


}

