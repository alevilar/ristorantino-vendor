<?php $this->element("Risto.layout_modal_edit", array('title'=>'Tag'));?>



<div class="tag index content-white">
	<div class="btn-group pull-right">
	<?php echo $this->Html->link(__('Crear Tag', true), array('action'=>'add'), array('class'=>'btn btn-success btn-lg btn-add')); ?>
	</div>
	<h2><?php echo __('Tags');?></h2>

	<table class="table">
	    <tr>
		<?php echo $this->Form->create('Tag');?>
		<th><strong><?php echo __('Buscar')?></strong></th>
		<th colspan= "2"><?php echo $this->Form->input('name',array('placeholder'=>'Nombre', 'label'=>false, 'required' => 0));?></th>
		<th><?php echo $this->Form->submit('Buscar', array('class'=>'btn btn-primary'));
	              echo $this->Form->end();?></th>
	   </tr>

		<tr>

			<th><?php echo $this->Paginator->sort('id','Código');?></th>
			<th><?php echo $this->Paginator->sort('name','Nombre');?></th>
			<th><?php echo $this->Paginator->sort('created','Creado');?></th>
			<th class="actions"><?php __('Acciones');?></th>
		</tr>
		<?php
		if ($this->Paginator->params['paging']['Tag']['count']!=0) {
		$i = 0;
		foreach ($tag as $tags):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
			<tr<?php echo $class;?>>
				<td>
					<?php
		                echo $tags['Tag']['id']; ?>
				</td>
				<td>
					<?php echo $tags['Tag']['name'];?>
				</td>
				<td>
					<?php echo date('d-m-y H:i:s',strtotime($tags['Tag']['created'])); ?>
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('Editar'), array('action'=>'edit', $tags['Tag']['id']), array('class'=>'btn btn-default btn-edit')); ?>
					<?php echo $this->Html->link(__('Borrar'), array('action'=>'delete', $tags['Tag']['id']), array('class'=>'btn btn-danger'), null, sprintf(__('¿Esta seguro que desea borrar el sabor: %s?', true), $tags['Tag']['name'])); ?>
				</td>
			</tr>
		<?php endforeach;

		}else{
		    echo('<td colspan="4">No se encontraron elementos</td>');
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

