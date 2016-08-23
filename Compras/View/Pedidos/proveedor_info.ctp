
<?php
if ( !empty($proveedor['Proveedor']['mail'])) {
	?>

	<div class="pull-right">
	<br/>
	<input id="checkbox-enviar-mail" 
			name="data[Pedido][sendmail]"
			type="checkbox" 
			data-toggle="toggle" 
			data-on="Enviar por Mail" 
			data-off="No Enviar Mail">
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
