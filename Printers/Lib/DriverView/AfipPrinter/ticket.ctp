<?php

/**
*
*
*       Variables para generar un ticket
*
*			$this->printaitorObj Expone el Objeto PrintaitorViewObj
*
*
*       @var Array $cliente (opcional) 
*           nombre            
*           nrodocumento
*           responsabiliad_iva
*           tipodocumento
*           domicilio
*       
*       @var String $tipo_factura
*           
*       @var Array $productos
*           nombre
*           cantidad
*           precio
*
*       @var array fullMesa Todo el Objeto Mesa Completo
*
*       @var Float $importe_descuento  (opcional)
*
*       @var String|Int $mozo
*
*       @var String|Int $mesa
*
**/
App::uses('AfipWsv1', 'Printers.Utility');


$pto_venta = Configure::read('Restaurante.punto_de_venta');

$tipo_comprobante = Configure::read('Afip.tipofactura_id');
$cliente_tipo = AfipWsv1::CLIENTE_TIPO_DOCUMENTO_SIN_IDENTIFICAR;
$cliente_doc = 0;
if ( !empty($fullMesa['Cliente'])) {
	$cliente_tipo = AfipWsv1::mapTipoDocumentoComprador( $fullMesa['Cliente']['tipo_documento_id']);
	$cliente_doc = $fullMesa['Cliente']['nrodocumento'];
	if ( !empty($fullMesa['Cliente']['IvaResponsabilidad']) ) {
		$tipo_comprobante = AfipWsv1::mapTipoFacturas( $fullMesa['Cliente']['IvaResponsabilidad']['tipo_factura_id'] );
	}
}
debug($cliente_doc);
// inicio el estado del WS Afip autenticando y verificando conexion
 AfipWsv1::start( $pto_venta );

//AfipWsv1::FEParamGetTiposTributos();

$totalNeto = $fullMesa['Mesa']['subtotal'] / (float) "1.".RISTO_DEFAULT_IVA_PORCENTAJE;
$iva = $fullMesa['Mesa']['total'] - $totalNeto;
$res = AfipWsv1::FECAESolicitar (   $pto_venta
									, $tipo_comprobante
									, $cliente_tipo
									, $cliente_doc
									, $totalNeto
									, $fullMesa['Mesa']['total'] 
									, $iva
								);


$detalleFactura = $res->FECAESolicitarResult->FeDetResp->FECAEDetResponse;
$tipoFactura = AfipWsv1::$tipoComprobantes[ $res->FECAESolicitarResult->FeCabResp->CbteTipo ];


$fechaFacturacionYY = substr($res->FECAESolicitarResult->FeCabResp->FchProceso, 0, 2);
$fechaFacturacionMM = substr($res->FECAESolicitarResult->FeCabResp->FchProceso, 2, 2);
$fechaFacturacionDD = substr($res->FECAESolicitarResult->FeCabResp->FchProceso, 4, 2);
$fechaFacturacionHH = substr($res->FECAESolicitarResult->FeCabResp->FchProceso, 6, 2);
$fechaFacturacionDD = substr($res->FECAESolicitarResult->FeCabResp->FchProceso, 8, 2);
$fechaFacturacionSS = substr($res->FECAESolicitarResult->FeCabResp->FchProceso, 10, 2);
$fechaFacturacion = $fechaFacturacionYY ."/" . $fechaFacturacionMM . "/" .$fechaFacturacionDD . " " .$fechaFacturacionHH. ":" .$fechaFacturacionDD . ":" . $fechaFacturacionSS;


$concepto = AfipWsv1::$tipoConceptos[ $detalleFactura->Concepto ];
$tipoDoc = AfipWsv1::$tipoDOcumentos[ $detalleFactura->DocTipo ];
$numComprobante = $detalleFactura->CbteDesde ;


$numeroComprobanteCompletoPtoVenta = 10000 + $pto_venta ;
$numeroComprobanteCompletoPtoVenta = substr($numeroComprobanteCompletoPtoVenta, 1, 4);

$numeroComprobanteCompletoNumero = 100000000 + $numComprobante ;
$numeroComprobanteCompletoNumero = substr($numeroComprobanteCompletoNumero, 1, 8);

$numeroComprobanteFullSTring = $numeroComprobanteCompletoPtoVenta . "-" . $numeroComprobanteCompletoNumero;

$anio = substr($detalleFactura->CbteFch, 0, 4);
$mes = substr($detalleFactura->CbteFch, 4, 2);
$dia = substr($detalleFactura->CbteFch, 6, 2);
$fecha = $dia . "/" . $mes . "/" . $anio;



$anio = substr($detalleFactura->CAEFchVto, 0, 4);
$mes = substr($detalleFactura->CAEFchVto, 4, 2);
$dia = substr($detalleFactura->CAEFchVto, 6, 2);
$fechaVtoCae = $dia. "/" . $mes . "/" . $anio;


$miTipoDeIvaResp = AfipWsv1::$tipoResponsabilidadesIva[ AfipWsv1::mapResponsabilidadesIva( Configure::read('Restaurante.iva_responsabilidad') ) ];

$this->printaitorObj->cae = $detalleFactura->CAE;
$this->printaitorObj->comprobanteNro = $detalleFactura->CbteDesde;
$this->printaitorObj->puntoDeVenta = $pto_venta;


$this->printaitorObj->dataToView['AfipFactura'] = array(
		'cae' => $detalleFactura->CAE,
		'cae_vencimiento' => $fechaVtoCae,
		'comprobanteNro' => $detalleFactura->CbteDesde,
		'puntoDeVenta' => $pto_venta,
		'tipo_comprobante' => AfipWsv1::$tipoComprobantes[$tipo_comprobante],
		'full_nro_comprobante' => $numeroComprobanteFullSTring,
		'fecha_facturacion' => $fecha,
		'subtotal' => $totalNeto,
		'total' => $fullMesa['Mesa']['total'],
		'descuento' => 0,
		'Empresa' => array(
			'nombre' => Configure::read('Site.name'),
			'razon_social' => Configure::read('Restaurante.razon_social'),
			'cuit' => Configure::read('Restaurante.cuit'),
			'domicilio_fiscal' => Configure::read('Restaurante.domicilio'),
			'domicilio_comercial' => Configure::read('Restaurante.domicilio'),
			'tipo_responsabilidad' =>  $miTipoDeIvaResp,
			'ingresos_brutos' => Configure::read('Restaurante.ib'),
			'fecha_inicio_actividades' => Configure::read('Afip.inicio_actividades'),
		),
	);


if ( !empty( $fullMesa['Cliente'] ) ) {
	$this->printaitorObj->dataToView['AfipFactura']['Cliente'] = $fullMesa['Cliente'];
	$this->printaitorObj->dataToView['AfipFactura']['Cliente']['responsabiliad_iva'] = AfipWsv1::$tipoResponsabilidadesIva[AfipWsv1::mapResponsabilidadesIva( $fullMesa['Cliente']['IvaResponsabilidad']['id'])];		
}

//inserto los productos en vcomandas y cierro la mesa
if (!empty($productos)) {
	$i = 0;
    foreach ($productos as $p) {
    	$this->printaitorObj->dataToView['AfipFactura']['Producto'][] = array(
    			'nombre' => $p['nombre'],
    			'precio' => $p['precio'],
    			'cantidad' => $p['cantidad'],
    			'total' => cqs_round( $p['precio'] * $p['cantidad'] ),
    		);
    }
}


if (!empty($importe_descuento)) {
	$this->printaitorObj->dataToView['AfipFactura']['descuento'] = $importe_descuento;
}


echo json_encode($this->printaitorObj->dataToView['AfipFactura']);