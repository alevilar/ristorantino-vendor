<div class="observaciones index">

<div class="tipoDocumento index">
    <div class="btn-group pull-right">
    <?php echo $this->Html->link(__('Nuevo Tipo de Documento', __('TipoDocumento')), array('action' => 'edit'), array('class'=>'btn btn-success btn-lg')); ?>
    </div>
    <h2><?php echo __('Tipo de Documentos'); ?></h2>

<table class="table">
    <tr>
        <?php echo $this->Form->create('TipoDocumento');?>
	    <th><strong><?php echo __('Buscar')?></strong></th>
        <th colspan= "2"><?php echo $this->Form->input('name',array('placeholder'=>'Nombre', 'label'=>false, 'required' => 0));?></th>
        <th><?php echo $this->Form->submit('Buscar', array('class' => 'btn btn-primary', 'title' => __('Buscar')));?></th>
        <?php echo $this->Form->end();?>
    </tr>

<tr>

	<th><?php echo $this->Paginator->sort('id','Código');?></th>
	<th><?php echo $this->Paginator->sort('name','Nombre de Codigo');?></th>
	<th><?php echo $this->Paginator->sort('name','Nombre');?></th>
	<th class="actions"><?php echo __('Acciones');?></th>
</tr>
<?php
if ($this->Paginator->params['paging']['TipoDocumento']['count']!=0) {
$i = 0;
foreach ($tipoDocumentos as $tipoDocumento):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php
                echo $tipoDocumento['TipoDocumento']['id']; ?>
		</td>
		<td>
			<?php echo $tipoDocumento['TipoDocumento']['codigo_fiscal']; ?>
		</td>
		<td>
			<?php echo $tipoDocumento['TipoDocumento']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $tipoDocumento['TipoDocumento']['id']), array('class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $tipoDocumento['TipoDocumento']['id']), array('class'=>'btn btn-default'), null, sprintf(__('¿Esta seguro que desea borrar el sabor: %s?', true), $tipoDocumento['TipoDocumento']['name'])); ?>
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