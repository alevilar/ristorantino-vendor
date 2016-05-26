
	<h3 class="center blue-8">Mi Cuenta</h3>



	<div class="list-group">
		
		<?php echo $this->Html->link( '<i class="fa fa-user" aria-hidden="true"></i> 
'. __('Editar mi Perfil'), array(
	    		'tenant' => false,
	    		'plugin'=>'users', 'controller'=>'users','action'=>'my_edit'), array('class'=>'list-group-item','escape'=>false)); ?>

		<?php echo $this->Html->link('<i class="fa fa-sign-out" aria-hidden="true"></i> '.__('Cerrar Sesión')
		    						, array(
		    							'controller' => 'users', 
		    							'action' => 'logout', 
		    							'plugin' => 'users'
		    							)
	    							, array(
	    								'role'=>'menuitem', 
	    								'tabindex'=>'4',
	    								'class' => 'list-group-item',
	    								'escape' => false
									)
				); ?>

	</div>