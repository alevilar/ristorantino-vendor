<div class="configs form">
<?php echo $this->Form->create('Config'); ?>
	<fieldset>
		<legend><?php echo __('Edit Config'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Config.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Config.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Configs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Config Categories'), array('controller' => 'config_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Config Category'), array('controller' => 'config_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
