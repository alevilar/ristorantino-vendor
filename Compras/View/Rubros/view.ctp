<div class="rubros view">
<h2><?php echo __('Rubro'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rubro['Rubro']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($rubro['Rubro']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($rubro['Rubro']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($rubro['Rubro']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rubro'), array('action' => 'edit', $rubro['Rubro']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rubro'), array('action' => 'delete', $rubro['Rubro']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $rubro['Rubro']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Rubros'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rubro'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Proveedores'), array('controller' => 'proveedores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Proveedor'), array('controller' => 'proveedores', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Proveedores'); ?></h3>
	<?php if (!empty($rubro['Proveedor'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Cuit'); ?></th>
		<th><?php echo __('Mail'); ?></th>
		<th><?php echo __('Telefono'); ?></th>
		<th><?php echo __('Domicilio'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($rubro['Proveedor'] as $proveedor): ?>
		<tr>
			<td><?php echo $proveedor['id']; ?></td>
			<td><?php echo $proveedor['name']; ?></td>
			<td><?php echo $proveedor['cuit']; ?></td>
			<td><?php echo $proveedor['mail']; ?></td>
			<td><?php echo $proveedor['telefono']; ?></td>
			<td><?php echo $proveedor['domicilio']; ?></td>
			<td><?php echo $proveedor['created']; ?></td>
			<td><?php echo $proveedor['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'proveedores', 'action' => 'view', $proveedor['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'proveedores', 'action' => 'edit', $proveedor['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'proveedores', 'action' => 'delete', $proveedor['id']), array('confirm' => __('Are you sure you want to delete # %s?', $proveedor['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Proveedor'), array('controller' => 'proveedores', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
