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
			<p>
			Desde aquí puede asignar usuarios existentes en PaxaPOS, para ello debe ingresar el nombre de usuario y email válido. En caso de no existir esa combinación, se creará un nuevo usuario para que pueda utilizarlo en este sitio
			</p>
			<legend><?php echo __d('users', 'Assign Other Site to User %s', $this->request->data[$model]['username']); ?></legend>

			<?php
				echo $this->Form->input('id');

				echo $this->Form->input('Site', array(
					'label' => __d('users', 'Site')
					));
			
			?>
		</fieldset>
	<?php echo $this->Form->button('Submit', array('class'=>'btn btn-success')); ?>		
	<?php echo $this->Html->link(__('Cancel'), array('action'=>'index'), array('class'=>'btn btn-default') ); ?>

	<?php echo $this->Form->end(); ?>
</div>
