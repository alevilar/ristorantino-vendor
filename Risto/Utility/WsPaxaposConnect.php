<?php

App::uses('CakeSocket', 'Network');
App::uses('CakeLog', 'Log');


class WsPaxaposConnect{
	
	static $port = 8084;


	/**
	 * Hace un array para que sea compatible con la versin anterior del ristorantino
	 * donde se enviaba un js con interval
	 * 
	 * 
	 **/
	public static function __convertLindoArray($mesa){

		$mesanew = $mesa['Mesa'];
		unset($mesa['Mesa']);
		foreach ( $mesa as $mkey=>$mvalue) {
			$mesanew[$mkey] = $mvalue;
		}


		return $mesanew;
	}

	public static function sendMesa (Int $mesaId, String $event, $tenant = null ) {

		$Mesa = ClassRegistry::init("Mesa.Mesa");
		$mesa = null;
		if ( $Mesa->exists($mesaId) ) {
			$Mesa->contain($Mesa->defaultContain);
			$mesaEncontrada = $Mesa->read(null, $mesaId);
			if ( !empty($mesaEncontrada) ) {
				// no mandar nada
				$mesa = self::__convertLindoArray($mesaEncontrada);
			}

		}

		if ( is_null( $mesa) ) {
			return false;
		}

		if (empty($tenant)) {
			App::uses('MtSites', 'MtSites.Utility');
			$tenant = MtSites::getSiteName();
		}

		$toEncode = array(
			'tenant' => $tenant,
			'event'  => $event,
			'msg' 	 => $mesa
			);
		$data = json_encode($toEncode);

		self::__write($data);
		
		return $data;
	}


	static function __write( $data ){
		$url = str_replace( array("http://","https://"), "", FULL_BASE_URL);
		$config = array(
				//'persistent' => false,
			'host' => $url,
			//'protocol' => 'tcp',
			'port' => self::$port,
			'timeout' => 10,
		);
		try{
			$skt = new CakeSocket($config);
			$skt->connect();
			$skt->write($data);
			$skt->disconnect();
		} catch (Exception $e) {
	    	CakeLog::write('warning', __("No se pudo conectar con el servidor %s:%s WS nodejs: %s", $url, self::$port, $e->getMessage() ) );
		}
	}
}