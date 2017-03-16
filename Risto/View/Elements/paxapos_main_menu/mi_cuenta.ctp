
	<h3 class="center blue-8">Mi Cuenta</h3>



	<div class="list-group">
		
		<?php echo $this->Html->link( '<i class="fa fa-user" aria-hidden="true"></i> 
'. __('Editar mi Perfil'), array(
	    		'tenant' => false,
	    		'plugin'=>'users', 'controller'=>'users','action'=>'my_edit'), array('class'=>'list-group-item','escape'=>false)); ?>
	    <?php 

if (CakeSession::read("Auth.User.is_admin") == 1) {
	    		echo $this->Html->link( '<i class="fa fa-group" aria-hidden="true"></i> 
'. __('Lista de usuarios'), array(
	    		'tenant' => false,
	    		'plugin'=>'users', 'controller'=>'users','action'=>'index'), array('class'=>'list-group-item','escape'=>false));

}
	    ?>

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