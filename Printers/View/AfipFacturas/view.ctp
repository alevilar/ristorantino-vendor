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
						<?php echo $afipFactura->tipo_comprobante_name ?>
					</h1>
					<?php if (Configure::read('Afip.desarrollo')) { ?>
						<b style="color: brown">COMPROBANTE NO VÁLIDO COMO FACTURA</b>
					<?php } else { ?>
						<b>ORIGINAL</b>
					<?php }?>
			</TD>
			<TD WIDTH="45%" VALIGN="MIDDLE" HEIGHT=36 style="border: none">
				<br>
				<FONT FACE="Arial" SIZE=3>
					<p class="center">
						COMPROBANTE ELECTRÓNICO<BR/>
						
					</p>
					<P ALIGN="CENTER">
					<b>FACTURA  <?php echo $afipFactura->full_nro_comprobante;?></b><BR/>
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

							<i><?php echo $afipFactura->Empresa->tipo_responsabilidad_name?></i><br />

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
						<P>
							<span class="pull-right">
								<b><?php echo $afipFactura->Cliente->TipoDocumento->name; ?>: </b>
								<?php echo $afipFactura->Cliente->nrodocumento; ?>
							</span>


							<b>Señor/es: </b><?php echo $afipFactura->Cliente->nombre; ?><br/>
							
							<?php if (!empty($afipFactura->Cliente->responsabiliad_iva) ) { ?>
								<span style="float: right">
									<b>Condición: </b><?php echo $afipFactura->Cliente->responsabiliad_iva; ?>
								</span>
							<?php } ?>
							
							

							<?php if (!empty($afipFactura->Cliente->domicilio) ) { ?>
								<b>Domicilio: </b><?php echo $afipFactura->Cliente->domicilio; ?>
							<?php } ?>
							
							
						</P>
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
								<th WIDTH="10%" ALIGN="CENTER" style="text-align: center"><span>Cantidad</span></th>
								<th WIDTH="40%"><span>Item</span></th>
								<th WIDTH="25%"  ALIGN="RIGHT"  style="text-align: right"><span>Unitario</span></th>
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
										<td ALIGN="CENTER"><span><?php echo $p->cantidad?></span></td>
										<td><span><?php echo $p->nombre ?></span></td>
										<td ALIGN="RIGHT"><span>$</span><span><?php echo $p->precio?></span></td>
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
						Total Neto $<?php echo $afipFactura->importe_neto; ?>
					</TD>
				</TR>
				
				<?php if (!empty($afipFactura->importe_iva)) { ?>
				<TR >
					<TD VALIGN="MIDDLE" COLSPAN=4 HEIGHT=45 ALIGN="RIGHT" style="border: none">
						IVA $<?php echo $afipFactura->importe_iva; ?>
					</TD>
				</TR>
				<?php } ?>

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
						Total: $<?php echo $afipFactura->Mesa->total?>
						</FONT>
					</TD>
				</TR>

				<TR>
					<TD VALIGN="TOP" COLSPAN=2 HEIGHT=5 width="50%">
						
						<?php
						
						App::uses('AfipWsv1', 'Printers.Utility');

						$fechavenc = preg_split( '/\/|-/', $afipFactura->cae_vencimiento );
						
						// $codigo_tipo_comprobante = AfipWsv1::mapTipoFacturas($afipFactura->tipo_factura_id);

						$codeData = array(
							'cuit' => $afipFactura->Empresa->cuit,
							'codigo_tipo_comprobante' =>  substr( $afipFactura->tipo_comprobante + 100, 1) ,
							'punto_de_venta' => substr( $afipFactura->punto_de_venta + 10000, 1),
							'cae' => $afipFactura->cae,
							'cae_vencimiento' => implode( array_reverse( $fechavenc )),
							);						
						echo $this->Barcode->dataImage('int25', $codeData, array('width'=>'100%'));
						?>
					</TD>


					<TD VALIGN="TOP" COLSPAN=1 HEIGHT=5 width="25%" style="text-align:center; vertical-align: middle">
						<FONT FACE="Arial" SIZE=2>
							<b style="font-size: 8pt">Comprobante Autorizado</b><br>
							<?php
							echo $this->Html->image('/printers/img/logo_afip.png', array( 'style' => 'width: 80%; max-width: 166px'));
							?>
						</FONT>
					</TD>

					<TD VALIGN="TOP" COLSPAN=1 HEIGHT=5 width="25%" style="text-align:center; vertical-align: middle">
						<FONT FACE="Arial" SIZE=2>
							<P>
							CAE <?php echo $afipFactura->cae?><BR />
							VTO. CAE: <?php echo $afipFactura->cae_vencimiento ?>
							</P>
						</FONT>
					</TD>

				</TR>
			</TFOOT>
		</TABLE>
</footer>
</div>