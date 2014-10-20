<div class="tag index">
<div class="users index">
<h2><?php echo __('Tags');?></h2>
<div class="btn-group pull-right">
<?php echo $this->Html->link(__('Crear Tag', true), array('action'=>'add'), array('class'=>'btn btn-success btn-lg')); ?>
</div>

<table class="table">
    <tr>
	<?php echo $this->Form->create('Tag',array('action'=>'index'));?>
	<th><strong><?php echo __('Buscar')?></strong></th>
	<th colspan= "2"><?php echo $this->Form->input('Observacion.name',array('placeholder'=>'Nombre', 'label'=>false, 'required' => 0));?></th>
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
                echo $observacions['Tag']['id']; ?>
		</td>
		<td>
			<?php echo $observacions['Tag']['name']; ?>
		</td>
		<td>
			<?php echo date('d-m-y H:i:s',strtotime($tags['Tag']['created'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $tags['Tag']['id']), array('class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $tags['Tag']['id']), array('class'=>'btn btn-default'), null, sprintf(__('¿Esta seguro que desea borrar el sabor: %s?', true), $tags['Tag']['name'])); ?>
		</td>
	</tr>
<?php endforeach;

}else{
    echo('<td colspan="4">No se encontraron elementos</td>');
}
?>


</table>
</div>
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