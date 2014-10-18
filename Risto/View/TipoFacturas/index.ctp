<div class="observaciones index">

<div class="users index">
<h2><?php echo __('Tipo de Facturas');?></h2>
<div class="btn-group pull-right">
<?php echo $this->Html->link(__('Crear Tipo Facturas', true), array('action'=>'add'), array('class'=>'btn btn-success btn-lg')); ?>
</div>

<table class="table">
    <tr>
	<?php echo $this->Form->create('TipoFactura',array('action'=>'index'));?>
	<th colspan= "3"><?php echo $this->Form->input('Observacion.name',array('placeholder'=>'Nombre', 'label'=>false, 'required' => 0));?></th>
	<th><?php echo $this->Form->end('Buscar', array('class'=>'btn btn-default'));?></th>
    </tr>

<tr>

	<th><?php echo $this->Paginator->sort('id','Código');?></th>
	<th><?php echo $this->Paginator->sort('name','Nombre');?></th>
	<th><?php echo $this->Paginator->sort('name','Nombre de Codigo');?></th>
	<th><?php echo $this->Paginator->sort('created','Creado');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
if ($this->Paginator->params['paging']['TipoFactura']['count']!=0) {
$i = 0;
foreach ($tipoFacturas as $tipoFactura):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php
                echo $tipoFactura['TipoFactura']['id']; ?>
		</td>
		<td>
			<?php echo $tipoFactura['TipoFactura']['name']; ?>
		</td>
		<td>
			<?php echo $tipoFactura['TipoFactura']['codename']; ?>
		</td>
		<td>
			<?php echo date('d-m-y H:i:s',strtotime($tipoFactura['TipoFactura']['created'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $tipoFactura['TipoFactura']['id']), array('class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $tipoFactura['TipoFactura']['id']), array('class'=>'btn btn-default'), null, sprintf(__('¿Esta seguro que desea borrar el sabor: %s?', true), $tipoFactura['TipoFactura']['name'])); ?>
		</td>
	</tr>
<?php endforeach;

}else{
    echo('<td>No se encontraron elementos</td>');
}
?>


</table>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('próximo', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Crear Adicional', true), array('action'=>'add')); ?></li>
	</ul>
</div>