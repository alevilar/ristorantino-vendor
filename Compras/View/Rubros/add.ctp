<div class="rubros form">
<?php echo $this->Form->create('Rubro'); ?>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('Proveedor');
	?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
