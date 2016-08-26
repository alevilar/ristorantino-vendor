
<?php
if ( !empty($proveedor['Proveedor']['mail'])) {
	?>

	<div class="pull-right">
		<input id="checkbox-enviar-mail" 
			name="data[Pedido][sendmail]"
			type="checkbox" 
			data-toggle="toggle" 
			data-on="Enviar por Mail" 
			data-off="No Enviar Mail" />
		<br/><br/>
		<div class="textarea-mail" style="display: none">
			<label for="mensaje-enviar-mail">Mensaje para el mail &#8595;</label>
			<br/>
			<textarea 	rows="2" 
						cols="30"
						id="mensaje-enviar-mail" 
						name="data[Pedido][mensaje_mail]"
						>
			</textarea>
		</div>
	</div>


	<?php
}
?>


<div style="text-align: left;">
	Teléfono: <b><?php echo $proveedor['Proveedor']['telefono'] ? $proveedor['Proveedor']['telefono'] : "-";?></b>
	<br>
	Email: <b><?php echo $proveedor['Proveedor']['mail']?$proveedor['Proveedor']['mail']:"-";?></b>
	<br>
	Cuit: <b><?php echo $proveedor['Proveedor']['cuit']?$proveedor['Proveedor']['cuit']:"-";?></b>
	<br>
	Rubros: <b><?php 

	echo implode( ",", Hash::extract( $proveedor['Rubro'], '{n}.name' ));
	;?></b>
</div>
