<?php
/**
 * Copyright 2010 - 2014, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2014, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="users form">
	<?php echo $this->Form->create($model, array('type'=>'post')); ?>
		<fieldset>

			<legend><?php echo __d('users', 'Add User into %s', $site['Site']['name']); ?></legend>
			


			<?php
				echo $this->Form->input('username', array(
					'label' => __d('users', 'Username')
					));
				echo $this->Form->input('email', array(
					'label' => __d('users', 'Email')));
				if (!empty($roles)) {
					echo $this->Form->input('Rol', array(
						'label' => __d('users', 'Role')
						));
				}

			?>


			<?php echo $this->Form->button(__('Add Existing User into My Site'), array('class'=>'btn btn-danger')); ?>		
			<?php echo $this->Html->link(__('Create New %s', __('User')), array('action'=>'add'), array('class'=>'btn btn-default') ); ?>

			<?php echo $this->Html->link(__('Volver al Listado de Usuarios'), array('action'=>'index')); ?>

	
	<?php echo $this->Form->end(); ?>
</div>
