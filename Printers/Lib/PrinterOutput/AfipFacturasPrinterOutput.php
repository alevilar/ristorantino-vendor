<?php

App::uses('PrinterJob', 'Printers.Model');
App::uses('PrinterOutput', 'Printers.Lib/PrinterOutput');

App::uses('AfipWsv1', 'Printers.Utility');



/**
* Crea un archivo y lo guarda en la tabla afip_facturas
**/
class AfipFacturasPrinterOutput extends PrinterOutput
{
    
    public  $name = 'AfipFacturas';


    /**
    *
    *   Se utiliza con el getter y setter: $this->get y $this->set
    *   
    *
    **/
    private $__data = array();


    /**
    *
    *   dataToView del PrintaitorViewObj
    *
    **/
    public $dataToView = array();

    
/**
 * Returns the description of the print engine
 * @return string
 */        
    public  function description(){
        return "Prints files saving into database";
    }
    


    public function get( $dataName ) {
        return Hash::get($this->__data, $dataName );
    }

    public function set( $dataName, $value ) {
        $this->__data[$dataName] = $value ;
    }
   

    public function beforeRender ( PrintaitorViewObj $printaitorViewObj ) {
        $ptoVta = Configure::read('Afip.punto_de_venta');
        
        $this->set( 'punto_de_venta', $ptoVta);

        $this->__start( $ptoVta );

        $this->dataToView = $printaitorViewObj->dataToView;

        if ( $printaitorViewObj->viewName == 'ticket') {
            $this->__initComprobante();
            $this->__solicitarFE();
            $printaitorViewObj->dataToView = $this->__data;
        }
    }


    private function __solicitarFE () {
        $res = AfipWsv1::FECAESolicitar (   $this->get('punto_de_venta')
                                            , $this->get('tipo_comprobante')
                                            , $this->get('cliente_tipo')
                                            , $this->get('cliente_doc')
                                            , $this->get('importe_neto')
                                            , $this->get('Mesa.total') 
                                            , $this->get('importe_iva')
                                        );
        $this->__resultFe( $res );

    }

    private function __setFechaProceso ( $fchProceso ) {

        $fechaFacturacionYY = substr($fchProceso, 0, 2);
        $fechaFacturacionMM = substr($fchProceso, 2, 2);
        $fechaFacturacionDD = substr($fchProceso, 4, 2);
        $fechaFacturacionHH = substr($fchProceso, 6, 2);
        $fechaFacturacionDD = substr($fchProceso, 8, 2);
        $fechaFacturacionSS = substr($fchProceso, 10, 2);
        $fechaFacturacion = $fechaFacturacionYY ."/" . $fechaFacturacionMM . "/" .$fechaFacturacionDD . " " .$fechaFacturacionHH. ":" .$fechaFacturacionDD . ":" . $fechaFacturacionSS;

        $this->set('fecha_proceso', $fechaFacturacion);

        return $fechaFacturacion;
    }

    private function __resultFe ( $res ) {

        $this->__setFechaProceso( $res->FECAESolicitarResult->FeCabResp->FchProceso );

        // $tipoFactura = AfipWsv1::$tipoComprobantes[ $res->FECAESolicitarResult->FeCabResp->CbteTipo ];
        $detalleFactura = $res->FECAESolicitarResult->FeDetResp->FECAEDetResponse;


        $concepto = AfipWsv1::$tipoConceptos[ $detalleFactura->Concepto ];
        $this->set('concepto', $concepto);

        $tipoDoc = AfipWsv1::$tipoDOcumentos[ $detalleFactura->DocTipo ];
        $this->set('tipo_doc', $tipoDoc);

        $numComprobante = $detalleFactura->CbteDesde ;
        $this->set('numero_comprobante', $numComprobante);

        $numeroComprobanteCompletoPtoVenta = 10000 + $this->get('punto_de_venta') ;
        $numeroComprobanteCompletoPtoVenta = substr($numeroComprobanteCompletoPtoVenta, 1, 4);

        $numeroComprobanteCompletoNumero = 100000000 + $numComprobante ;
        $numeroComprobanteCompletoNumero = substr($numeroComprobanteCompletoNumero, 1, 8);

        $numeroComprobanteFullSTring = $numeroComprobanteCompletoPtoVenta . "-" . $numeroComprobanteCompletoNumero;
        $this->set('full_nro_comprobante', $numeroComprobanteFullSTring);



        $anio = substr($detalleFactura->CbteFch, 0, 4);
        $mes = substr($detalleFactura->CbteFch, 4, 2);
        $dia = substr($detalleFactura->CbteFch, 6, 2);
        $fecha = $dia . "/" . $mes . "/" . $anio;
        $this->set('fecha_facturacion', $fecha);


        $anio = substr($detalleFactura->CAEFchVto, 0, 4);
        $mes = substr($detalleFactura->CAEFchVto, 4, 2);
        $dia = substr($detalleFactura->CAEFchVto, 6, 2);
        $fechaVtoCae = $dia. "/" . $mes . "/" . $anio;
        $this->set('cae_vencimiento', $fechaVtoCae);


        $this->set('cae', $detalleFactura->CAE);

    }

    private function __start ( $pto_venta ) {

        // inicio el estado del WS Afip autenticando y verificando conexion
         AfipWsv1::start( $pto_venta );
    }




    private function __initComprobante () {
        $dataAux = $this->dataToView;
        $this->__data = array_merge(  $dataAux['fullMesa'], $this->__data );
        unset($dataAux['fullMesa']);

        $this->__data = array_merge( $dataAux, $this->__data );


        $tipo_comprobante = AfipWsv1::mapTipoFacturas( Configure::read('Afip.tipofactura_id') );
        $cliente_tipo = AfipWsv1::CLIENTE_TIPO_DOCUMENTO_SIN_IDENTIFICAR;
        $cliente_doc = 0;
        if ( !empty($this->dataToView['fullMesa']['Cliente'])) {
            $cliente_tipo = AfipWsv1::mapTipoDocumentoComprador( $this->dataToView['fullMesa']['Cliente']['tipo_documento_id']);
            $cliente_doc = $this->dataToView['fullMesa']['Cliente']['nrodocumento'];
            if ( !empty($this->dataToView['fullMesa']['Cliente']['IvaResponsabilidad']) ) {
                $tipo_comprobante = AfipWsv1::mapTipoFacturas( $this->dataToView['fullMesa']['Cliente']['IvaResponsabilidad']['tipo_factura_id'] );
            }
        }

        $this->set( 'tipo_comprobante',$tipo_comprobante );
        $this->set( 'tipo_comprobante_name', AfipWsv1::$tipoComprobantes[$tipo_comprobante] );
        $this->set( 'cliente_tipo', $cliente_tipo );
        $this->set( 'cliente_doc', $cliente_doc);

        $ivaTxt = Configure::read('Afip.default_iva_porcentaje');
        $ivaPorcentaje = (float) "1.$ivaTxt";
        $this->set( 'iva_porcentaje', $ivaPorcentaje );

        $totalNeto = cqs_round( $this->dataToView['fullMesa']['Mesa']['subtotal'] / $ivaPorcentaje);
        $this->set( 'importe_neto', $totalNeto );
        
        $this->set( 'importe_iva', $this->dataToView['fullMesa']['Mesa']['total'] - $totalNeto );

        $this->__setMiEmpresaData();

        $this->__setDescuento();
        
        $this->__setProductos();
    }


    private function __setDescuento () {
        if (!empty($importe_descuento)) {
            $this->set( 'descuento' , $importe_descuento );
        }
    }



    private function __setProductos () {
        $productos = $this->dataToView['productos'];
        $productosSumados = array();
        if (!empty($productos)) {
            $i = 0;
            foreach ($productos as $p) {
                $productosSumados[] = array(
                        'nombre' => $p['nombre'],
                        'precio' => $p['precio'],
                        'cantidad' => $p['cantidad'],
                        'total' => cqs_round( $p['precio'] * $p['cantidad'] ),
                    );
            }
        }
        $this->set('Producto', $productosSumados);
    }


    private function __setCliente() {

        if ( !empty( $this->dataToView['Cliente'] ) ) {
            $this->printaitorObj->dataToView['AfipFactura']['Cliente'] = $this->dataToView['Cliente'];
            $this->printaitorObj->dataToView['AfipFactura']['Cliente']['responsabiliad_iva'] = AfipWsv1::$tipoResponsabilidadesIva[AfipWsv1::mapResponsabilidadesIva( $this->dataToView['Cliente']['IvaResponsabilidad']['id'])];       
        }
    }


    private function __setIvaResp () {

        $ivaResponsabilidad = (int) Configure::read('Restaurante.iva_responsabilidad');
        $this->set( 'risto_mi_iva_responsabilidad_id', $ivaResponsabilidad );

        $codigoRespIva = AfipWsv1::mapResponsabilidadesIva( $ivaResponsabilidad );
        $this->set( 'afip_mi_iva_responsabilidad_codigo', $codigoRespIva );

        $miTipoDeIvaResp = AfipWsv1::$tipoResponsabilidadesIva[ $codigoRespIva ];
        $this->set( 'afip_mi_iva_responsabilidad_name', $miTipoDeIvaResp );

    }

    private function __setMiEmpresaData () {
        $this->__setIvaResp();

        $empresa = array(
            'nombre' => Configure::read('Site.name'),
            'razon_social' => Configure::read('Restaurante.razon_social'),
            'cuit' => Configure::read('Restaurante.cuit'),
            'domicilio_fiscal' => Configure::read('Restaurante.domicilio'),
            'domicilio_comercial' => Configure::read('Restaurante.domicilio'),
            'tipo_responsabilidad' =>  $this->get( 'afip_mi_iva_responsabilidad_codigo'),
            'tipo_responsabilidad_name' => $this->get( 'afip_mi_iva_responsabilidad_name'),
            'ingresos_brutos' => Configure::read('Restaurante.ib'),
            'fecha_inicio_actividades' => Configure::read('Afip.inicio_actividades'),
        );

        $this->set('Empresa', $empresa);
    }
  
/**
 * Crea un archivo y lo guarda en la tabla afip_facturas
 * 
 * @param PrintaitorViewObj $printaitorViewObj
 * 
 * @return type boolean true si salio todo bien false caso contrario
 */
        public  function send( $printaitorViewObj  ) {    
            $dv = $printaitorViewObj->dataToView;
            $factura['AfipFactura'] = array(
                    'json_data'       => $printaitorViewObj->viewTextRender,
                    'mesa_id'         => Hash::get( $dv, 'Mesa.id'),
                    'importe_total'   => Hash::get( $dv, 'Mesa.total'),
                    'importe_neto'    => Hash::get( $dv, 'importe_neto'),
                    'importe_iva'     => Hash::get( $dv, 'importe_iva'),
                    'punto_de_venta'  => Hash::get( $dv, 'punto_de_venta'),
                    'comprobante_nro' => Hash::get( $dv, 'numero_comprobante'),
                    'tipo_factura_id' => Hash::get( $dv, 'tipo_factura_id'),
                    'cae'             => Hash::get( $dv, 'cae'),
                    'iva_porcentaje'  => Configure::read('Afip.default_iva_porcentaje'),
                );

            $AfipFactura = ClassRegistry::init("Printers.AfipFactura");
            $factura = $AfipFactura->save($factura);
            if ( !$factura ) {
                foreach ( $AfipFactura->validationErrors as $field => $msg) {
                    $msgErr = implode(',', $msg);
                    throw new CakeException( __("No se pudo guardar la factura. Campo: %s, Error: %s", $field, $msgErr), 1);
                }
            }
            return $factura;
        }

        
}
