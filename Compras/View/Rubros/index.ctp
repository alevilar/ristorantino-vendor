<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Rubro'));?>


<div class="content-white">

<div class="rubros index">
	<h2><?php echo __('Rubros'); ?></h2>
<?php echo $this->Html->link(__('Nuevo Rubro'), array('action' => 'add'), array('class'=>'btn btn-lg btn-primary pull-right btn-add')); ?></li>
	<table class="table">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('Proveedor.id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($rubros as $rubro): ?>
	<tr>
		<td><?php echo h($rubro['Rubro']['id']); ?>&nbsp;</td>
		<td><?php echo h($rubro['Rubro']['name']); ?>&nbsp;</td>
		<td>
		<ul>
		<?php 
			foreach ($rubro['Proveedor'] as $prove) {

				$proveLink = $this->Html->link($prove['name'], 
					array(
						'plugin' => 'account',
						'controller' => 'proveedores',
						'action' => 'edit',
						$prove['id']
					),
					array(
						'class' => 'btn-edit',
					)
				);
				echo "<li>$proveLink</li>";
			}
		 ?>
		 </ul>
		 </td>

		<td class="actions btn-group">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $rubro['Rubro']['id']), array('class'=>'btn btn-default btn-edit')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rubro['Rubro']['id']), array('class'=>'btn btn-danger') , array('¿Estas seguro que quieres borrar el rubro # %s?', $rubro['Rubro']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Página {:page} de {:pages}, mostrando {:current} rubros de {:count} totales, empezando en el rubro {:start} y terminando en el rubro {:end}')
	));
	?>	</p>

</div>
</div>