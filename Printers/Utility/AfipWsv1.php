<?php

App::uses('AfipWsException', 'Printers.Error');


define ("AFIP_URL_PRODUCCION", "https://ws.afip.gov.ar/wsfev1/service.asmx");
define ("AFIP_URL_PRODUCCION_AUTH", "https://wsaa.afip.gov.ar/ws/services/LoginCms");

define ("AFIP_URL_DESARROLLO", "https://wswhomo.afip.gov.ar/wsfev1/service.asmx");
define ("AFIP_URL_DESARROLLO_AUTH", "https://wsaahomo.afip.gov.ar/ws/services/LoginCms");


define("AFIP_URL", AFIP_URL_DESARROLLO);
define("AFIP_URL_AUTH", AFIP_URL_DESARROLLO_AUTH);




/* with trailing slash */
define('PRINTERS_PUBLIC_FILES_DIR', ROOT . DS . APP_DIR . DS . 'Vendor' . DS . 'ristorantino' . DS . 'plugins' . DS . 'Printers' .  DS . 'webroot' . DS . 'public_files' . DS );
define('PRINTERS_FILES_DIR', ROOT . DS . APP_DIR . DS . 'Vendor' . DS . 'ristorantino' . DS . 'plugins' . DS . 'Printers' .  DS . 'webroot' . DS . 'files' . DS );

define ("WSDLFE",  PRINTERS_PUBLIC_FILES_DIR . 'wsfe.wsdl' );     # The WSDL corresponding to WSAA
define ("WSDL",  PRINTERS_PUBLIC_FILES_DIR . 'wsaa.wsdl' );     # The WSDL corresponding to WSAA
define ("CERT", PRINTERS_FILES_DIR ."afip.crt");       # The X.509 certificate in PEM format
define ("PRIVATEKEY", PRINTERS_FILES_DIR . "id_rsa"); # The private key correspoding to CERT (PEM)
define ("PASSPHRASE", Configure::read("Afip.id_rsa.passphrase")); # The passphrase (if any) to sign


define ("TA", TMP . "TA.xml");



define("AFIP_XML_EMPTY_FILE", 4);
define ("TIPO_FACTURA_A", '001');
define ("TIPO_FACTURA_B", '006');
define ("TIPO_FACTURA_C", 11);
define ("AFIP_TIPO_IVA_21", 5);



class AfipWsv1 {

	const CLIENTE_TIPO_DOCUMENTO_SIN_IDENTIFICAR = 99;

	const CONCEPTO_SERVICIO = 2;
	const CONCEPTO_PRODUCTOS_Y_SERVICIOS = 3;

   
 	static $client = null;




	static $tipoConceptos = array(
			1	=>	'Producto / Exportación definitiva de bienes',
			self::CONCEPTO_SERVICIO	=>	'Servicios',
			self::CONCEPTO_PRODUCTOS_Y_SERVICIOS	=>	'Productos y Servicios',
			4	=>	'Otro',
		);



	static $codigoProvincias = array(
			0	=> 'Ciudad Autónoma de Buenos Aires',
			1	=> 'Buenos Aires',
			2	=> 'Catamara',
			3	=> 'Córdoba',
			4	=> 'Corrientes',
			5	=> 'Entre Ríos',
			6	=> 'Jujuy',
			7	=> 'Mendoza',
			8	=> 'La Rioja',
			9	=> 'Salta',
			10	=> 'San Juan',
			11	=> 'San Luis',
			12	=> 'Santa Fe',
			13	=> 'Santiago del Estero',
			14	=> 'Tucumán',
			16	=> 'Chaco',
			17	=> 'Chubut',
			18	=> 'Formosa',
			19	=> 'Misiones',
			20	=> 'Neuquén',
			21	=> 'La Pampa',
			22	=> 'Río Negro',
			23	=> 'Santa Cruz',
			24	=> 'Tierra del Fuego',
		);



	static $tipoDOcumentos = array(
			80	=>	'CUIT',
			86	=>	'CUIL',
			87	=>	'CDI',
			89	=>	'LE',
			90	=>	'LC',
			91	=>	'CI extranjera',
			92	=>	'en trámite',
			93	=>	'Acta nacimiento',
			94	=>	'Pasaporte',
			95	=>	'CI Bs. As. RNP',
			96	=>	'DNI',
			99	=>	'Sin identificar/venta global diaria',
			30	=>	'Certificado de Migración',
			88	=>	'Usado por Anses para Padrón',
		);


	static $tipoResponsabilidadesIva = array(
			'1'		=>	'IVA Responsable Inscripto',
			'2'		=>	'IVA Responsable no Inscripto',
			'3'		=>	'IVA no Responsable',
			'4'		=>	'IVA Sujeto Exento',
			'5'		=>	'Consumidor Final',
			'6'		=>	'Responsable Monotributo',
			'7'		=>	'Sujeto no Categorizado',
			'8'		=>	'Proveedor del Exterior',
			'9'		=>	'Cliente del Exterior',
			'10'	=>	'IVA Liberado – Ley Nº 19.640',
			'11'	=>	'IVA Responsable Inscripto – Agente de Percepción',
			'12'	=>	'Pequeño Contribuyente Eventual',
			'13'	=>	'Monotributista Social',
			'14'	=>	'Pequeño Contribuyente Eventual Social',
		);



	static $monedas = array(
			'000'	=>	'OTRAS MONEDAS',
			'PES'	=> 	'PESOS',
			'DOL'	=> 	'Dólar ESTADOUNIDENSE',
			'002'	=>	'Dólar EEUU LIBRE',
			'003'	=>	'FRANCOS FRANCESES',
			'004'	=>	'LIRAS ITALIANAS',
			'005'	=>	'PESETAS',
			'006'	=>	'MARCOS ALEMANES',
			'007'	=>	'FLORINES HOLANDESES',
			'008'	=>	'FRANCOS BELGAS',
			'009'	=>	'FRANCOS SUIZOS',
			'010'	=>	'PESOS MEJICANOS',
			'011'	=>	'PESOS URUGUAYOS',
			'012'	=>	'REAL',
			'013'	=>	'ESCUDOS PORTUGUESES',
			'014'	=>	'CORONAS DANESAS',
			'015'	=>	'CORONAS NORUEGAS',
			'016'	=>	'CORONAS SUECAS',
			'017'	=>	'CHELINES AUTRIACOS',
			'018'	=>	'Dólar CANADIENSE',
			'019'	=>	'YENS',
			'021'	=>	'LIBRA ESTERLINA',
			'022'	=>	'MARCOS FINLANDESES',
			'023'	=>	'BOLIVAR (VENEZOLANO',
			'024'	=>	'CORONA CHECA',
			'025'	=>	'DINAR (YUGOSLAVO)',
			'026'	=>	'Dólar AUSTRALIANO',
			'027'	=>	'DRACMA (GRIEGO)',
			'028'	=>	'FLORIN (ANTILLAS HOLA',
			'029'	=>	'GUARANI',
			'030'	=>	'SHEKEL (ISRAEL)',
			'031'	=>	'PESO BOLIVIANO',
			'032'	=>	'PESO COLOMBIANO',
			'033'	=>	'PESO CHILENO',
			'034'	=>	'RAND (SUDAFRICANO',
			'035'	=>	'NUEVO SOL PERUANO',
			'036'	=>	'SUCRE (ECUATORIANO)',
			'040'	=>	'LEI RUMANOS',
			'041'	=>	'DERECHOS ESPECIALES DE GIRO',
			'042'	=>	'PESOS DOMINICANOS',
			'043'	=>	'BALBOAS PANAMEÑAS',
			'044'	=>	'CORDOBAS NICARAGÛENSES',
			'045'	=>	'DIRHAM MARROQUÍES',
			'046'	=>	'LIBRAS EGIPCIAS',
			'047'	=>	'RIYALS SAUDITAS',
			'048'	=>	'BRANCOS BELGAS FINANCIERA',
			'049'	=>	'GRAMOS DE ORO FINO',
			'050'	=>	'LIBRAS IRLANDESAS',
			'051'	=>	'Dólar DE HONG KONG',
			'052'	=>	'Dólar DE SINGAPUR',
			'053'	=>	'Dólar DE JAMAICA',
			'054'	=>	'Dólar DE TAIWAN',
			'055'	=>	'QUETZAL (GUATEMALTECOS)',
			'056'	=>	'FORINT (HUNGRIA)',
			'057'	=>	'BAHT (TAILANDIA)',
			'058'	=>	'ECU',
			'059'	=>	'DINAR KUWAITI',
			'060'	=>	'EURO',
			'061'	=>	'ZLTYS POLACOS',
			'062'	=>	'RUPIAS HINDÚES',
			'063'	=>	'LEMPIRAS HONDUREÑAS',
			'064'	=>	'YUAN (Rep. Pop. China',
		);



	static $otrosImpuestos = array(
			'01'	=>	'Impuestos nacionales',
			'02'	=>	'Impuestos provinciales',
			'03'	=>	'Impuestos municipales',
			'04'	=>	'Impuestos internos',
			'99'	=>	'Otros',
		);



	static $condicionesIva = array(
			'0'	=>	'No Corresponde', // este no se aplica en factura electronica
			'1'	=>	'No Gravado',
			'2'	=>	'Exento',
			'3'	=>	'0%',
			'4'	=>	'10,50%',
			AFIP_TIPO_IVA_21	=>	'21%',
			'6'	=>	'27%',
			'7'	=>	'Gravado', // Solo valido en Controladores Fiscales
			'8'	=>	'5%',
			'9'	=>	'2,50%',
		);
	/**
	*
	*	La tabla fue sacada del siguiente link
	*
	*	https://www.google.com.ar/url?sa=t&rct=j&q=&esrc=s&source=web&cd=3&cad=rja&uact=8&ved=0CCgQFjAC&url=http%3A%2F%2Fwww.afip.gob.ar%2Fgenericos%2Ffe%2Fdocumentos%2FTABLAS%2520GENERALES%2520V.0.1%2520%252026012011.xls&ei=_oIXVdSXJsnjsASy7oHYBg&usg=AFQjCNHlL-HWnImuSXpWrXwMcR9sZ3T-PQ&sig2=qYSKHzJDhmI5RvvpMLBLvg&bvm=bv.89381419,d.cWc
	*/
	static $tipoComprobantes = array(
			1  =>	'"A"',
			2  =>	'NOTAS DE DEBITO A',
			3  =>	'NOTAS DE CREDITO A',
			4  =>	'RECIBOS A',
			5  =>	'NOTAS DE VENTA AL CONTADO A',
			6  =>	'"B"',
			7  =>	'NOTAS DE DEBITO B',
			8  =>	'NOTAS DE CREDITO B',
			9  =>	'RECIBOS B',
			10  =>	'NOTAS DE VENTA AL CONTADO B',
			11  =>	'"C"',
			12  =>	'NOTAS DE DEBITO C',
			13  =>	'NOTAS DE CREDITO C',
			14  =>	'DOCUMENTO ADUANERO',
			15  =>	'RECIBOS C',
			16  =>	'NOTAS DE VENTA AL CONTADO C',
			19  =>	'FACTURAS DE EXPORTACION',
			20  =>	'NOTAS DE DEBITO POR OPERACIONES CON EL EXTERIOR',
			21  =>	'NOTAS DE CREDITO POR OPERACIONES CON EL EXTERIOR',
			22  =>	'FACTURAS - PERMISO EXPORTACION SIMPLIFICADO - DTO. 855/97',
			30  =>	'COMPROBANTES DE COMPRA DE BIENES USADOS',
			31  =>	'MANDATO - CONSIGNACION',
			32  =>	'COMPROBANTES PARA RECICLAR MATERIALES',
			34  =>	'COMPROBANTES A DEL APARTADO A  INCISO F  R G  N  1415',
			35  =>	'COMPROBANTES B DEL ANEXO I, APARTADO A, INC. F), RG N° 1415',
			36  =>	'COMPROBANTES C DEL Anexo I, Apartado A, INC.F), R.G. N° 1415',
			37  =>	'NOTAS DE DEBITO O DOCUMENTO EQUIVALENTE QUE CUMPLAN CON LA R.G. N° 1415',
			38  =>	'NOTAS DE CREDITO O DOCMENTO EQUIVALENTE QUE CUMPLAN CON LA R.G. N° 1415',
			39  =>	'OTROS COMPROBANTES A QUE CUMPLEN CON LA R G  1415',
			40  =>	'OTROS COMPROBANTES B QUE CUMPLAN CON LA R.G. N° 1415',
			41  =>	'OTROS COMPROBANTES C QUE CUMPLAN CON LA R.G. N° 1415',
			50  =>	'RECIBO FACTURA A  REGIMEN DE FACTURA DE CREDITO ',
			51  =>	'FACTURAS M',
			52  =>	'NOTAS DE DEBITO M',
			53  =>	'NOTAS DE CREDITO M',
			54  =>	'RECIBOS M',
			55  =>	'NOTAS DE VENTA AL CONTADO M',
			56  =>	'COMPROBANTES M DEL ANEXO I  APARTADO A  INC F   R G  N  1415',
			57  =>	'OTROS COMPROBANTES M QUE CUMPLAN CON LA R G  N  1415',
			58  =>	'CUENTAS DE VENTA Y LIQUIDO PRODUCTO M',
			59  =>	'LIQUIDACIONES M',
			60  =>	'CUENTAS DE VENTA Y LIQUIDO PRODUCTO A',
			61  =>	'CUENTAS DE VENTA Y LIQUIDO PRODUCTO B',
			63  =>	'LIQUIDACIONES A',
			64  =>	'LIQUIDACIONES B',
			65  =>	'NOTAS DE CREDITO DE COMPROBANTES CON COD. 34, 39, 58, 59, 60, 63, 96, 97 ',
			66  =>	'DESPACHO DE IMPORTACION',
			67  =>	'IMPORTACION DE SERVICIOS',
			68  =>	'LIQUIDACION C',
			70  =>	'RECIBOS FACTURA DE CREDITO',
			71  =>	'CREDITO FISCAL POR CONTRIBUCIONES PATRONALES',
			73  =>	'FORMULARIO 1116 RT',
			74  =>	'CARTA DE PORTE PARA EL TRANSPORTE AUTOMOTOR PARA GRANOS',
			75  =>	'CARTA DE PORTE PARA EL TRANSPORTE FERROVIARIO PARA GRANOS',
	);


	static  $authVars = null;



	/** @param numeric **/
	static  $CUIT = '';



	static function start () {

		self::$CUIT = Configure::read('Restaurante.cuit');
		self::conectarClienteSoap();
		self::checkAfipWServicesStatus();
		self::verifyAuth ();
	}


	static  function loadTAfile () {
		if (!file_exists(TA)) {
			self::autenticar ();			
		}

		libxml_use_internal_errors(true); // suprimir mensajes de warning
		$TA = simplexml_load_file(TA);
		foreach (libxml_get_errors() as $error) {
			if ( $error->code == AFIP_XML_EMPTY_FILE ) {
				self::autenticar ();
			} else {
	        	throw new AfipWsException($error->message, $error->code);
			}
	    }
	    if ( $TA === false ) {
	    	throw new AfipWsException("Error al leer archivo ".TA);
	    }
	    self::$authVars['Token'] = (string) $TA->credentials->token;
		self::$authVars['Sign']  = (string) $TA->credentials->sign;
		self::$authVars['Cuit']  = self::$CUIT * 1; // si lo casteaba se convertia en otro umero
	}


	static function conectarClienteSoap () {

		#==============================================================================
		if (!file_exists(WSDLFE)) {
			throw new AfipWsException("Failed to open ".WSDLFE);
		}
		
		self::loadTAfile();

		self::$client = new SoapClient(WSDLFE, 
		  array('soap_version' => SOAP_1_2,
		        'location'     => AFIP_URL,
		#       'proxy_host'   => "proxy",
		#       'proxy_port'   => 80,
		        'exceptions'   => 0,
		        'trace'        => 1)); # needed by getLastRequestHeaders and others

		if (is_soap_fault( self::$client)) 
	    {	
	    	throw self::soapErrorHandler( self::$client );
	    }
		
		

		return self::$client;
	}


	static function soapErrorHandler( $e) {
		$msg = $e->faultstring;
		$code = $e->faultcode;
		if ( !is_numeric( $e->faultcode ) || (is_numeric( $e->faultcode ) &&  $e->faultcode == 0) ) {
			$code = 1;
		}
		throw new AfipWsException( $msg, $code);
		
	}


	/**
	*
	*	Verifica que este autenticado, caso contrario me autentifica
	*
	*
	**/
	static function verifyAuth (){
		if ( self::$client === null ) {
			self::autenticar();
		}
		try{
			$res = self::FEParamGetTiposTributos();
		} catch (Exception $e) {
			// expiro la sesion
			self::autenticar();
		}
		return true;
	}





    static function autenticar () {

    	ini_set("soap.wsdl_cache_enabled", "0");
		if (!file_exists(CERT)) {
			throw new AfipWsException("Failed to open ".CERT);
		}
		if (!file_exists(PRIVATEKEY)) {
			throw new AfipWsException("Failed to open ".PRIVATEKEY."\n");
		}
		if (!file_exists(WSDL)) {
			throw new AfipWsException("Failed to open ".WSDL."\n");
		}

		self::__createTRA();
		$CMS = self::__signTRA();
		$TA = self::__callWSAA($CMS);


		if ( file_put_contents( TA, $TA) === false ) {
			throw new AfipWsException("Error al editar el archivo TA.xml (verificar permisos?) en " . TMP . DS . "TA.xml");
		}
		return $TA;
    }

/*
    public function __callWSFE($CMS)
	{
	  $client = new SoapClient(WSDLFE, array(
	         // 'proxy_host'     => PROXY_HOST,
	         // 'proxy_port'     => PROXY_PORT,
	          'soap_version'   => SOAP_1_2,
	          'location'       => AFIP_URL_AUTH,
	          'trace'          => 1,
	          'exceptions'     => 0
	          )); 
	  $results=$client->loginCms(array('in0'=>$CMS));
	  file_put_contents("request-loginCms.xml",$client->__getLastRequest());
	  file_put_contents("response-loginCms.xml",$client->__getLastResponse());
	  if (is_soap_fault($results)) {
	  	self::soapErrorHandler($results);
	  }
	  return $results->loginCmsReturn;
	}

*/

	#------------------------------------------------------------------------------
	# You shouldn't have to change anything below this line!!!
	#==============================================================================
	static function __createTRA($SERVICE = 'wsfe')
	{
	  $TRA = new SimpleXMLElement(
	    '<?xml version="1.0" encoding="UTF-8"?>' .
	    '<loginTicketRequest version="1.0">'.
	    '</loginTicketRequest>');
	  $TRA->addChild('header');
	  $TRA->header->addChild('uniqueId',date('U'));
	  $TRA->header->addChild('generationTime',date('c',date('U')-60));
	  $TRA->header->addChild('expirationTime',date('c',date('U')+60));
	  $TRA->addChild('service',$SERVICE);
	  $TRA->asXML(TMP . 'TRA.xml');
	}
	#==============================================================================
	# This functions makes the PKCS#7 signature using TRA as input file, CERT and
	# PRIVATEKEY to sign. Generates an intermediate file and finally trims the 
	# MIME heading leaving the final CMS required by WSAA.
	static function __signTRA()
	{
	  $STATUS=openssl_pkcs7_sign(TMP  . "TRA.xml", TMP . "TRA.tmp", "file://".CERT,
	    array("file://".PRIVATEKEY, PASSPHRASE),
	    array(),
	    !PKCS7_DETACHED
	    );
	  if (!$STATUS) {
	  	throw new AfipWsException("ERROR generating PKCS#7 signature");
	  	
	  }
	  $inf=fopen(TMP . "TRA.tmp", "r");
	  $i=0;
	  $CMS="";
	  while (!feof($inf)) 
	    { 
	      $buffer=fgets($inf);
	      if ( $i++ >= 4 ) {$CMS.=$buffer;}
	    }
	  fclose($inf);
	#  unlink("TRA.xml");
	  unlink(TMP . "TRA.tmp");
	  return $CMS;
	}



	/**
	*
	*	Login Soap Afip WS Auth
	*
	*
	**/
	static function __callWSAA($CMS)
	{
	  $client = new SoapClient(WSDL, array(
	         // 'proxy_host'     => PROXY_HOST,
	         // 'proxy_port'     => PROXY_PORT,
	          'soap_version'   => SOAP_1_2,
	          'location'       => AFIP_URL_AUTH,
	          'trace'          => 1,
	          'exceptions'     => 0
	          )); 
	  if (is_soap_fault($client)) 
	    {	
	    	self::soapErrorHandler( $client );
	    }

	  $results = $client->loginCms(array('in0'=>$CMS));
	  if (is_soap_fault($results)) 
	  {	
	    	self::soapErrorHandler( $results );
	  }

	  file_put_contents(TMP . "request-loginCms.xml",$client->__getLastRequest());
	  file_put_contents(TMP . "response-loginCms.xml",$client->__getLastResponse());
	  return $results->loginCmsReturn;
	}



	/**
	*
	*	Permite consultar los datos de un comprobante ya emitido, mediante el tipo y número de comprobante y el punto de venta. 
	*
	**/
	static function FECompConsultar ( $punto_de_venta, $tipo_comprobante, $nro_comprobante ) {

		$res = self::$client->FECompConsultar(  array(  
			'Auth'	   => self::$authVars, 
			'PtoVta'   => $punto_de_venta,
			'CbteTipo' => $tipo_comprobante,
			'CbteNro'  => $nro_comprobante,
			) );
		self::__throwErrorIfExists($res, 'FECompConsultarResult');
		
		return $res;
	}




	static function FECompUltimoAutorizado ( $punto_de_venta, $tipo_comprobante) {

		$res = self::$client->FECompUltimoAutorizado(  array(  
			'Auth'=> self::$authVars, 
			'PtoVta' => $punto_de_venta,
			'CbteTipo' => $tipo_comprobante
			) );

		self::__throwErrorIfExists($res, 'FECompUltimoAutorizadoResult');

		return $res->FECompUltimoAutorizadoResult->CbteNro;

	}

	static function FECAEAConsultar ($periodo = null, $orden = 1) {
		if (empty($periodo)) {
			$periodo = date('Ym');
		}
		$results= self::$client->FECAEAConsultar(
		    array(  'Auth'=> self::$authVars,
		    		'Periodo' => $periodo,
		    		'Orden' => $orden
		    ));

		self::__throwErrorIfExists($results, 'FECAEAConsultarResult');
		  
	}


	/**
	*	Indica los Tipos de Tributos
	* Nacionales, Provinciales, Municipales, Internos, etc etc
	* EJ:
	*	array(
	*		(int) 0 => object(stdClass) {
	*			Id => (int) 1
	*			Desc => 'Impuestos nacionales'
	*			FchDesde => '20100917'
	*			FchHasta => 'NULL'
	*		},
	*
	*
	**/
	static function FEParamGetTiposTributos () {		
		$res = self::$client->FEParamGetTiposTributos( array('Auth'=> self::$authVars));
		
	   	self::__throwErrorIfExists($res, 'FEParamGetTiposTributosResult');
		
		return $res;
	}




	static function FEParamGetTiposCbte () {
		$res = self::$client->FEParamGetTiposCbte( array('Auth'=> self::$authVars));
		
	   	self::__throwErrorIfExists($res, 'FEParamGetTiposCbteResult');

		return $res->FEParamGetTiposCbteResult->ResultGet->CbteTipo;
	}




	static function FECAESolicitar  ( $punto_de_venta,  $tipo_comprobante, $cliente_tipo = self::CLIENTE_TIPO_DOCUMENTO_SIN_IDENTIFICAR, $cliente_doc = 0, $importeNeto, $importeTotal, $importeIva, $ivas = array(), $tributos = array()) {

		$ultComprobanteNumero = self::FECompUltimoAutorizado( $punto_de_venta, $tipo_comprobante );

		$concepto = (int) Configure::read('Afip.concepto');
		$fecha = date('Ymd');
		$data = array(
             'Concepto' => $concepto, // producto o servicio configurado en settings del tenant
			 'DocTipo' => (int)$cliente_tipo, // 99 sin identificar; 96 DNI
			 'DocNro' => (float)$cliente_doc, // Lo debo castear a valor numerico Long Int segun WSDL
			 'CbteDesde' => $ultComprobanteNumero + 1,
			 'CbteHasta' => $ultComprobanteNumero + 1,
			 'CbteFch' => $fecha = date('Ymd'),
			 'ImpTotal' => $importeTotal,
			 'ImpTotConc' => 0,
			 'ImpNeto' => $importeNeto,
			 'ImpOpEx' => 0,
			 'ImpTrib' => 0,
			 'ImpIVA' => $importeIva,
			 'MonId' => 'PES',
			 'MonCotiz' => 1,
        );

        if (!empty($ivas)) {
        	$data['Iva'] = $ivas;
        }
        if (!empty($tributos)) {
        	$data['Tributos'] = $tributos;
        }

        if ( $concepto == self::CONCEPTO_SERVICIO || $concepto == self::CONCEPTO_PRODUCTOS_Y_SERVICIOS) {
        	$data['FchServDesde'] = $data['FchServHasta'] = $data['FchVtoPago'] = $fecha;
        }

		$results= self::$client->FECAESolicitar(
		    array(  'Auth'=> self::$authVars,
		    		'FeCAEReq' => array(
		    			'FeCabReq' => array(
			                'CantReg'  => 1, 
			                'PtoVta'   => $punto_de_venta,
			                'CbteTipo' => $tipo_comprobante
			            ),
			            'FeDetReq' => array(
			                'FECAEDetRequest' => $data 
		                )
		    		)
	    		)
		    );


		self::__throwErrorIfExists($results, 'FECAESolicitarResult');

		if ( !empty($results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->Observaciones->Obs)
			 && $results->FECAESolicitarResult->FeCabResp->Resultado == 'R' 
			 )
		    {		    	
				throw new AfipWsException( $results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->Observaciones->Obs );
		}

		return $results;
	}

	private static function __throwErrorIfExists ( $results, $fnName ) {
		
		if ( is_soap_fault($results) ) { 
			self::soapErrorHandler($results);
	   	}


		if (!empty($results->{$fnName }->Errors->Err)){
			throw new AfipWsException( $results->{$fnName }->Errors->Err );
		}
	}


	static function checkAfipWServicesStatus () {
		$res = self::dummy();
		if ( !empty( $res->AppServer) && $res->AppServer != 'OK' ) {
			throw new AfipWsException("El AppServer de la Afip esta caido");
		}

		if ( !empty( $res->DbServer) && $res->DbServer != 'OK' ) {
			throw new AfipWsException("El DbServer de la Afip esta caido");
		}

		if ( !empty( $res->DbServer) && $res->DbServer != 'OK' ) {
			throw new AfipWsException("El DbServer de la Afip esta caido");
		}

		return true;
	}


	/**
	*
	*	Devuelve el estado de la conexion
	*
	*	@return Object FEDummyResult
	*		Obj Attributes:
	*         		AppServer
	*         		DbServer
	*         		AuthServer
	*
	**/
	static function dummy ()
	{
	  $results = self::$client->FEDummy(  array(  'Auth'=> self::$authVars) );
	  self::__throwErrorIfExists ( $results, 'FEDummyResult' );
	  return $results->FEDummyResult;
	}

	static function mapTipoFacturas ( $ristorantinoTipoFactura ) {
		$map = array(
				1 => 1,   // A
				2 => 6,   // B
				4 => 51,  // M
				5 => 11,  // C
			);
		if ( !array_key_exists( $ristorantinoTipoFactura , $map)) {
			throw new CakeException("No existe el mapeo para el tipo de factura del ristorantino ID: " .$ristorantinoTipoFactura );
		}

		return $map[$ristorantinoTipoFactura];
	}




	static function mapResponsabilidadesIva ( $ristorantinoRespIva ) {
		static $map = array(
				1	=> 1,	//		'IVA Responsable Inscripto',
				2	=> 4,	//		'IVA Sujeto Exento',
				3	=> 3,	//		'IVA no Responsable',
				4	=> 5,	//		'Consumidor Final',
				5	=> 7,	//		'Sujeto no Categorizado',
				6	=> 6,	//		'Responsable Monotributo',
				/*
					=> 13,	//	'Monotributista Social',
					=> 2,	//		'IVA Responsable no Inscripto',
					=> 8,	//		'Proveedor del Exterior',
					=> 9,	//		'Cliente del Exterior',
					=> 10,	//	'IVA Liberado – Ley Nº 19.640',
					=> 11,	//	'IVA Responsable Inscripto – Agente de Percepción',
					=> 12,	//	'Pequeño Contribuyente Eventual',
					=> 14,	//	'Pequeño Contribuyente Eventual Social',
				*/
		);
		if ( !array_key_exists( $ristorantinoRespIva , $map)) {
			throw new CakeException("No existe el mapeo para el tipo de responsabilidad Iva del ristorantino ID: " .$ristorantinoRespIva );
		}

		return $map[$ristorantinoRespIva];

	}

	static function mapTipoIva ( $ristorantinoTipoIva ) {
		$map = array(
			RISTO_IVA_0 => '1', //	=>	'No Gravado',
			RISTO_IVA_21 => AFIP_TIPO_IVA_21	, // => 	'21%',
		);

		if ( !array_key_exists( $ristorantinoTipoIva , $map )) {
			throw new CakeException("No existe el mapeo para el tipo de IVA del ristorantino ID: " .$ristorantinoTipoDOcumento );
		}

		return $map[$ristorantinoTipoIva];
	}

	static function mapTipoDocumentoComprador ( $ristorantinoTipoDOcumento ) {
		$map = array(
					1	=> '80',	//	'CUIT
					2	=> '86',	//	'CUIL
					3	=> '89',	//	'LE
					4	=> '90',	//	'LC
					5	=> '96',	// 'DNI
					6	=> '94',	// 'Pasaporte
					7	=> '0',		//	'CI Policía Federal
					8	=> '99',	//	'Sin identificar/venta global diaria
					/*
						=> '1'		//	'CI Buenos Aires
						=> '2'		//	'CI Catamarca
						=> '3'		//	'CI Córdoba
						=> '4'		//	'CI Corrientes
						=> '5'		//	'CI Entre Ríos
						=> '6'		//	'CI Jujuy
						=> '7'		//	'CI Mendoza
						=> '8'		//	'CI La Rioja
						=> '9'		//	'CI Salta
						=> '10'	//	'CI San Juan
						=> '11'	//	'CI San Luis
						=> '12'	//	'CI Santa Fe
						=> '13'	//	'CI Santiago del Estero
						=> '14'	//	'CI Tucumán
						=> '16'	//	'CI Chaco
						=> '17'	//	'CI Chubut
						=> '18'	//	'CI Formosa
						=> '19'	//	'CI Misiones
						=> '20'	//	'CI Neuquén
						=> '21'	//	'CI La Pampa
						=> '22'	//	'CI Río Negro
						=> '23'	//	'CI Santa Cruz
						=> '24'	//	'CI Tierra del Fuego
						=> '87'	//	'CDI
						=> '91'	//	'CI extranjera
						=> '92'	//	'en trámite
						=> '93'	//	'Acta nacimiento
						=> '95'	//	'CI Bs. As. RNP
						=> '30'	//	'Certificado de Migración
						=> '88'	// 'Usado por Anses para Padrón
						*/
				);

		if ( !array_key_exists( $ristorantinoTipoDOcumento , $map)) {
			throw new CakeException("No existe el mapeo para el tipo de documento del ristorantino ID: " .$ristorantinoTipoDOcumento );
		}

		return $map[$ristorantinoTipoDOcumento];

	}
    
}

