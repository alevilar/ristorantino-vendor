<?php
?>
<table class="table">
	<thead>
		<tr>
			<th><?php echo __('CAE'); ?></th>
			<th><?php echo __('Pto. Venta'); ?></th>
			<th><?php echo __('Nº Comprobante'); ?></th>
			<th><?php echo Configure::read("Mesa.tituloMesa"); ?></th>
			<th><?php echo Configure::read("Mesa.tituloMozo"); ?></th>
			<th><?php echo __('Neto'); ?></th>
			<th><?php echo __('Iva'); ?></th>
			<th><?php echo __('Total'); ?></th>
			<th><?php echo __('fecha'); ?></th>
			<th></th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ( $afipFacturas as $factu ) { ?>
		<tr>
			<td><?php echo $factu['AfipFactura']['cae'] ?></td>
			<td><?php echo $factu['AfipFactura']['punto_de_venta'] ?></td>
			<td><?php echo $factu['AfipFactura']['comprobante_nro'] ?></td>
			<td><?php echo $this->Html->link( $factu['Mesa']['numero'], array( 'plugin' => 'mesa', 'controller' => 'mesas' ,'action' =>'edit', $factu['Mesa']['id'] )); ?></td>
			<td><?php echo $factu['Mesa']['Mozo']['numero']; ?></td>
			<td><?php echo $factu['AfipFactura']['importe_neto'] ?></td>
			<td><?php echo $factu['AfipFactura']['importe_iva'] ?></td>
			<td><?php echo $factu['AfipFactura']['importe_total'] ?></td>
			<td><?php echo $this->Time->nice( $factu['AfipFactura']['created']) ?></td>
			<td><?php echo $this->Html->link( __('Ver Online'), array( 'action' =>'view', $factu['AfipFactura']['id'] ), array('target'=>'_blank')); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>