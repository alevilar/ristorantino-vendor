

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
