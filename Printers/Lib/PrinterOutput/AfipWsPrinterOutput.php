<?php

App::uses('PrinterOutput', 'Printers.PrinterOutput');


/* with trailing slash */
define('PRINTERS_FILES_DIR', ROOT . DS . APP_DIR . DS . 'Vendor' . DS . 'ristorantino' . DS . 'plugins' . DS . 'Printers' .  DS . 'webroot' . DS . 'files' . DS );

define ("WSDLFE",  PRINTERS_FILES_DIR . 'wsfe.wsdl' );     # The WSDL corresponding to WSAA
define ("TA", TMP . DS . "TA.xml");
define ("URLFE", "https://wswhomo.afip.gov.ar/wsfev1/service.asmx");


define ("WSDL",  PRINTERS_FILES_DIR . 'wsaa.wsdl' );     # The WSDL corresponding to WSAA
define ("CERT", PRINTERS_FILES_DIR ."afip.crt");       # The X.509 certificate in PEM format
define ("PRIVATEKEY", PRINTERS_FILES_DIR . "id_rsa"); # The private key correspoding to CERT (PEM)
define ("PASSPHRASE", "@lejandroernesto"); # The passphrase (if any) to sign
define ("PROXY_HOST", "10.20.152.112"); # Proxy IP, to reach the Internet
define ("PROXY_PORT", "80");            # Proxy TCP port
define ("URL", "https://wsaahomo.afip.gov.ar/ws/services/LoginCms");
#define ("URL", "https://wsaa.afip.gov.ar/ws/services/LoginCms");

define ("CUIT", 20303683268);     # CUIT del emisor de las facturas


class AfipWsPrinterOutput extends PrinterOutput
{
/**
 * Engine Name
 * 
 * @var string
 */    
    public  $name = "AfipWs";
    

    
/**
 * Returns the description of the print engine
 * @return string
 */        
    public  function description(){
        return "Sends files to print with Afip WS creating a PDF file";
    }
    
    
/**
 *  Do the print
 * 
 * @param string $texto es el texto a imprimir
 * @param string $nombreImpresoraFiscal nombre de la impresora 
 * @param string $hostname nombre o IP del host
 * 
 * @return type boolean true si salio todo bien false caso contrario
 */
    public  function send( $texto, $nombreImpresoraFiscal, $hostname = '' ) {
    	//$this->autenticar();
		
		debug("ingresando");

    	$cliente = new ClienteFacturaElectronica();

    }



    public function autenticar () {

    	ini_set("soap.wsdl_cache_enabled", "0");
		if (!file_exists(CERT)) {
			throw new CakeException("Failed to open ".CERT);
		}
		if (!file_exists(PRIVATEKEY)) {
			throw new CakeException("Failed to open ".PRIVATEKEY."\n");
		}
		if (!file_exists(WSDL)) {
			throw new CakeException("Failed to open ".WSDL."\n");
		}

		$this->__createTRA();
		$CMS = $this->__signTRA();
		$TA = $this->__callWSAA($CMS);


		if (!file_put_contents(TMP . DS . "TA.xml", $TA)) {
			throw new CakeException("Error en " . TMP . DS . "TA.xml");
		}

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
	  if (is_soap_fault($results)) 
	    {exit("SOAP Fault: ".$results->faultcode."\n".$results->faultstring."\n");}
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
	  $client=new SoapClient(WSDL, array(
	         // 'proxy_host'     => PROXY_HOST,
	         // 'proxy_port'     => PROXY_PORT,
	          'soap_version'   => SOAP_1_2,
	          'location'       => URL,
	          'trace'          => 1,
	          'exceptions'     => 0
	          )); 
	  $results=$client->loginCms(array('in0'=>$CMS));
	  file_put_contents(TMP . DS . "request-loginCms.xml",$client->__getLastRequest());
	  file_put_contents(TMP . DS . "response-loginCms.xml",$client->__getLastResponse());
	  if (is_soap_fault($results)) 
	    {exit("SOAP Fault: ".$results->faultcode."\n".$results->faultstring."\n");}
	  return $results->loginCmsReturn;
	}




}


class ClienteFacturaElectronica {

	var $client = null;


	var $authVars = array(
		'Token' => "",
		'Sign' 	=> "",
		'Cuit'	=> ""
		);


	function __construct () {
		
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
		
		$TA = simplexml_load_file(TA);
		
		$this->authVars['Token'] = $TA->credentials->token;
		$this->authVars['Sign']  = $TA->credentials->sign;
		$this->authVars['Cuit']  = CUIT;

		
		$QTY=$this->FECAEAConsultar ();


		/*
		printf ("QTY: %s\n", $QTY);
		$LastID=$this->UltNro($client, $token, $sign, CUIT);
		printf ("LastID: %s\n", $LastID);
		$LastCBTE=$this->RecuperaLastCMP($client, $token, $sign, CUIT, 1, 1);
		printf ("LastCBTE: %s\n", $LastCBTE);
		$CAE=$this->Aut($client, $token, $sign, CUIT, $LastID + 1, $LastCBTE + 1);
		printf ("CAE: %s\n", $CAE);
		*/
		die;
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
		debug($results);
		  if ( $results->FECAEAConsultarResult->Errors->Err->Code != 0 )
		    {
		    	$errorMsg = sprintf ("Percode: %d\nPerrmsg: %s\n", 
		          $results->FECAEAConsultarResult->Errors->Err->Code,
		          $results->FECAEAConsultarResult->Errors->Err->Msg);
	      	
				throw new CakeException( $errorMsg );
					      		      
		    }
		  
	}

	
	#==============================================================================
	public function RecuperaLastCMP ($client, $token, $sign, $cuit, $ptovta, $tipocbte)
	{
	  $results=$client->FERecuperaLastCMPRequest(
	    array('argAuth' =>  array('Token'    => $token,
	                              'Sign'     => $sign,
	                              'cuit'     => $cuit),
	           'argTCMP' => array('PtoVta'   => $ptovta,
	                              'TipoCbte' => $tipocbte)));
	  if ( $results->FERecuperaLastCMPRequestResult->RError->percode != 0 )
	    {
	      printf ("Percode: %d\nPerrmsg: %s\n", 
	          $results->FERecuperaLastCMPRequestResult->RError->percode,
	          $results->FERecuperaLastCMPRequestResult->RError->perrmsg);
	      exit("Error");
	    }
	  return $results->FERecuperaLastCMPRequestResult->cbte_nro;
	}
	#==============================================================================
	public function Aut ($client, $token, $sign, $cuit, $ID, $cbte)
	{
	  $results=$client->FEAutRequest(
	    array('argAuth' => array(
	             'Token' => $token,
	             'Sign'  => $sign,
	             'cuit'  => $cuit),
	          'Fer' => array(
	             'Fecr' => array(
	                'id' => $ID, 
	                'cantidadreg' => 1, 
	                'presta_serv' => 0),
	             'Fedr' => array(
	                'FEDetalleRequest' => array(
	                   'tipo_doc' => 80,
	                   'nro_doc' => 23111111113,
	                   'tipo_cbte' => 1,
	                   'punto_vta' => 1,
	                   'cbt_desde' => $cbte,
	                   'cbt_hasta' => $cbte,
	                   'imp_total' => 121.0,
	                   'imp_tot_conc' => 0,
	                   'imp_neto' => 100.0,
	                   'impto_liq' => 21.0,
	                   'impto_liq_rni' => 0.0,
	                   'imp_op_ex' => 0.0,
	                   'fecha_cbte' => date('Ymd'),
	                   'fecha_venc_pago' => date('Ymd'))))));
	  if ( $results->FEAutRequestResult->RError->percode != 0 )
	    {
	      printf ("Percode: %d\nPerrmsg: %s\n", 
	          $results->FEAutRequestResult->RError->percode,
	          $results->FEAutRequestResult->RError->perrmsg);
	      exit("Error");
	    }
	# printf ("HEADERs:\n%s\n", $client->__getLastRequestHeaders());
	# printf ("REQUEST:\n%s\n", $client->__getLastRequest());
	#  file_put_contents("FE.xml",$client->__getLastResponse());
	  return $results->FEAutRequestResult->FedResp->FEDetalleResponse->cae;
	}
	#==============================================================================
	public function dummy ($client)
	{
	  $results=$client->FEDummy();
	  printf("appserver status: %s\ndbserver status: %s\nauthserver status: %s\n",
	         $results->FEDummyResult->AppServer, 
	         $results->FEDummyResult->DbServer, 
	         $results->FEDummyResult->AuthServer);
	  if (is_soap_fault($results)) 
	   { printf("Fault: %s\nFaultString: %s\n",
	             $results->faultcode, $results->faultstring); 
	     exit (1);
	   }
	  return;
	}
	
}