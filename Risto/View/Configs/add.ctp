<div class="configs form">
<?php echo $this->Form->create('Config'); ?>
	<fieldset>
		<legend><?php echo __('Add Config'); ?></legend>
	<?php
		echo $this->Form->input('config_category_id');
		echo $this->Form->input('key');
		echo $this->Form->input('value');
		echo $this->Form->input('description');
		echo $this->Form->input('created_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Configs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Config Categories'), array('controller' => 'config_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Config Category'), array('controller' => 'config_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
