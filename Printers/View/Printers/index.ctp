<div class="printers index content-white">
    <h2><?php echo __('Impresoras'); ?></h2>
    <div class="btn-group pull-right">
    <?php echo $this->Html->link(__('Nueva Impresora', true), array('action'=>'add'), array('class'=>'btn btn-success btn-lg')); ?>
    </div>
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('id',__('Id')); ?></th>
			<th><?php echo $this->Paginator->sort('name',__('Nombre')); ?></th>
			<th><?php echo $this->Paginator->sort('alias',__('Alias')); ?></th>
			<th><?php echo $this->Paginator->sort('driver',__('Driver')); ?></th>
			<th><?php echo $this->Paginator->sort('driver_model',__('Modelo de Driver')); ?></th>
			<th><?php echo $this->Paginator->sort('output',__('Salida')); ?></th>
			<th><?php echo $this->Paginator->sort('created',__('Creado')); ?></th>
			<th><?php echo $this->Paginator->sort('modified',__('Modificado')); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($printers as $printer): ?>
	<tr>
		<td><?php echo h($printer['Printer']['id']); ?>&nbsp;</td>
		<td><?php echo h($printer['Printer']['name']); ?>&nbsp;</td>
		<td><?php echo h($printer['Printer']['alias']); ?>&nbsp;</td>
		<td><?php echo h($printer['Printer']['driver']); ?>&nbsp;</td>
		<td><?php echo h($printer['Printer']['driver_model']); ?>&nbsp;</td>
		<td><?php echo h($printer['Printer']['output']); ?>&nbsp;</td>
		<td><?php echo h($printer['Printer']['created']); ?>&nbsp;</td>
		<td><?php echo h($printer['Printer']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $printer['Printer']['id']), array('class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $printer['Printer']['id']), array('class'=>'btn btn-default')); ?>
			<?php
           

			$printerName = $printer['Printer']['name'];
			$cantProductos = $printer['Printer']['cantidad_productos'];
			$mensajeConfirmacion = __('¿Estas seguro que deseas borrar la impresora "%s"?', $printerName);
            if ( $cantProductos > 0) {
            	$mensajeConfirmacion = __('La impresora "%s" que desea borrar, tiene %s productos relacionados ¿Estas seguro que deseas borrarla?', $printerName, $cantProductos);
            }

        	echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $printer['Printer']['id']), array('class'=>'btn btn-default'), $mensajeConfirmacion);
			?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
		<p>
    	<?php
    	echo $this->Paginator->counter(array(
    	'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de  {:count} registros totales, iniciando en el registro {:start}, y terminando en el registro {:end}')
    	));
    	?>
    	</p>

<?php echo $this->element('Risto.pagination'); ?>
