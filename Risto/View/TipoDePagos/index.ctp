<div class="tipoDePagos index">

<div class="users index">
<h2><?php echo __('Tipo de Pagos');?></h2>
<div class="btn-group pull-right">
<?php echo $this->Html->link(__('Crear Tipo de pago', true), array('action'=>'add'), array('class'=>'btn btn-success btn-lg')); ?>
</div>

<table class="table">
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('Nombre');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php


$i = 0;
foreach ($tipoDePagos as $tipoDePago):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php
			echo $tipoDePago['TipoDePago']['id']; 
			if ( $tipoDePago['TipoDePago']['media_id'] ) {
            	echo $this->Html->imageMedia( $tipoDePago['TipoDePago']['media_id'], array('width'=>40)); 
			}
            ?>
		</td>
		<td>
			<?php echo $tipoDePago['TipoDePago']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $tipoDePago['TipoDePago']['id']), array('class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $tipoDePago['TipoDePago']['id']), array('class'=>'btn btn-default'), null, sprintf(__('¿Está seguro que desea borrar el tipo de pago: %s?', true), $tipoDePago['TipoDePago']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('próximo', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Crear Tipo de pago', true), array('action'=>'edit')); ?></li>
		<li><?php echo $this->Html->link(__('Listar Pagos', true), array('controller'=> 'pagos', 'action'=>'index')); ?> </li>
	</ul>
</div>
