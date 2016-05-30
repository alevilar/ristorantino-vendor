<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Unidad de Medida'));?>


<div class="content-white">



<?php echo $this->Html->link('Crear Nueva Unidad', array('action'=>'add'), array('class'=>'btn btn-lg btn-success btn-add pull-right')); ?>

<h1>Unidades de Medidas</h1>
<div>
<br>
<ul>
	<?php foreach ( $unidadDeMedidas as $u ) { ?> 
		<li>
			<?php echo $u['UnidadDeMedida']['name']?>
		
			<?php echo $this->Html->link('editar', array('action'=>'add', $u['UnidadDeMedida']['id']), array('class'=>'btn btn-default btn-edit'));?>

            <?php echo $this->Form->postLink(__('Borrar'), array('action'=>'delete',  $u['UnidadDeMedida']['id']), array('class'=>'btn btn-link'), __('Seguro que querés borrar # %s?', $u['UnidadDeMedida']['name'])); ?>

		</li>
	<?php } ?>
</ul>
</div>

</div>