<?php $this->start('modals');?>        
	<div id="nuevoMozo" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Crear Mozo</h4>
	      </div>
	      <div class="modal-body">
			<?php echo $this->element('Mesa.mozo_add');?>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<?php $this->end();?>


<?php
$this->Paginator->options(array('url' => $this->passedArgs)); 
?>

<div class="mozos index">


<button type="button" class="btn btn-success btn-lg pull-right" data-toggle="modal" data-target="#nuevoMozo">
  <?php echo __('Crear %s', Configure::read('Mesa.tituloMozo') )?>
</button>




	<h1><?php echo Inflector::pluralize( Configure::read('Mesa.tituloMozo') ); ?></h1>
<table cellpadding="0" cellspacing="0" class="table">
<tr>
    <th><?php echo $this->Paginator->sort('activo');?></th>
	<th><?php echo $this->Paginator->sort('numero', 'Alias');?></th>
    <th><?php echo $this->Paginator->sort('nombre');?></th>
    <th><?php echo $this->Paginator->sort('appellido');?></th>
    <th>Foto</th>
	<th class="actions"><?php echo __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($mozos as $mesa):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
			
		<td>

			<?php if ($mesa['Mozo']['activo']) {?>
		    	<span class="glyphicon glyphicon-ok-circle mozo-puntito <?php echo $mesa['Mozo']['activo'] ? 'text-success' : '' ?>" aria-hidden="true" style="font-size:18pt"></span>
		    <?php } else { ?>
		    	<span class="glyphicon glyphicon-remove-circle mozo-puntito <?php echo $mesa['Mozo']['activo'] ? 'text-success' : '' ?>" aria-hidden="true" style="font-size:18pt"></span>
		    <?php } ?>
        </td>
		<td>
			<?php echo $mesa['Mozo']['numero']; ?>
		</td>
        <td>
            <?php echo $mesa['Mozo']['nombre']; ?>
		</td>
		<td>
            <?php echo $mesa['Mozo']['apellido']; ?>
		</td>
		<td>
             <?php 
             if (!empty($mesa['Mozo']['media_id']) ) {
             	echo $this->Html->imageMedia( $mesa['Mozo']['media_id'], array('img-polaroid', 'style'=>'width: 68px')); 
			 } else {
			 	echo "&nbsp;";
			 }
             	?>
		</td>
		<td class="actions">
			
            <!-- Split button -->
			<div class="btn-group">
			  <?php echo $this->Html->link(__('Editar'), array('action'=>'edit', $mesa['Mozo']['id']), array('class'=>'btn btn-default  btn-sm')); ?>

			  <button type="button" class="btn btn-default  btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			  </button>
			  <ul class="dropdown-menu">
			    <li class="">
			    	<?php echo $this->Form->postLink( __('Borrar'), array('action'=>'delete', $mesa['Mozo']['id']), array('class'=>' btn-sm'), __('¿Desea borrar el %s nº # %s?. Si lo borra perderá todo el historial y sus estadísticas.', Configure::read('Mesa.tituloMozo'), $mesa['Mozo']['numero']) ); ?>
		    	</li>
			  </ul>
			</div>

		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<p>
<?php
echo $this->Paginator->counter(array(
    'format' => __('Página {:page} de {:pages}, mostrando {:current} elementos de {:count}')
));
?></p>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('anterior'), array(), null, array('class'=>'btn btn-default'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('próximo').' >>', array(), null, array('class'=>'btn btn-default'));?>
</div>

