<?php $this->element("Risto.layout_modal_edit", array('title'=>'Descuento'));?>

<div class="users index content-white">

	<div class="btn-group pull-right">
	<?php echo $this->Html->link(__('Crear Descuento', true), array('action'=>'add'), array('class'=>'btn btn-success btn-lg btn-add')); ?>
	</div>
	<h2><?php echo __('Descuentos');?></h2>

	<table class="table">
	    <tr>
		<?php echo $this->Form->create('Descuento');?>
		<th><strong><?php echo __('Buscar')?></strong></th>
		<th colspan= "4"><?php echo $this->Form->input('name',array('placeholder'=>__('Nombre del Descuento'), 'label'=>false, 'required' => 0));?></th>
		<th><?php echo $this->Form->submit('Buscar', array('class'=>'btn btn-primary'));
	              echo $this->Form->end();?></th>
	    </tr>

	<tr>
	    <th><?php echo $this->Paginator->sort('Nombre');?></th>
		<th><?php echo $this->Paginator->sort('Descripción');?></th>
		<th><?php echo $this->Paginator->sort('Porcentaje');?></th>
		<th><?php echo $this->Paginator->sort('Creado');?></th>
		<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	if ($this->Paginator->params['paging']['Descuento']['count']!=0) {
		foreach ($descuentos as $descuento):

		?>
		<tr>
				<td>
					<?php echo $descuento['Descuento']['name']; ?>
				</td>
				<td>
					<?php echo $descuento['Descuento']['description']; ?>
				</td>
				<td>
					<?php echo $descuento['Descuento']['porcentaje']; ?>
				</td>
				<td>
					<?php echo $descuento['Descuento']['created']; ?>
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Editar', true), array('plugin'=>'fidelization','controller'=>'descuentos','action'=>'edit', $descuento['Descuento']['id']), array('class'=>'btn btn-default btn-edit')); ?>
					<?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $descuento['Descuento']['id']), array('class'=>'btn btn-danger'), sprintf(__('¿Está seguro que desea borrar el descuento: %s?', true), $descuento['Descuento']['name'])); ?>
				</td>
			</tr>
		<?php endforeach;

	}else{
	    echo('<td colspan="6">No se encontraron elementos</td>');
	}
	?>


	</table>

		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de  {:count} registros totales, iniciando en el registro {:start}, y terminando en el registro {:end}')
		));
		?>
		</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'btn btn-default'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
		<?php echo $this->Paginator->next(__('próximo', true).' >>', array(), null, array('class'=>'btn btn-default'));?>
	</div>
</div>
