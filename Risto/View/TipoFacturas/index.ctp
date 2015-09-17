<div class="observaciones index">

<div class="users index">
<div class="btn-group pull-right">
<?php echo $this->Html->link(__('Crear Tipo Facturas', true), array('action'=>'edit'), array('class'=>'btn btn-success btn-lg')); ?>
</div>
<h2><?php echo __('Tipo de Facturas');?></h2>

<table class="table">
    <tr>
	<?php echo $this->Form->create('TipoFactura',array('action'=>'index'));?>
	<th><strong><?php echo __('Buscar')?></strong></th>
	<th colspan= "3"><?php echo $this->Form->input('Observacion.name',array('placeholder'=>'Nombre', 'label'=>false, 'required' => 0));?></th>
	<th><?php echo $this->Form->submit('Buscar', array('class'=>'btn btn-primary'));
              echo $this->Form->end();?></th>
    </tr>

<tr>

	<th><?php echo $this->Paginator->sort('id','Código');?></th>
	<th><?php echo $this->Paginator->sort('name','Nombre');?></th>
	<th><?php echo $this->Paginator->sort('codename','Nombre de Codigo');?></th>
	<th><?php echo $this->Paginator->sort('created','Creado');?></th>
	<th class="actions"><?php echo __('Acciones');?></th>
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
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de  {:count} registros totales, iniciando en el registro {:start}, y terminando en el registro {:end}')
	));
	?>
	</p>

<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('anterior'), array(), null, array('class'=>'btn btn-default'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('siguiente').' >>', array(), null, array('class'=>'btn btn-default'));?>
</div>