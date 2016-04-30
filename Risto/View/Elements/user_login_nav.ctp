 <?php if ($this->Session->check('Auth.User')):
 	$userName = $this->Session->read('Auth.User.username') . " <small>(" . $this->Session->read('Auth.User.email').")</small>"; 
 	?>

    <div class="navbar-user-logued">

	 	<div class="dropdown">
		  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
	        <?php echo $userName ?>
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		    <li role="presentation">
		    	<?php echo $this->Html->link( __('Mis Comercios'), '/', array('escape'=>false)); ?>
	    	</li>


	    	<li role="menu">
		    	<?php echo $this->Html->link( __('Editar mi Perfil'), array(
		    		'tenant' => false,
		    		'plugin'=>'users', 'controller'=>'users','action'=>'my_edit'), array('escape'=>false)); ?>
	    	</li>

	    	

		    <li role="presentation" class="divider"></li>
		    
		    <li role="menu">
		    	<?php echo $this->Html->link(__('Cerrar Sesión')
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
<?php 

endif;
?>