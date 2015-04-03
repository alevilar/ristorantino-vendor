<?php
$this->assign('title', __('Afip Factura Electrónica Online')) ;
$afipFactura = json_decode( $factura['AfipFactura']['json_data'] );
?>

<TABLE BORDER CELLSPACING=1 CELLPADDING=4 WIDTH=633>
<TR><TD WIDTH="39%" VALIGN="TOP" HEIGHT=36><DIR>

<P><FONT FACE="Arial" SIZE=2><?php echo $afipFactura['Empresa']['nombre']?></P>
<P><?php echo $afipFactura['Empresa']['razon_social']?></DIR>
</FONT></TD>
<TD WIDTH="15%" VALIGN="TOP" COLSPAN=2 HEIGHT=36>
<B><FONT FACE="Arial" SIZE=2><P ALIGN="CENTER"><?php echo $afipFactura['tipo_comprobante']?></B></FONT></TD>
<TD WIDTH="46%" VALIGN="TOP" HEIGHT=36>
<FONT FACE="Arial" SIZE=2><P ALIGN="CENTER"><?php echo "FACTURA N° ". $afipFactura['full_nro_comprobante'];?></P>
<P ALIGN="RIGHT"><?php echo $afipFactura['fecha_facturacion'] ?></FONT></TD>
</TR>
<TR><TD WIDTH="46%" VALIGN="TOP" COLSPAN=2><DIR>

<FONT FACE="Arial" SIZE=2><P><?php echo "Domicilio Comercial: " . $afipFactura['Empresa']['domicilio_comercial'] ?></P>
<P><?php echo "Domicilio fiscal: ". $afipFactura['Empresa']['domicilio_fiscal'] ?></P>
<P><?php echo $afipFactura['Empresa']['tipo_responsabilidad']?></P>
</FONT></TD>
<TD WIDTH="53%" VALIGN="TOP" COLSPAN=2>
<FONT FACE="Arial" SIZE=2><P ALIGN="RIGHT">CUIT: <?php echo $afipFactura['Empresa']['cuit']?></P>
<P ALIGN="RIGHT">ING. BRUTOS: <?php echo $afipFactura['Empresa']['ingresos_brutos']?></P>
<P ALIGN="RIGHT">INICIO ACTIVIDADES: <?php echo $afipFactura['Empresa']['fecha_inicio_actividades']?></FONT></TD>
</TR>

<?php
if ( !empty( $afipFactura['Cliente'] ) ) {
?>
	<TR><TD VALIGN="TOP" COLSPAN=4 HEIGHT=60>
	<FONT FACE="Arial" SIZE=2>
	<P><?php echo $afipFactura['Cliente']['nombre']; ?></P>
	<P><?php echo $afipFactura['Cliente']['nrodocumento']; ?></P>
	<P><?php echo $afipFactura['Cliente']['nombre']; ?></P>
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
		if (!empty($afipFactura['Producto'])) {
		    foreach ($afipFactura['Producto'] as $p) {
		?>
		            <tr>
						<td  ALIGN="CENTER"><a class="cut">-</a><span contenteditable><?php echo $p['nombre'] ?></span></td>
						<td  ALIGN="CENTER"><span data-prefix>$</span><span contenteditable><?php echo $p['precio']?></span></td>
						<td  ALIGN="CENTER"><span contenteditable><?php $p['cantidad']?></span></td>
						<td ALIGN="CENTER"><span data-prefix>$</span><span><?php echo $p['total'];?></span></td>
					</tr>
		<?php
		    }
		}
		?>	
		</tbody>
</table>


<P>&nbsp;</P>
<P>&#9;Total Neto&#9; $<?php echo $afipFactura['subtotal']; ?></FONT>

<?php
if (!empty($afipFactura['descuento'])) {
    ?>
		<span contenteditable>  Descuento: </span>
		<span data-prefix>$</span><span contenteditable><?php echo $afipFactura['descuento'] ?></span>
	</p>
    <?php
}
?>

</TD>
</TR>
<TR><TD VALIGN="TOP" COLSPAN=4 HEIGHT=45>
<FONT FACE="Arial" SIZE=4><P ALIGN="CENTER">Total: $<?php echo $afipFactura['total']?></FONT></TD>
</TR>
<TR><TD VALIGN="TOP" COLSPAN=4 HEIGHT=5>
<P>

<FONT FACE="Arial" SIZE=2><P>CAE <?php echo $afipFactura['cae']?></P>
<P>VTO. CAE: <?php echo $afipFactura['cae_vencimiento'] ?></P></FONT></TD>
</TR>
</TABLE>
