
<div class="sabores form">
<?php echo $this->Form->create('Tag');?>
<fieldset>
 		<legend><?php echo __('Editar Etiqueta');?></legend>
	<?php
		echo $this->Form->input('id','Id');
		echo $this->Form->input('name',array('label'=>__('Nombre')));
		echo $this->Form->input('producto_id',array('label'=>__('Producto')));
	?>
     <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg'));
            echo $this->Form->end();?>
</fieldset>
</div>
<!--<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $this->Form->value('Sabor.id')), null, sprintf(__('¿Esta seguro que desea borrar el sabor: %s?', true), $this->Form->value('Sabor.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Sabores', true), array('action'=>'index'));?></li>
	</ul>
</div>-->
