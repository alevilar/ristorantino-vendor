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

			<?php if ( empty( $this->request->data[$model]['id']) ): ?>
				<legend><?php echo __d('users', 'Add User'); ?></legend>
			<?php else: ?>
				<legend><?php echo __d('users', 'Edit User'); ?></legend>
			<?php endif; ?>

			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('username', array(
					'label' => __d('users', 'Username')));
				echo $this->Form->input('email', array(
					'label' => __d('users', 'Email')));
				if (!empty($roles)) {
					echo $this->Form->input('Rol', array(
						'label' => __d('users', 'Role')
						));
				}

				if (!empty($sites)) {
					echo $this->Form->input('Site', array(
						'label' => __d('users', 'Site')
						));
				}
			
				echo $this->Form->input('active', array(
						'label' => __d('users', 'Active')));


				if ( empty($this->request->data['$model']['tos']) ) {
					$tosLink = $this->Html->link(__d('users', 'Terms of Service')
						, array('tenant'=>false,'controller' => 'pages', 'action' => 'tos', 'plugin' => null));
					echo $this->Form->input('tos', array(
						'label' => __d('users', 'I have read and agreed to ') . $tosLink));
				}
			?>
		</fieldset>
	<?php echo $this->Form->button('Submit', array('class'=>'btn btn-success')); ?>		
	<?php echo $this->Html->link(__('Cancel'), array('action'=>'index'), array('class'=>'btn btn-default') ); ?>
	<?php echo $this->Form->end(); ?>
</div>
