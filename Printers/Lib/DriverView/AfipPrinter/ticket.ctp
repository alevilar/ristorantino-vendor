<?php
/**
*
*       Variables para generar un ticket
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
	$cliente_tipo = AfipWsv1::mapTipoDocumentoComprador( $fullMesa['Cliente']['documento_id']);
	$cliente_doc = $fullMesa['Cliente']['nrodocumento'];
	if ( !empty($fullMesa['Cliente']['IvaResponsabilidad']) ) {
		
		$tipo_comprobante = AfipWsv1::mapTipoFacturas( $fullMesa['Cliente']['IvaResponsabilidad']['tipo_factura_id'] );
	}
}

 AfipWsv1::start( $pto_venta );

//AfipWsv1::FEParamGetTiposTributos();


$res = AfipWsv1::FECAESolicitar ( $pto_venta,  $tipo_comprobante, $cliente_tipo, $cliente_doc, $fullMesa['Mesa']['subtotal'], $fullMesa['Mesa']['total'], $fullMesa['Mesa']['total'] - $fullMesa['Mesa']['subtotal'] );




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


$miTipoDeIvaResp = AfipWsv1::mapResponsabilidadesIva( Configure::read('Restaurante.iva_responsabilidad') );


?>





<TABLE BORDER CELLSPACING=1 CELLPADDING=4 WIDTH=633>
<TR><TD WIDTH="39%" VALIGN="TOP" HEIGHT=36><DIR>

<P><FONT FACE="Arial" SIZE=2><?php echo Configure::read('Site.name')?></P>
<P><?php echo Configure::read('Restaurante.razon_social')?></DIR>
</FONT></TD>
<TD WIDTH="15%" VALIGN="TOP" COLSPAN=2 HEIGHT=36>
<B><FONT FACE="Arial" SIZE=2><P ALIGN="CENTER"><?php echo AfipWsv1::$tipoComprobantes[$tipo_comprobante] ?></B></FONT></TD>
<TD WIDTH="46%" VALIGN="TOP" HEIGHT=36>
<FONT FACE="Arial" SIZE=2><P ALIGN="CENTER"><?php echo "FACTURA N° $numeroComprobanteFullSTring";?></P>
<P ALIGN="RIGHT"><?php echo $fechaFacturacion ?></FONT></TD>
</TR>
<TR><TD WIDTH="46%" VALIGN="TOP" COLSPAN=2><DIR>

<FONT FACE="Arial" SIZE=2><P><?php echo "Domicilio Comercial: " . Configure::read('Restaurante.domicilio') ?></P>
<P><?php echo "Domicilio fiscal: ". Configure::read('Restaurante.domicilio_fiscal') ?></P>
<P><?php echo AfipWsv1::$condicionesIva[$miTipoDeIvaResp]?></P>
</FONT></TD>
<TD WIDTH="53%" VALIGN="TOP" COLSPAN=2>
<FONT FACE="Arial" SIZE=2><P ALIGN="RIGHT">(10) CUIT: <?php echo Configure::read('Restaurante.cuit')?></P>
<P ALIGN="RIGHT">ING. BRUTOS: <?php echo Configure::read('Restaurante.ib')?></P>
<P ALIGN="RIGHT">INICIO ACTIVIDADES: <?php echo Configure::read('Afip.inicio_actividades')?></FONT></TD>
</TR>

<?php
if ( !empty( $fullMesa['Cliente'] ) ) {
?>
	<TR><TD VALIGN="TOP" COLSPAN=4 HEIGHT=60>
	<FONT FACE="Arial" SIZE=2>
	<P><?php echo $fullMesa['Cliente']['nombre']; ?></P>
	<P><?php echo $fullMesa['Cliente']['nrodocumento']; ?></P>
	<P><?php echo AfipWsv1::$tipoResponsabilidadesIva[AfipWsv1::mapResponsabilidadesIva( $fullMesa['Cliente']['IvaResponsabilidad']['id'])]; ?></P>
	</FONT></TD>
<?php } ?>

</TR>
<TR><TD VALIGN="TOP" COLSPAN=4>
<FONT FACE="Arial" SIZE=2>

<table width="100%">
		<thead>
			<tr>
				<th><span contenteditable>Item</span></th>
				<th><span contenteditable>Unitario</span></th>
				<th><span contenteditable>Cantidad</span></th>
				<th><span contenteditable>Precio</span></th>
			</tr>
		</thead>

		<tbody>
		<?php
		//inserto los productos en vcomandas y cierro la mesa
		if (!empty($productos)) {
		    foreach ($productos as $p) {
		?>
		            <tr>
						<td  ALIGN="CENTER"><a class="cut">-</a><span contenteditable><?php echo $p['nombre'] ?></span></td>
						<td  ALIGN="CENTER"><span data-prefix>$</span><span contenteditable><?php echo $p['precio']?></span></td>
						<td  ALIGN="CENTER"><span contenteditable><?php $p['cantidad']?></span></td>
						<td ALIGN="CENTER"><span data-prefix>$</span><span><?php echo cqs_round( $p['precio'] * $p['cantidad'])?></span></td>
					</tr>
		<?php
		    }
		}
		?>	
		</tbody>
</table>


<P>&nbsp;</P>
<P>&#9;Total Neto&#9; $<?php echo $fullMesa['Mesa']['subtotal']; ?></FONT>

<?php
if (!empty($importe_descuento)) {
    ?>
		<span contenteditable>  Descuento: </span>
		<span data-prefix>$</span><span contenteditable><?php echo $importe_descuento ?></span>
	</p>
    <?php
}
?>

</TD>
</TR>
<TR><TD VALIGN="TOP" COLSPAN=4 HEIGHT=45>
<FONT FACE="Arial" SIZE=4><P ALIGN="CENTER">Total: $<?php echo $fullMesa['Mesa']['total']?></FONT></TD>
</TR>
<TR><TD VALIGN="TOP" COLSPAN=4 HEIGHT=5>
<P>

<FONT FACE="Arial" SIZE=2><P>CAE <?php echo $detalleFactura->CAE ?></P>
<P>VTO. CAE: <?php echo $fechaVtoCae ?></P></FONT></TD>
</TR>
</TABLE>
