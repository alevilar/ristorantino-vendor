 <?php if ($this->Session->check('Auth.User')): ?>

 	<?php $userName = $this->Session->read('Auth.User.username') . " <small>(" . $this->Session->read('Auth.User.email').")</small>"; ?>



    <div class="nav navbar-right text-warning" style="padding: 15px 0px;">

	 	<div class="dropdown">
		  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
	        <?php echo $userName ?>
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		    <li role="presentation">
		    	<?php echo $this->Html->link( __('User Dashboard'), '/', array('escape'=>false)); ?>
	    	</li>

	    	<li role="menu">
		    	<?php echo $this->Html->link( __('Edit My Profile'), array(
		    		'tenant' => false,
		    		'plugin'=>'users', 'controller'=>'users','action'=>'my_edit'), array('escape'=>false)); ?>
	    	</li>

		    <li role="presentation" class="divider"></li>
		    
		    <li role="menu">
		    	<?php echo $this->Html->link(__('Log Out')
		    						, array(
		    							'controller' => 'users', 
		    							'action' => 'logout', 
		    							'plugin' => 'users'
		    							)
	    							, array(
	    								'role'=>'menuitem', 
	    								'tabindex'=>'4'
									)
				); ?>
	    	</li>
		  </ul>
		</div>
    </div>
<?php endif; ?>