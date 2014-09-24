<div class="clientes index col-md-12">
	<h2><?php echo Inflector::pluralize( Configure::read('Mesa.tituloCliente')) ?></h2>
	<table class="table">
            
            <thead>
                <?php echo $this->Form->create('Cliente') ?>
                <tr>
                        <th><?php echo $this->Form->text('codigo'); ?></th>
                        <th><?php echo $this->Form->text('nombre', array('required' => false)); ?></th>
                        <th><?php echo $this->Form->text('mail'); ?></th>
                        <th><?php echo $this->Form->select('tipo_documento_id', $tipoDocumentos, array('required' => false)); ?></th>
                        <th><?php echo $this->Form->text('nrodocumento'); ?></th>
                        <th><?php echo $this->Form->text('telefono'); ?></th>
                        <th><?php echo $this->Form->select('iva_responsabilidad_id', $ivaResponsabilidades, array('required' => false)); ?></th>
                        <th><?php echo $this->Form->select('descuento_id', $descuentos); ?></th>
                        <th><?php echo $this->Form->text('domicilio'); ?></th>
                        <th><?php echo $this->Form->submit('Buscar', array('class'=>'btn btn-primary')); ?></th>
                </tr>
                <?php echo $this->Form->end() ?>

                <tr>
                    
                    
                    <th><?php echo $this->Paginator->sort('codigo'); ?></th>
                    <th><?php echo $this->Paginator->sort('nombre'); ?></th>
                    <th><?php echo $this->Paginator->sort('mail'); ?></th>
                    <th><?php echo $this->Paginator->sort('tipo_documento_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('nrodocumento'); ?></th>
                    <th><?php echo $this->Paginator->sort('telefono'); ?></th>
                    <th><?php echo $this->Paginator->sort('iva_responsabilidad_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('descuento_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('domicilio'); ?></th>

                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead> 
	<?php foreach ($clientes as $cliente): ?>
	<tr>
		<td><?php echo h($cliente['Cliente']['codigo']); ?></td>
		
		
		<td><?php echo h($cliente['Cliente']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['mail']); ?>&nbsp;</td>

		<td>
			<?php echo $this->Html->link($cliente['TipoDocumento']['name'], array(
				'plugin' => 'risto',
			'controller' => 'tipo_documentos', 'action' => 'view', $cliente['TipoDocumento']['id'])); ?>
		</td>

		<td><?php echo h($cliente['Cliente']['nrodocumento']); ?>&nbsp;</td>


		<td><?php echo h($cliente['Cliente']['telefono']); ?>&nbsp;</td>

		<td>
			<?php echo $this->Html->link($cliente['IvaResponsabilidad']['name'], array(
					'plugin' => 'risto',
					'controller' => 'iva_responsabilidades', 'action' => 'view', $cliente['IvaResponsabilidad']['id'])); ?>
		</td>

		<td>
			<?php echo $this->Html->link($cliente['Descuento']['name'], array('controller' => 'descuentos', 'action' => 'view', $cliente['Descuento']['id'])); ?>
		</td>
		
		<td><?php echo h($cliente['Cliente']['domicilio']); ?>&nbsp;</td>
		

		
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $cliente['Cliente']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $cliente['Cliente']['id']), array(), __('Are you sure you want to delete # %s?', $cliente['Cliente']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
