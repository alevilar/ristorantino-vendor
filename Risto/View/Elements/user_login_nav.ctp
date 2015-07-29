 <?php if ($this->Session->check('Auth.User')): ?>

 	<?php 

 	if ( array_key_exists('tenant', $this->request->params) && !empty( $this->request->params['tenant']) ) {
 		echo $this->Html->link(Configure::read('Site.name'), array('plugin'=>'risto', 'controller' => 'pages', 'action' => 'display', 'dashboard'), array('class' => 'navbar-brand tenant-name'));
 	}


 	$userName = $this->Session->read('Auth.User.username') . " <small>(" . $this->Session->read('Auth.User.email').")</small>"; 
 	?>



    <div>

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
<?php else: ?>

	<div class="p-login">
	    
	        <div class="form-group">

	        <?php

	        echo $this->Form->create('User', array( 'url' => array('plugin'=>'users','controller'=>'users','action'=>'login'), 'role'=>'form', 'class' => 'navbar-form'));

	        echo $this->Form->input('email',array(
	        	'placeholder'=>'Email', 
	        	'label'=>false, 
	        	'div' => false,
				'style' => 'margin-right: 3px;')
	        );

			echo $this->Form->input('password', array('type'=>'password','placeholder'=>'Contraseña', 'label'=>false, 'div' => false,));

			echo $this->Form->button('<span class="p-hide">Ingresar</span>', array('type'=>'submit','class'=>'btn btn-default', 'escape'=>false));

			echo $this->Form->end();

	        ?>	        
	        </div>
	    
	    <p class="p-new-user">
	    <?php
	    echo $this->Html->link('Olvidaste tu contraseña?',
			array('plugin'=>'users', 'controller'=>'users', 'action'=>'reset_password'),
			array(
				'class'=>'small')
			);
	    echo "&nbsp;&nbsp;";
	     echo $this->Html->link('Registrate acá.',
			array('plugin'=>'users', 'controller'=>'users', 'action'=>'register'),
			array(
				'class'=>'small')
			);
		?>
	    </p>
	</div>
	<div class="p-login-media" role="group">
	    <p class="navbar-text pull-left">O ingresá con</p>
	    <span class="p-facebook">
	    	<?php echo $this->Html->link('<span class="p-hide">Facebook</span>', array('plugin'=>'users', 'controller'=>'users', 'action'=>'auth_login', 'facebook'), array('class'=>'btn btn-default navbar-btn', 'escape'=>false)); ?>
    	</span>
	    <span class="p-google">
	    	<?php echo $this->Html->link('<span class="p-hide">Google</span>'
						, array('plugin'=>'users', 'controller'=>'users', 'action'=>'auth_login', 'google'), array('class'=>'btn btn-default navbar-btn', 'escape'=>false)); ?>	    	
	    		    	
    	</span>
	</div>

<?php
endif;
?>