<?php

$afipFactura = json_decode( $factura['AfipFactura']['json_data'] );

?>
<div style="border: 1px solid silver">
<header>
<TABLE class="table">
	<THEAD>
		<TR>
			<TD WIDTH="45%" VALIGN="TOP" HEIGHT=36 style="border: none">
				<DIR>
					<h2><?php echo $afipFactura->Empresa->nombre?></h2>
				</DIR>

			</TD>
			<TD WIDTH="10%" VALIGN="TOP" HEIGHT=36 style="border:1px solid silver; border-top: none; text-align:center">
					<h1 class="afipfactura-tipo-comprobante">
						<?php echo $afipFactura->tipo_comprobante?>
					</h1>
				</B>
			</TD>
			<TD WIDTH="45%" VALIGN="MIDDLE" HEIGHT=36 style="border: none">
				<br>
				<FONT FACE="Arial" SIZE=3>
					<P ALIGN="CENTER">
					Nº <?php echo $afipFactura->full_nro_comprobante;?><BR/>
					<?php echo $afipFactura->fecha_facturacion ?>
					</P>
				</FONT>

			</TD>
		</TR>

		<TR BORDER="0">
			<TD COLSPAN="2" width="50%"  style="border: none">
				
				<p>
					<DIR>
						<FONT FACE="Arial" SIZE=2>
								
							<?php if ( $afipFactura->Empresa->domicilio_comercial && $afipFactura->Empresa->domicilio_fiscal && $afipFactura->Empresa->domicilio_comercial != $afipFactura->Empresa->domicilio_fiscal ) { ?>
								<?php echo "Domicilio Comercial: " . $afipFactura->Empresa->domicilio_comercial ?><br />
								<?php echo "Domicilio fiscal: ". $afipFactura->Empresa->domicilio_fiscal ?><br />
							<?php } elseif ( $afipFactura->Empresa->domicilio_comercial ) { ?>
								<?php echo "Domicilio: " . $afipFactura->Empresa->domicilio_comercial ?><br />
							<?php } elseif ($afipFactura->Empresa->domicilio_fiscal) { ?>
								<?php echo "Domicilio: " . $afipFactura->Empresa->domicilio_fiscal ?><br />
							<?php } ?>

							<i><?php echo $afipFactura->Empresa->tipo_responsabilidad?></i><br />

							<FONT FACE="Arial" SIZE=2>
								
							</FONT>
						</FONT>
					</DIR>
				</p>

			</TD>
			<TD COLSPAN="2" width="50%" style="border: none">
				
				<p ALIGN="CENTER" style="font-size: 8pt">
					<?php echo $afipFactura->Empresa->razon_social?><br/>
					CUIT: <?php echo $afipFactura->Empresa->cuit?><br/>
					<?php if ( $afipFactura->Empresa->ingresos_brutos ) { ?>
					Ing. Brutos: <?php echo $afipFactura->Empresa->ingresos_brutos?><br/>
					<?php } ?>
					Inicio de Actividades: <?php echo $afipFactura->Empresa->fecha_inicio_actividades?><br/>
				</p>

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
	<TABLE  class="table table-striped">
		<thead>
							<tr HEIGHT=40 style="background-color: #E6E6E6 !important">
								<th WIDTH="40%"><span>Item</span></th>
								<th WIDTH="25%"  ALIGN="RIGHT"  style="text-align: right"><span>Unitario</span></th>
								<th WIDTH="10%" ALIGN="CENTER" style="text-align: center"><span>Cantidad</span></th>
								<th ALIGN="RIGHT" WIDTH="25%" style="text-align: right">Importe</th>
							</tr>
		</thead>


		<TBODY>
			
							<?php
		//inserto los productos en vcomandas y cierro la mesa
							if (!empty($afipFactura->Producto)) {
								foreach ($afipFactura->Producto as $p) {
									?>
									<tr>
										<td><span><?php echo $p->nombre ?></span></td>
										<td ALIGN="RIGHT"><span>$</span><span><?php echo $p->precio?></span></td>
										<td ALIGN="CENTER"><span><?php echo $p->cantidad?></span></td>
										<td ALIGN="RIGHT"><span>$</span><span><?php echo $p->total;?></span></td>
									</tr>
									<?php
								}
							}
							?>				
		</TBODY>
	</TABLE>
</div>

<footer>
	<TABLE class="table">

			<TFOOT>
				<TR >
					<TD VALIGN="MIDDLE" COLSPAN=4 HEIGHT=45 ALIGN="RIGHT" style="border: none">
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
</div>