<?php 
$rol = $this->Session->read('Auth.User.Rol');
if ( empty( $rol ) )  {	 

$this->append('paxapos-main-menu');?>
		<h3 class="center blue-8">Mis Comercios</h3>

		<!-- Button trigger modal -->
			<button type="button" class="btn btn-success btn-lg btn-block center" data-toggle="modal" data-target="#modal-nuevo-comercio">
				<i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;
			    <?php echo __('Crear Nuevo Comercio')?>
			</button>


			<br>
			<?php echo $this->element("Risto.paxapos_main_menu/mi_cuenta");?>
<?php 
$this->end();
}
?>




<?php

// si no es encargado ni administrador.... no hay nada que hacer en el menu contextual
if ( !empty( $rol ) )  {	 
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
?>