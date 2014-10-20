
<div class="sabores index">
	<div class="btn-group pull-right">
	<?php echo $this->Html->link(__('Crear Adicional'), array('action'=>'add'), array('class'=>'btn btn-success btn-lg')); ?>
	</div>
<h2><?php echo __('Adicionales');?></h2>
<table class="table">

    <tr>
	<?php echo $this->Form->create('Sabor',array('action'=>'index'));?>
	<th><strong><?php echo __('Buscar')?></strong></th>
    <th><?php echo $this->Form->input('Sabor.name',array('placeholder'=>'Nombre', 'label'=>false, 'required' => 0));?></th>
	<th><?php echo $this->Form->input('categoria_name',array('placeholder'=>'Categoría', 'label'=>false));?></th>
	<th><?php echo $this->Form->input('Sabor.precio',array('placeholder'=>'Precio', 'label'=>false));?></th>
	<th><?php echo $this->Form->submit('Buscar', array('class'=>'btn btn-primary'));
              echo $this->Form->end();?></th>
    </tr>
    
<tr>
	
	<th><?php echo $this->Paginator->sort('Nombre','name');?></th>
	<th><?php echo $this->Paginator->sort('Categoria','Categoria.name');?></th>
	<th><?php echo $this->Paginator->sort('Precio','precio');?></th>
	<th><?php echo $this->Paginator->sort('Creado','created');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
if ($this->Paginator->params['paging']['Sabor']['count']!=0) {
$i = 0;
foreach ($sabores as $sabor):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php
                        $name = ($sabor['Sabor']['deleted'])? 
                            $sabor['Sabor']['name']." (borrado el ".date("d/m/y H:i:s", strtotime($sabor['Sabor']['deleted_date']))." )"
                            :
                            $sabor['Sabor']['name'];

                        echo $name; ?>
		</td>
		<td>
			<?php echo $sabor['Categoria']['name']; ?>
		</td>
		<td>
			<?php echo "$".$sabor['Sabor']['precio']; ?>
		</td>
		<td>
			<?php echo date('d-m-y H:i:s',strtotime($sabor['Sabor']['created'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $sabor['Sabor']['id']), array('class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $sabor['Sabor']['id']), array('class'=>'btn btn-default'), null, sprintf(__('¿Esta seguro que desea borrar el sabor: %s?', true), $sabor['Sabor']['name'])); ?>
		</td>
	</tr>
<?php endforeach; 

}else{
    echo('<td>No se encontraron elementos</td>');
}
?>
        

</table>
</div>
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
