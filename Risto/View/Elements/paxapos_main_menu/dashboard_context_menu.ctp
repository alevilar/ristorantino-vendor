<?php
$roles = array();
$rol = $this->Session->read('Auth.User.Rol');
if ( empty( $rol ) )  {	 
	$roles = null;
} else {
	$roles = Hash::extract($rol, "{n}.id");
}

if ( $roles === null || in_array( ROL_ID_ENCARGADO, $roles ) ) {

 	$this->append('paxapos-main-menu');
	 	echo $this->element("Risto.paxapos_main_menu/home_btn");
?>
		<br>
		<h3 class="center blue-8">
			<?php echo Configure::read("Site.name");?>				
		</h3>
	    <?php 
	    echo $this->element("Risto.paxapos_main_menu/tenant_config");
	    ?>
	    
	    <br>
		<?php echo $this->element("Risto.paxapos_main_menu/mi_cuenta");
	$this->end();
} else { 

	$this->assign('paxapos-main-menu', '');
	$this->start('paxapos-main-menu');
		echo $this->Html->link('<i class="fa fa-sign-out" aria-hidden="true"></i> '.__('Cerrar Sesión')
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
				);

	$this->end();
}