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

$pto_venta = 1;



	//$res = $this->AfipWsFeV1Afip->FECompConsultar( $pto_venta, TIPO_FACTURA_B, 4);


	$this->AfipWsFeV1Afip->FEParamGetTiposTributos();
	$res = $this->AfipWsFeV1Afip->FECAESolicitar ( $pto_venta, TIPO_FACTURA_B );

	$detalleFactura = $res->FECAESolicitarResult->FeDetResp->FECAEDetResponse;

	$tipoFactura = $this->AfipWsFeV1Afip->tipoComprobantes[ $res->FECAESolicitarResult->FeCabResp->CbteTipo ];

	$concepto = $this->AfipWsFeV1Afip->tipoConceptos[ $detalleFactura->Concepto ];
	$tipoDoc = $this->AfipWsFeV1Afip->tipoDOcumentos[ $detalleFactura->DocTipo ];
	$numComprobante = $detalleFactura->CbteDesde ;


	$anio = substr($detalleFactura->CbteFch, 0, 4);
	$mes = substr($detalleFactura->CbteFch, 4, 2);
	$dia = substr($detalleFactura->CbteFch, 6, 2);
	$fecha = $dia . "/" . $mes . "/" . $anio;



	$anio = substr($detalleFactura->CAEFchVto, 0, 4);
	$mes = substr($detalleFactura->CAEFchVto, 4, 2);
	$dia = substr($detalleFactura->CAEFchVto, 6, 2);
	$fechaVtoCae = $dia. "/" . $mes . "/" . $anio;



die;
?>


<header>
	<h1><?php echo $tipoFactura ?></h1>
	<address contenteditable>
		<p><?php echo Configure::read('Restaurante.razon_social')?></p>
		<p><?php echo Configure::read('Restaurante.cuit')?></p>
		<p><?php echo Configure::read('Restaurante.mail')?></p>
	</address>
	<span><img alt="" src="http://www.paxapos.com/paxapos/img/logo_new.png"></span>
</header>
<article>

<?php
	//abro el tiquet consumidor final
	if (!empty($cliente)) {
	   
	    $tipoDoc = null;
	    if ( !empty($cliente['TipoDocumento']) ) {
	        $tipoDoc = $cliente['TipoDocumento']['codigo_fiscal'];
	    }

	    $respoIva = null;
	    if ( !empty($cliente['IvaResponsabilidad']) ) {
	        $respoIva = $cliente['IvaResponsabilidad']['codigo_fiscal'];
	    }
?>
	    <h1>Destinatario</h1>
		<address contenteditable>
			<p>
				<?php echo $cliente['nombre'] ?><br>
				<?php echo $cliente['nrodocumento'] ?><br>
				<small><?php echo $cliente['domicilio'] ?><br></small>
			</p>
		</address>	  
<?php
	}
?>
	
	<table class="meta">
		<tr>
			<th><span contenteditable>Fecha</span></th>
			<td><span contenteditable><?php echo $fecha; ?></td>
		</tr>
		<tr>
			<th><span contenteditable>Pto. de Venta #</span></th>
			<td><span contenteditable><?php echo $pto_venta?></span></td>
		</tr>
		<tr>
			<th><span contenteditable><?php echo __('Comprobante Nº') ?></span></th>
			<td><span contenteditable><?php echo $numComprobante ?></span></td>
		</tr>
		
	</table>
	<table class="inventory">
		<thead>
			<tr>
				<th><span contenteditable>Item</span></th>
				<th><span contenteditable>Rate</span></th>
				<th><span contenteditable>Quantity</span></th>
				<th><span contenteditable>Price</span></th>
			</tr>
		</thead>
		<tbody>
			<?php
			//inserto los productos en vcomandas y cierro la mesa
			if (!empty($productos)) {
			    foreach ($productos as $p) {
	    	?>
		                <tr>
							<td><a class="cut">-</a><span contenteditable><?php echo $p['nombre'] ?></span></td>
							<td><span data-prefix>$</span><span contenteditable><?php echo $p['precio']?></span></td>
							<td><span contenteditable><?php $p['cantidad']?></span></td>
							<td><span data-prefix>$</span><span><?php echo cqs_round( $p['precio'] * $p['cantidad'])?></span></td>
						</tr>
	        <?php
			    }
			}
			?>
			
		</tbody>
	</table>
	<a class="add">+</a>
	<table class="balance">
		<?php

		if (!empty($importe_descuento)) {
		    ?>
		    <tr>
				<th><span contenteditable>Sub-Total</span></th>
				<td><span data-prefix>$</span><span><?php $fullMesa['Mesa']['subtotal'] ?></span></td>
			</tr>
			<tr>
				<th><span contenteditable>Descuento</span></th>
				<td><span data-prefix>$</span><span contenteditable><?php echo $importe_descuento ?></span></td>
			</tr>
		    <?php
		}
		?>
		
		<tr>
			<th><span contenteditable>Total</span></th>
			<td><span data-prefix>$</span><span><?php echo $fullMesa['Mesa']['total'] ?></span></td>
		</tr>
	</table>
</article>
<aside>
	<h1><span contenteditable>Nota Extra</span></h1>
	<div contenteditable>
		<table>
			<tr>
					<th><span contenteditable>CAE #</span></th>
					<td><span contenteditable><?php echo $detalleFactura->CAE ?></span></td>
				</tr>
				<tr>
					<th><span contenteditable><?php echo __('Fecha Vto Cae') ?></span></th>
					<td><span contenteditable><?php echo $fechaVtoCae ?></span></td>
				</tr>
		</table>
	</div>
</aside>











<style>
	/* reset */
*
{
	border: 0;
	box-sizing: content-box;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
	vertical-align: top;
}

/* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 75%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

/* header */

header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

/* javascript */

.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: .8rem;
	padding: 0.25em 0.5em;	
	float: left;
	text-align: center;
	width: 0.6em;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -2.5em 0 0; }

.add:hover { background: #00ADEE; }

.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
.cut { -webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }

@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
}

@page { margin: 0; }

</style>
