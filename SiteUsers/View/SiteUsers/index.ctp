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
<div class="users index">

	<div class="btn-group pull-right">
	<?php echo $this->Html->link(__('Create New %s', __('User')), array('admin'=>true,'plugin'>'site_users', 'controller'=> 'site_users', 'action'=>'add'), array('class'=>'btn btn-success btn-lg')); ?>	
	<?php echo $this->Html->link(__('Add Existing %s', __('User')), array('admin'=>true,'plugin'>'site_users', 'controller'=> 'site_users', 'action'=>'add_existing'), array('class'=>'btn btn-default btn-lg')); ?>
	</div>

	<h2><?php echo __d('users', 'Users'); ?></h2>

	<?php
		if (CakePlugin::loaded('Search')) {
			echo $this->Form->create('User');
				echo $this->Form->input('txt_search', array('label' => __d('users', 'Search')));
			echo $this->Form->end(__d('users', 'Search'));
		}
	?>

	<?php echo $this->element('Users.paging'); ?>
	<?php echo $this->element('Users.pagination'); ?>
	<table class="table">
		<tr>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('Rol'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('last_login'); ?></th>
			<th class="actions"><?php echo __d('users', 'Actions'); ?></th>
		</tr>
			<?php
			$i = 0;
			foreach ($users as $user):
				$class = null;
				if ($i++ % 2 == 0) :
					$class = ' class="altrow"';
				endif;
			?>
			<tr<?php echo $class;?>>
				<td>
					<?php echo $user[$model]['username']; ?>
				</td>
				<td>
					<spam class="email-verified"><?php echo $user[$model]['email_verified'] == 1 ? "✓" : "✕"; ?></spam>
					<?php echo $user[$model]['email']; ?>
				</td>
				<td>
					<?php
					$roles = '';
					if (array_key_exists('Rol', $user)) {
						foreach ($user['Rol'] as $rol ) {
							$roles .= ", " .$rol['name'];
						} 
						echo trim($roles, ',');
					}
					?>
				</td>


				<td>
					<?php echo $user[$model]['active'] == 1 ? __d('users', 'Yes') : __d('users', 'No'); ?>
				</td>
				<td>
					<?php 
					echo $user[$model]['last_login'] ?
							$this->Time->timeAgoInWords( $user[$model]['last_login'])
							: __d('users','never'); 
					?>
				</td>
				<td class="actions">

					<div class="dropdown">
						    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
						    <?php echo __('Options') ?>
						    <span class="caret"></span>
						  </button>
					  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					    <li role="presentation">
					    	<?php echo $this->Html->link(__d('users', 'Edit')
					    				, array('action' => 'edit', $user[$model]['id'])
					    				, array('role'=>'menuitem')
					    				); ?>
					    </li>
					    <li role="presentation">
					    <?php echo $this->Html->link(__d('users', 'Assign Other Site'), array('action' => 'assign_other_site', $user[$model]['id'])); ?>
					    </li>

					    <li role="presentation">
					    	<?php echo $this->Form->postLink(__d('users', 'Delete'), array('action' => 'delete', $user[$model]['id']), null, sprintf(__d('users', 'Are you sure you want to delete The User # %s?'), $user[$model]['id'])); ?>

					    </li>

					    <li role="presentation" class="divider"></li>

					    <li role="presentation">
					    	<?php echo $this->Form->postLink(__d('users', 'Dismiss from site'), array('action' => 'delete_from_tenant', $user[$model]['id']), null, sprintf(__d('users', 'Are you sure you want to delete from this site # %s?'), $user[$model]['id'])); ?>
					    </li>
					  </ul>
					</div>
					
					
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php echo $this->element('Users.pagination'); ?>
</div>
