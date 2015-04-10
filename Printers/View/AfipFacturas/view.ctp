<?php

$afipFactura = json_decode( $factura['AfipFactura']['json_data'] );

?>

<header>
<TABLE BORDER CELLSPACING=1 CELLPADDING=4 WIDTH="100%">
	<THEAD>
		<TR>
			<TD WIDTH="39%" VALIGN="MIDDLE" HEIGHT=36>
				<DIR>
						<FONT FACE="Arial" SIZE=2>
						<P>
							<?php echo $afipFactura->Empresa->nombre?>
						</P>
						</FONT>
				</DIR>
			</TD>
			<TD WIDTH="15%" VALIGN="MIDDLE" COLSPAN=2 HEIGHT=36>
				<B>
					<FONT FACE="Arial" SIZE=2>
						<P class="afipfactura-tipo-comprobante" ALIGN="CENTER"><?php echo $afipFactura->tipo_comprobante?></P>
					</FONT>
				</B>
			</TD>
			<TD WIDTH="46%" VALIGN="TOP" HEIGHT=36>
				<FONT FACE="Arial" SIZE=2>
					<P ALIGN="CENTER"><?php echo $afipFactura->full_nro_comprobante;?></P>
					<P ALIGN="CENTER">Fecha: <?php echo $afipFactura->fecha_facturacion ?></P>
				</FONT>
			</TD>
		</TR>
		<TR>
			<TD WIDTH="46%" VALIGN="TOP" COLSPAN=2>
				<DIR>
					<FONT FACE="Arial" SIZE=2>
						<?php if ( $afipFactura->Empresa->domicilio_comercial && $afipFactura->Empresa->domicilio_fiscal && $afipFactura->Empresa->domicilio_comercial != $afipFactura->Empresa->domicilio_fiscal ) { ?>
							<P><?php echo "Domicilio Comercial: " . $afipFactura->Empresa->domicilio_comercial ?></P>
							<P><?php echo "Domicilio fiscal: ". $afipFactura->Empresa->domicilio_fiscal ?></P>
						<?php } elseif ( $afipFactura->Empresa->domicilio_comercial ) { ?>
							<P><?php echo "Domicilio: " . $afipFactura->Empresa->domicilio_comercial ?></P>
						<?php } elseif ($afipFactura->Empresa->domicilio_fiscal) { ?>
							<P><?php echo "Domicilio: " . $afipFactura->Empresa->domicilio_fiscal ?></P>
						<?php } ?>

						<P><?php echo $afipFactura->Empresa->tipo_responsabilidad?></P>
					</FONT>
				</DIR>
			</TD>
			<TD WIDTH="53%" VALIGN="TOP" COLSPAN=2>
				<FONT FACE="Arial" SIZE=2>
					<P ALIGN="RIGHT"><b><?php echo $afipFactura->Empresa->razon_social?></b></P>
					<P ALIGN="RIGHT">CUIT: <?php echo $afipFactura->Empresa->cuit?></P>
					<?php if ( $afipFactura->Empresa->ingresos_brutos ) { ?>
					<P ALIGN="RIGHT">ING. BRUTOS: <?php echo $afipFactura->Empresa->ingresos_brutos?></P>
					<?php } ?>
					<P ALIGN="RIGHT">INICIO ACTIVIDADES: <?php echo $afipFactura->Empresa->fecha_inicio_actividades?></P>
				</FONT>
			</TD>
		</TR>

		<?php
		if ( !empty( $afipFactura->Cliente ) ) {
			?>
			<TR>
				<TD VALIGN="TOP" COLSPAN=4 HEIGHT=60>
					<FONT FACE="Arial" SIZE=2>
						<P><?php echo $afipFactura->Cliente->nombre; ?></P>
						<P><?php echo $afipFactura->Cliente->nrodocumento; ?></P>
						<P><?php echo $afipFactura->Cliente->domicilio; ?></P>
					</FONT>
				</TD>
				<?php } ?>

			</TR>
		</THEAD>
</TABLE>
</header>

<div class="factura-items">
	<TABLE  CELLSPACING=1 CELLPADDING=4 WIDTH="100%">
		<thead BORDER>
							<tr BORDER HEIGHT=40 style="background-color: #E6E6E6 !important">
								<th WIDTH="40%"><span>Item</span></th>
								<th WIDTH="25%"  ALIGN="RIGHT"  style="text-align: right"><span>Unitario</span></th>
								<th WIDTH="10%" ALIGN="CENTER" style="text-align: center"><span>Cantidad</span></th>
								<th ALIGN="RIGHT" WIDTH="25%" style="text-align: right">Importe</th>
							</tr>
		</thead>


		<TBODY>
			<TR>
				<TD VALIGN="TOP" COLSPAN=4>
							<?php
		//inserto los productos en vcomandas y cierro la mesa
							if (!empty($afipFactura->Producto)) {
								foreach ($afipFactura->Producto as $p) {
									?>
									<tr HEIGHT=30>
										<td><span><?php echo $p->nombre ?></span></td>
										<td ALIGN="RIGHT"><span>$</span><span><?php echo $p->precio?></span></td>
										<td ALIGN="CENTER"><span><?php echo $p->cantidad?></span></td>
										<td ALIGN="RIGHT"><span>$</span><span><?php echo $p->total;?></span></td>
									</tr>
									<?php
								}
							}
							?>	
				</TD>
			</TR>
		</TBODY>
	</TABLE>
</div>

<footer>
	<TABLE BORDER CELLSPACING=1 CELLPADDING=4 WIDTH="100%">

			<TFOOT>
				<TR >
					<TD VALIGN="MIDDLE" COLSPAN=4 HEIGHT=45 ALIGN="RIGHT">
						Total Neto $<?php echo $afipFactura->subtotal; ?>
					</TD>
				</TR>

				<?php
				if (!empty($afipFactura->descuento)) {
					?>
				<TR>
					<TD VALIGN="MIDDLE" COLSPAN=4 HEIGHT=45 ALIGN="RIGHT">
						Descuento -$<?php echo $afipFactura->descuento; ?>
					</TD>
				</TR>
				<?php } ?>

				<TR style="background: #E6E6E6 !important;">
					<TD VALIGN="MIDDLE" COLSPAN=4 HEIGHT=45 ALIGN="RIGHT">
						<FONT FACE="Arial" SIZE=4>
						Total: $<?php echo $afipFactura->total?>
						</FONT>
					</TD>
				</TR>
				<TR>
					<TD VALIGN="TOP" COLSPAN=4 HEIGHT=5>
						<FONT FACE="Arial" SIZE=2>
							<P>CAE <?php echo $afipFactura->cae?></P>
							<P>VTO. CAE: <?php echo $afipFactura->cae_vencimiento ?></P>
						</FONT>
					</TD>
				</TR>
			</TFOOT>
		</TABLE>
</footer>
