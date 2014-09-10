<div class="estados form">
<?php echo $this->Form->create('Estado');?>
	<fieldset>
 		<legend><?php __('Add Estado');?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('color', array(
			'options' => array(
				'btn-default' => 'btn-default',
				'btn-primary' => 'btn-primary',
				'btn-success' => 'btn-success',
				'btn-warning' => 'btn-warning',
				'btn-danger'  => 'btn-danger',
				)
			));
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Estados', true), array('action'=>'index'));?></li>
	</ul>
</div>
