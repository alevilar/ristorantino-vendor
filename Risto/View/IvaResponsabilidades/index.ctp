<div class="ivaResponsabilidades index">
    <div class="btn-group pull-right">
    <?php echo $this->Html->link(__('Nueva Iva Responsabilidad', __('IvaResponsabilidad')), array('action' => 'add'), array('class'=>'btn btn-success btn-lg')); ?>
    <?php echo $this->Html->link(__('Nuevo Tipo Factura', __('IvaResponsabilidad')), array('controller' => 'tipo_facturas', 'action' => 'add'), array('class'=>'btn btn-default btn-lg')); ?>
    </div>
    <h2><?php echo __('Iva Responsabilidades'); ?></h2>
	<table class="table">
    <tr>
    	<?php echo $this->Form->create('IvaResponsabilidad',array('action'=>'index'));?>
    	<th colspan= "2"><?php echo $this->Form->input('IvaResponsabilidad.name',array('placeholder'=>'Nombre', 'label'=>false, 'required' => 0));?></th>
    	<th colspan= "2"><?php echo $this->Form->input('IvaResponsabilidad.codigo_fiscal', array('placeholder'=>'Codigo Fiscal', 'label'=>false, 'required' => 0));?></th>
    	<th><?php echo $this->Form->submit('Buscar', array('class' => 'btn btn-primary', 'title' => __('Buscar')));?></th>
    	<?php echo $this->Form->end();?>
    </tr>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('codigo_fiscal'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('tipo_factura_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ivaResponsabilidades as $ivaResponsabilidad): ?>
	<tr>
		<td><?php echo h($ivaResponsabilidad['IvaResponsabilidad']['id']); ?>&nbsp;</td>
		<td><?php echo h($ivaResponsabilidad['IvaResponsabilidad']['codigo_fiscal']); ?>&nbsp;</td>
		<td><?php echo h($ivaResponsabilidad['IvaResponsabilidad']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ivaResponsabilidad['TipoFactura']['name'], array('controller' => 'tipo_facturas', 'action' => 'view', $ivaResponsabilidad['TipoFactura']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ivaResponsabilidad['IvaResponsabilidad']['id']), array('class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ivaResponsabilidad['IvaResponsabilidad']['id']), array('class'=>'btn btn-default')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ivaResponsabilidad['IvaResponsabilidad']['id']), array('class'=>'btn btn-default'), __('Are you sure you want to delete # %s?', $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de {:count} registros totales, iniciando en el registro{:start}, terminando en {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
	 echo $this->Paginator->prev('<< ' . __('anterior'), array(), null, array('class' => 'btn btn-default'));?>
	|<? echo $this->Paginator->numbers(array('separator' => ''));?>
	<? echo $this->Paginator->next(__('siguiente') . '>>', array(), null, array('class' => 'btn btn-default'));?>
	</div>
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Iva Responsabilidad'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tipo Facturas'), array('controller' => 'tipo_facturas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Factura'), array('controller' => 'tipo_facturas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List %s', Inflector::pluralize(Configure::read('Mesa.tituloCliente'))), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New %s', Configure::read('Mesa.tituloCliente')), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
