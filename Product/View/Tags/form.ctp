
<div class="sabores form content-white">

<?php echo $this->Form->create('Tag');?>
<fieldset>
	<?php
		echo $this->Form->input('id','Id');
		echo $this->Form->input('name',array('label'=>__('Nombre')));
	?>

	<div class="productos-checkbox">
		<label>Seleccionar los productos que usan este Tag</label>
		<?php echo $this->Form->input('Producto', array('multiple'=>'checkbox', 'label'=>false));	?>
	</div>

	<div class="clearfix"></div>
<?php
  if (empty($this->request->data['Tag']['id'])):?>
     <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
     <?php else: ?>
     <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg pull-left')); ?>
<?php endif;?>
        <?php echo $this->Html->link(__('Cancelar'), array('action'=>'index'), array('class'=>'btn btn-default btn-lg pull-right'));?>
    <?php echo $this->Form->end();?>
</fieldset>
</div>

<style>
	.productos-checkbox .form-group{
		float: left;
	}
	.productos-checkbox .checkbox{
		float: left;
		margin: 3px 5px;
	}
</style>