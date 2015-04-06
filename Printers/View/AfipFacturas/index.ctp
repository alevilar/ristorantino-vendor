<?php
?>
<table class="table">
	<thead>
		<tr>
			<th><?php echo __('CAE'); ?></th>
			<th><?php echo __('Pto. Venta'); ?></th>
			<th><?php echo __('Nº Comprobante'); ?></th>
			<th><?php echo __('Mesa'); ?></th>
			<th><?php echo __('Mozo'); ?></th>
			<th><?php echo __('fecha'); ?></th>
			<th><?php echo __('Factura'); ?></th>
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
			<td><?php echo $this->Time->nice( $factu['AfipFactura']['created']) ?></td>
			<td><?php echo $this->Html->link( __('Ver Online'), array( 'action' =>'view', $factu['AfipFactura']['id'] )); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>