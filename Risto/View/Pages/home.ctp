<div class="col-md-8">
	<?php if ( !$this->Session->check('Auth.User')){ ?>
	<h3>Registrese para ingresar al sistema</h3>
	<h1>¡Punto de Venta Web, y GRATUITO!</h1>
	<?php } else { ?>
	<h1>Dashboard</h1>
	<?php } ?>
</div>





<div class="col-md-4 login">
	<div class="row">

		<div class="col-md-12">
			<?php 
			if ( !$this->Session->check('Auth.User')){
				echo $this->element('Users.boxlogin');			
		} else {		
		 ?>
			<h3>&nbsp;</h3>
			<?php echo $this->Html->link(__('Add New Site'), array('plugin'=>'install', 'controller'=>'site_setup', 'action'=>'installsite'), array('class'=>'btn btn-success btn-lg center')); ?>

			<h1>Mis Sitios</h1>
			
			<div class="list-group">
				<?php App::uses('MtSites', 'MtSites.MtSites'); ?>
				<?php if ( $this->Session->check('Auth.User.Site') ): ?>
					<?php foreach ( $this->Session->read('Auth.User.Site') as $s ): ?>
						<?php echo  $this->Html->link( $s['name'] , array( 'tenant' => $s['alias'], 'plugin'=>'risto' ,'controller' => 'pages', 'action' => 'display', 'dashboard' ), array('class'=>'list-group-item' ));?>
					<?php endforeach; ?>
				<?php endif; ?>

			 </div>
		<?php } ?>
		</div>
	</div>
</div>