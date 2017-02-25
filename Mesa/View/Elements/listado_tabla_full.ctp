<table class="table">
<tr>
	<th><?php echo $this->Paginator->sort( 'numero', Configure::read('Mesa.tituloMesa'));?></th>
	<th><?php echo $this->Paginator->sort('mozo_id', Configure::read('Mesa.tituloMozo'));?></th>

	<th><?php echo $this->Paginator->sort('subtotal');?></th>
	<th><?php echo $this->Paginator->sort('total');?></th>
    <th><?php echo $this->Paginator->sort('cant_comensales', Inflector::pluralize(Configure::read('Mesa.tituloCubierto')) );?></th>		
    <th><?php echo $this->Paginator->sort('estado_id', 'Estado');?></th>        
	<th>Tipo Factura</th>
	<th><?php echo $this->Paginator->sort('created', 'Abierta');?></th>
	<th><?php echo $this->Paginator->sort('time_cerro','Facturada');?></th>
	<th><?php echo $this->Paginator->sort('time_cobro','Cobrada');?></th>
	<th><?php echo $this->Paginator->sort('checkin');?></th>
	<th><?php echo $this->Paginator->sort('checkout');?></th>
	<th><?php echo $this->Paginator->sort('observacion', 'Observación');?></th>
    <th><?php echo $this->Paginator->sort('Cliente.nombre', Configure::read('Mesa.tituloCliente'));?></th>
    <th><?php echo $this->Paginator->sort('Cliente.codigo', Configure::read('Mesa.tituloCliente').' '.__('Código'));?></th>
    <th><?php echo $this->Paginator->sort('Cliente.tipo_documento_id', Configure::read('Mesa.tituloCliente').' '.__('Tipo Documento'));?></th>
    <th><?php echo $this->Paginator->sort('Cliente.nrodocumento', Configure::read('Mesa.tituloCliente').' '.__('Nro Documento'));?></th>
    <th><?php echo $this->Paginator->sort('Cliente.iva_responsabilidad_id', Configure::read('Mesa.tituloCliente').' '.__('IVA Resp.'));?></th>
    <th><?php echo $this->Paginator->sort('Cliente.descuento_id', Configure::read('Mesa.tituloCliente').' '.__('Descuento'));?></th>
    <th><?php echo $this->Paginator->sort('Cliente.mail', Configure::read('Mesa.tituloCliente').' '.__('Mail'));?></th>
    <th><?php echo $this->Paginator->sort('Cliente.telefono', Configure::read('Mesa.tituloCliente').' '.__('Telefono'));?></th>
    <th><?php echo $this->Paginator->sort('Cliente.domicilio', Configure::read('Mesa.tituloCliente').' '.__('Domicilio'));?></th>
    <th><?php echo $this->Paginator->sort('Cliente.fecha', Configure::read('Mesa.tituloCliente').' '.__('Fecha'));?></th>
    <th><?php echo $this->Paginator->sort('Cliente.observacion', Configure::read('Mesa.tituloCliente').' '.__('Observacion'));?></th>
	<th>Pago</th>
</tr>
<?php
$i = 0;
foreach ($mesas as $mozo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
		<strong><?php echo $mozo['Mesa']['numero']; ?><strong>
		</td>
		<td>
			<?php echo $mozo['Mozo']['numero']; ?>
		</td>

		<td>
			<?php echo $this->Number->currency($mozo['Mesa']['subtotal']); ?>
		</td>

		<td>
			<?php echo $this->Number->currency($mozo['Mesa']['total']); ?>
		</td>
               
    	<td>
			<?php echo $mozo['Mesa']['cant_comensales'] ?>
		</td>
		<td>
			<?php echo $mozo['Estado']['name'] ?>
		</td>

		<td align="center">
			<?php 
			if(!empty($mozo['Cliente']) && !empty($mozo['Cliente']['IvaResponsabilidad']) && !empty($mozo['Cliente']['IvaResponsabilidad']['TipoFactura'])){
			 	echo $mozo['Cliente']['IvaResponsabilidad']['TipoFactura']['name']; 
			 }
			else {
			 echo ' '.Configure::read('Restaurante.tipofactura_name');
			}
			?>
		</td>

		<td>
			<?php echo $mozo['Mesa']['created']; ?>
		</td>

		<td>
			<?php echo $mozo['Mesa']['time_cerro']; ?>
		</td>

		<td>
			<?php echo $mozo['Mesa']['time_cobro']; ?>
		</td>

		<td>
			<?php echo $mozo['Mesa']['checkin']; ?>
		</td>

		<td>
			<?php echo $mozo['Mesa']['checkout']; ?>
		</td>

		<td>
			<?php echo $mozo['Mesa']['observation']; ?>
		</td>

        <td>
			<?php
			if(!empty($mozo['Cliente'])){
                echo $mozo['Cliente']['nombre'];
            }
            ?>
		</td>

		<td>
			<?php
			if(!empty($mozo['Cliente'])){
                echo $mozo['Cliente']['codigo'];
            }
            ?>
		</td>

		<td>
			<?php
			if(!empty($mozo['Cliente']) && !empty($mozo['Cliente']['TipoDocumento'])){
                echo $mozo['Cliente']['TipoDocumento']['name'];
            }
            ?>
		</td>

		<td>
			<?php
			if(!empty($mozo['Cliente'])){
                echo $mozo['Cliente']['nrodocumento'];
            }
            ?>
		</td>

		<td>
			<?php
			if(!empty($mozo['Cliente']) && !empty($mozo['Cliente']['IvaResponsabilidad'])){
                echo $mozo['Cliente']['IvaResponsabilidad']['name'];
            }
            ?>
		</td>

		<td>
			<?php
			if(!empty($mozo['Cliente']) && !empty($mozo['Cliente']['Descuento'])){
                echo $mozo['Cliente']['Descuento']['porcentaje'];
            }
            ?>
		</td>


		<td>
			<?php
			if(!empty($mozo['Cliente'])){
                echo $mozo['Cliente']['mail'];
            }
            ?>
		</td>

		<td>
			<?php
			if(!empty($mozo['Cliente'])){
                echo $mozo['Cliente']['telefono'];
            }
            ?>
		</td>

		<td>
			<?php
			if(!empty($mozo['Cliente'])){
                echo $mozo['Cliente']['domicilio'];
            }
            ?>
		</td>

		<td>
			<?php
			if(!empty($mozo['Cliente'])){
                echo $mozo['Cliente']['fecha'];
            }
            ?>
		</td>

		<td>
			<?php
			if(!empty($mozo['Cliente'])){
                echo $mozo['Cliente']['observacion'];
            }
            ?>
		</td>


		<td>
			<table>
			<?php foreach ($mozo['Pago']as $p) { ?>
				<?php if ( empty($p)) continue; ?>
				<tr>
					<td><?php echo $this->Number->currency( ($p['valor']) ); ?></td>
					<td><?php echo $p['TipoDePago']['name']; ?></td>
				</tr>
			<?php } ?>
            </table>
		</td>	

	</tr>
<?php endforeach; ?>      
</table>