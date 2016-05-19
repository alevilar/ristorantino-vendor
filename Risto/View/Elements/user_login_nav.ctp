 <?php if ($this->Session->check('Auth.User')):
 	$userName = $this->Session->read('Auth.User.username') . " <small>(" . $this->Session->read('Auth.User.email').")</small>"; 
 	?>

    <div class="navbar-user-logued">

	 	<div class="dropdown">
		  <button class="btn btn-default btn-sm dropdown-toggle navbar-btn" type="button" id="dropdownMenu1" data-toggle="dropdown">
	        <?php echo $userName ?>
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		    <li role="presentation">
		    	<?php echo $this->Html->link( __('Mi Cuenta'), '/', array('escape'=>false)); ?>
	    	</li>


		    <li role="presentation" class="divider"></li>


	    	<?php if ( $this->Session->check('Auth.User.Site') ): ?>
	    	<li role="presentation" class="dropdown-header">
		    	Mis Comercios
	    	</li>
	    	

					<?php foreach ( $this->Session->read('Auth.User.Site') as $s ):
					?>
						<li role="menu">
							
							<?php echo  $this->Html->link( $s['name'] , array( 'tenant' => $s['alias'], 'plugin'=>'risto' ,'controller' => 'pages', 'action' => 'display', 'dashboard' ), array('class'=>'' ));?>	                       
						</li>
					<?php endforeach; ?>
			<?php else: ?>
        	<li role="menu">
	    		<?php echo $this->Html->link(__('Crear Nuevo Comercio'), array('plugin'=>'mt_sites', 'controller'=>'sites', 'action'=>'install'), array('class'=>'text-success bg-success menuitem')); ?>
	    	</li>
        	<?php endif; ?>


            	<li role="separator" class="divider"></li>


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