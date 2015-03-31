<?php

App::uses('AfipWsException', 'Printers.Error');


define ("AFIP_URL_PRODUCCION", "https://wsaa.afip.gov.ar/");
define ("AFIP_URL_DESARROLLO", "https://wsaahomo.afip.gov.ar/");



/* with trailing slash */
define('PRINTERS_PUBLIC_FILES_DIR', ROOT . DS . APP_DIR . DS . 'Vendor' . DS . 'ristorantino' . DS . 'plugins' . DS . 'Printers' .  DS . 'webroot' . DS . 'public_files' . DS );
define('PRINTERS_FILES_DIR', ROOT . DS . APP_DIR . DS . 'Vendor' . DS . 'ristorantino' . DS . 'plugins' . DS . 'Printers' .  DS . 'webroot' . DS . 'files' . DS );

define ("WSDLFE",  PRINTERS_FILES_DIR . 'wsfe.wsdl' );     # The WSDL corresponding to WSAA
define ("WSDL",  PRINTERS_FILES_DIR . 'wsaa.wsdl' );     # The WSDL corresponding to WSAA
define ("CERT", PRINTERS_FILES_DIR ."afip.crt");       # The X.509 certificate in PEM format
define ("PRIVATEKEY", PRINTERS_FILES_DIR . "id_rsa"); # The private key correspoding to CERT (PEM)
define ("PASSPHRASE", Configure::read("Afip.id_rsa.passphrase"); # The passphrase (if any) to sign


define ("URLFE", AFIP_URL_DESARROLLO . "wsfev1/service.asmx");
define ("URL", AFIP_URL_DESARROLLO . "ws/services/LoginCms");

define ("TA", TMP . DS . "TA.xml");


define ("TIPO_FACTURA_A", '001');
define ("TIPO_FACTURA_B", '006');
define ("TIPO_IVA_21", '5');


/** archivos por usuario **/

define ("PTO_VTA", 1);
define ("CUIT", Configure::read('Restaurante.cuit'));     # CUIT del emisor de las facturas









App::uses('PrinterHelperSkel', 'Printers.Lib/DriverView/Helper');

class AfipWsFeV1AfipHelper extends PrinterHelperSkel
{
    
 	var $client = null;




	var $tipoConceptos = array(
			1	=>	'Producto / Exportación definitiva de bienes',
			2	=>	'Servicios',
			3	=>	'Productos y Servicios',
			4	=>	'Otro',
		);



	var $codigoProvincias = array(
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



	var $tipoDOcumentos = array(
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


	var $tipoResponsabilidadesIva = array(
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



	var $monedas = array(
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



	var $otrosImpuestos = array(
			'01'	=>	'Impuestos nacionales',
			'02'	=>	'Impuestos provinciales',
			'03'	=>	'Impuestos municipales',
			'04'	=>	'Impuestos internos',
			'99'	=>	'Otros',
		);



	var $condicionesIva = array(
			'0'	=>	'No Corresponde', // este no se aplica en factura electronica
			'1'	=>	'No Gravado',
			'2'	=>	'Exento',
			'3'	=>	'0%',
			'4'	=>	'10,50%',
			TIPO_IVA_21	=>	'21%',
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
	var $tipoComprobantes = array(
			1  =>	'FACTURA "A"',
			2  =>	'NOTAS DE DEBITO A',
			3  =>	'NOTAS DE CREDITO A',
			4  =>	'RECIBOS A',
			5  =>	'NOTAS DE VENTA AL CONTADO A',
			6  =>	'FACTURA "B"',
			7  =>	'NOTAS DE DEBITO B',
			8  =>	'NOTAS DE CREDITO B',
			9  =>	'RECIBOS B',
			10  =>	'NOTAS DE VENTA AL CONTADO B',
			11  =>	'FACTURA "C"',
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


	var $authVars = array(
		'Token' => "",
		'Sign' 	=> "",
		'Cuit'	=> ""
		);



	/** @param numeric **/
	var $CUIT = '',  




	function __construct (View $View, $settings = array()) {
		parent::__construct($View, $settings );


		$this->CUIT = Configure::read('Restaurante.cuit';
		$this->PTO_VTA = Configure::read('Restaurante.punto_de_venta';

		$this->conectarClienteSoap();

		$this->verifyAuth ();
	
	}


	public function conectarClienteSoap () {


		#==============================================================================
		if (!file_exists(WSDLFE)) {exit("Failed to open ".WSDLFE."\n");}
		if (!file_exists(TA)) {exit("Failed to open ".TA."\n");}
		$this->client = new SoapClient(WSDLFE, 
		  array('soap_version' => SOAP_1_2,
		        'location'     => URLFE,
		#       'proxy_host'   => "proxy",
		#       'proxy_port'   => 80,
		        'exceptions'   => 0,
		        'trace'        => 1)); # needed by getLastRequestHeaders and others

		if (is_soap_fault($this->client )) 
	    {	
	    	throw new AfipWsException( $this->client->faultstring , $this->client->faultcode);
	    }
		
		$TA = simplexml_load_file(TA);
		
		$this->authVars['Token'] = $TA->credentials->token;
		$this->authVars['Sign']  = $TA->credentials->sign;
		$this->authVars['Cuit']  = $this->CUIT;

		return $this->client;
	}


	public function verifyAuth (){
		try{
			$this->FEParamGetTiposTributos();
		} catch (Exception $e) {
			if ( $e->getCode() == 600 ) {
				// expiro la sesion
				$this->autenticar();
			}
		}
		return true;
	}


	public function exceptionHandler ( $exp ) {
		switch ( $exp->getCode() ) {
			case 600:
				$this->autenticar();
				break;
			default:
				throw $exp;
				break;
		}
	}



    public function autenticar () {

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

		$this->__createTRA();
		$CMS = $this->__signTRA();
		$TA = $this->__callWSAA($CMS);


		if (!file_put_contents(TMP . DS . "TA.xml", $TA)) {
			throw new AfipWsException("Error en " . TMP . DS . "TA.xml");
		}
		return $TA;
    }


    public function __callWSFE($CMS)
	{
	  $client = new SoapClient(WSDLFE, array(
	         // 'proxy_host'     => PROXY_HOST,
	         // 'proxy_port'     => PROXY_PORT,
	          'soap_version'   => SOAP_1_2,
	          'location'       => URL,
	          'trace'          => 1,
	          'exceptions'     => 0
	          )); 
	  $results=$client->loginCms(array('in0'=>$CMS));
	  file_put_contents("request-loginCms.xml",$client->__getLastRequest());
	  file_put_contents("response-loginCms.xml",$client->__getLastResponse());
	  if (is_soap_fault($results)) {
	  	throw new AfipWsException( $results->faultstring , $results->faultcode);
	  }
	  return $results->loginCmsReturn;
	}



	#------------------------------------------------------------------------------
	# You shouldn't have to change anything below this line!!!
	#==============================================================================
	public function __createTRA($SERVICE = 'wsfe')
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
	  $TRA->asXML(TMP . DS . 'TRA.xml');
	}
	#==============================================================================
	# This functions makes the PKCS#7 signature using TRA as input file, CERT and
	# PRIVATEKEY to sign. Generates an intermediate file and finally trims the 
	# MIME heading leaving the final CMS required by WSAA.
	public function __signTRA()
	{
	  $STATUS=openssl_pkcs7_sign(TMP . DS . "TRA.xml", TMP . DS . "TRA.tmp", "file://".CERT,
	    array("file://".PRIVATEKEY, PASSPHRASE),
	    array(),
	    !PKCS7_DETACHED
	    );
	  if (!$STATUS) {exit("ERROR generating PKCS#7 signature\n");}
	  $inf=fopen(TMP . DS . "TRA.tmp", "r");
	  $i=0;
	  $CMS="";
	  while (!feof($inf)) 
	    { 
	      $buffer=fgets($inf);
	      if ( $i++ >= 4 ) {$CMS.=$buffer;}
	    }
	  fclose($inf);
	#  unlink("TRA.xml");
	  unlink(TMP . DS . "TRA.tmp");
	  return $CMS;
	}



	#==============================================================================
	public function __callWSAA($CMS)
	{
	  $client = new SoapClient(WSDL, array(
	         // 'proxy_host'     => PROXY_HOST,
	         // 'proxy_port'     => PROXY_PORT,
	          'soap_version'   => SOAP_1_2,
	          'location'       => URL,
	          'trace'          => 1,
	          'exceptions'     => 0
	          )); 
	  $results = $client->loginCms(array('in0'=>$CMS));
	  file_put_contents(TMP . DS . "request-loginCms.xml",$client->__getLastRequest());
	  file_put_contents(TMP . DS . "response-loginCms.xml",$client->__getLastResponse());
	  if (is_soap_fault($results)) 
	    {	
	    	throw new AfipWsException( $results->faultstring , $results->faultcode);
	    }
	  return $results->loginCmsReturn;
	}



	/**
	*
	*	Permite consultar los datos de un comprobante ya emitido, mediante el tipo y número de comprobante y el punto de venta. 
	*
	**/
	public function FECompConsultar ( $punto_de_venta, $tipo_comprobante, $nro_comprobante ) {
		$res = $this->client->FECompUltimoAutorizado(  array(  
			'Auth'	   => $this->authVars, 
			'PtoVta'   => $punto_de_venta,
			'CbteTipo' => $tipo_comprobante,
			'CbteNro'  => $nro_comprobante,
			) );
		
		return $res;
	}




	public function FECompUltimoAutorizado ( $punto_de_venta, $tipo_comprobante = TIPO_FACTURA_B) {
		$res = $this->client->FECompUltimoAutorizado(  array(  
			'Auth'=> $this->authVars, 
			'PtoVta' => $punto_de_venta,
			'CbteTipo' => $tipo_comprobante
			) );
		if (  !isset($res->FECompUltimoAutorizadoResult->CbteNro) || !is_numeric( $res->FECompUltimoAutorizadoResult->CbteNro) )
	    {	    	
			throw new AfipWsException( sprintf( "Vino algo en el ultimo numero de comprobante que no es numerico o vino vacio: %s", $res->FECompUltimoAutorizadoResult->CbteNro) );
	    }
		return $res->FECompUltimoAutorizadoResult->CbteNro;
	}

	public function FECAEAConsultar ($periodo = null, $orden = 1) {
		if (empty($periodo)) {
			$periodo = date('Ym');
		}
		$results= $this->client->FECAEAConsultar(
		    array(  'Auth'=> $this->authVars,
		    		'Periodo' => $periodo,
		    		'Orden' => $orden
		    ));
		  if ( $results->FECAEAConsultarResult->Errors->Err->Code != 0 )
		    {
				throw new AfipWsException( $results->FECAEAConsultarResult->Errors->Err->Msg, $results->FECAEAConsultarResult->Errors->Err->Code );
		    }
		  
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
	public function FEParamGetTiposTributos () {
		$res = $this->client->FEParamGetTiposTributos( array('Auth'=> $this->authVars));
		if ( !empty( $res->FEParamGetTiposTributosResult->Errors ) ){
			throw new AfipWsException( $res->FEParamGetTiposTributosResult->Errors->Err->Msg, $res->FEParamGetTiposTributosResult->Errors->Err->Code );
		} 
		return $res->FEParamGetTiposTributosResult->ResultGet->TributoTipo;
	}





	public function FECAESolicitar  ( $punto_de_venta,  $tipo_comprobante ) {
		if (empty($periodo)) {
			$periodo = date('Ym');
		}

		$ultComprobanteNumero = $this->FECompUltimoAutorizado( $this->PTO_VTA );

		$results= $this->client->FECAESolicitar(
		    array(  'Auth'=> $this->authVars,
		    		'FeCAEReq' => array(
		    			'FeCabReq' => array(
			                'CantReg'  => 1, 
			                'PtoVta'   => $punto_de_venta,
			                'CbteTipo' => $tipo_comprobante
			            ),
			            'FeDetReq' => array(
			                'FECAEDetRequest' => array(
			                     'Concepto' => 1, // producto
								 'DocTipo' => 96, // 99 sin identificar; 96 DNI
								 'DocNro' => 31025654,
								 'CbteDesde' => $ultComprobanteNumero + 1,
								 'CbteHasta' => $ultComprobanteNumero + 1,
								 'CbteFch' => date('Ymd'),
								 'ImpTotal' => 1210,
								 'ImpTotConc' => 0,
								 'ImpNeto' => 1000,
								 'ImpOpEx' => 0,
								 'ImpTrib' => 0,
								 'ImpIVA' => 210,
								 'MonId' => 'PES',
								 'MonCotiz' => 1,
				                 'Iva' => array(
				                 	'AlicIva' => array(
				                		'Id' => TIPO_IVA_21,
				                		'BaseImp' => 1000,
				                		'Importe' => 210
			                		)
			                	)
			                ),
		                )
		    		)
	    		)
		    );
		if ( $results->FECAESolicitarResult->FeCabResp->Resultado == 'R' && $results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->Observaciones->Obs->Code != 0 )
		    {
				throw new AfipWsException( $results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->Observaciones->Obs->Msg, $results->FECAESolicitarResult->FeDetResp->FECAEDetResponse->Observaciones->Obs->Code );
		}

		return $results;
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
	public function dummy ()
	{
		
	  $results = $this->client->FEDummy();
	 
	  if (is_soap_fault($results)) { 
		   	throw new AfipWsException($results->faultstring, $results->faultcode );
	   }
	  return $results->FEDummyResult;
	}
    
}

