<?php $this->assign('title', 'Mi Cuenta');?>


<?php $this->start('header-nav'); ?>

    <div id="logotipo-image" class="navbar-text navbar-left">
        <?php  echo $this->Html->image('/paxapos/img/logotypo_blanco.png', array('height'=>'26px')); ?>
    </div>

    <div id="logo-slogan" class="navbar-text navbar-left hidden-xs hidden-sm">
        <h4 class="white-8">Innovando, gestionando, creciendo</h4>
    </div>

<?php $this->end(); ?>



<?php $this->start('modals'); ?>

<div id="modal-nuevo-comercio" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h1 class="modal-title"><?php echo __d('install', 'Crear Nuevo Comercio'); ?></h1>
      </div>
      <div class="modal-body">
        <?php echo $this->element('MtSites.new_site_creator');?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $this->end(); ?>




<div class="col-md-4  hidden-xs">
	<?php if ( !$this->Session->check('Auth.User')){ ?>
	<h3>Registrese para ingresar al sistema</h3>
	<h1>¡Punto de Venta Web, y GRATUITO!</h1>

	<div class="col-md-4 col-md-offset-4">
		<hr />
	<?php echo $this->Html->link('Registrate', array('plugin'=> 'users','controller'=>'users', 'action'=>'register'), array('class'=>'btn btn-lg btn-success btn-block')) ?>
	</div>
	<?php } else { ?>
	<h1 class="center">Novedades</h1>


	<a class="twitter-timeline" href="https://twitter.com/PaxaPos" data-widget-id="636390749106511872" height="300px">Tweets  @PaxaPos.</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


	<?php } ?>
</div>


<div class="col-md-4 login">
	<?php 
	if ( !$this->Session->check('Auth.User')){
		echo $this->element('Users.boxlogin');			
	} else {		
 	?>
	<h1 class="center">Mis Comercios</h1>

	<div class="list-group">
		<?php App::uses('MtSites', 'MtSites.MtSites'); ?>
		<?php if ( $this->Session->check('Auth.User.Site') ): ?>
			<?php foreach ( $this->Session->read('Auth.User.Site') as $s ):
			?>
				<div class="list-group-item" style="font-size: 15pt;">
					
					<?php echo  $this->Html->link( $s['name'] , array( 'tenant' => $s['alias'], 'plugin'=>'risto' ,'controller' => 'pages', 'action' => 'display', 'dashboard' ), array('class'=>'' ));?>

                    <?php 
                    /*
                    if ( $this->Session->read('Auth.User.is_admin') ) {
                    
                    	echo $this->Form->postLink("X", array( 'tenant' => false, 'plugin'=>'mt_sites' ,'controller' => 'sites', 'action' => 'delete', $s['id']), array(
                    		'confirm' => 'Are you sure want to delete site named '.$s['name'].'?',
                    		'class'=>'btn btn-danger btn-xs pull-right',
                    		'title' => __("Eliminar")
                    		));
					
                    	}
                    	*/
                    		 ?>
				</div>
			<?php endforeach; ?>
    	<?php endif; ?>
    </div>



	<div class="well well-lg">
		¡Podés crear todos los Comercios que quieras!, agregá tantas sucursales o puntos de ventas como necesites.<br> ¡En PaxaPos no hay límites!
		<br><br>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-success btn-lg btn-block center" data-toggle="modal" data-target="#modal-nuevo-comercio">
		  <?php echo __('Crear Nuevo Comercio')?>
		</button>

	</div>

	<?php } // fin IF usuario logeado ?>
		
</div>


<div class="col-md-4 login">
	<h1 class="center">Mi Perfil</h1>

	<div class="center">
	<?php echo $this->Html->link( __('Editar mi Perfil'), array(
		'tenant' => false,
		'plugin'=>'users', 'controller'=>'users','action'=>'my_edit'), array('class'=>'btn btn-link center')); ?>
	</div>
	<dl class="dl-horizontal">
		<dt>Username:</dt>
		<dd><?php echo  $this->Session->read('Auth.User.username')?></dd>
		
		<dt>E-mail:</dt>
		<dd><?php echo  $this->Session->read('Auth.User.email')?></dd>
	</dl>

	<div class="center">
		<BR>
	<?php echo $this->Html->link(__d('users', 'Change your password'), array('plugin'=>'users', 'controller'=>'users','action' => 'change_password'), array('class'=>'text-danger')); ?>
	</div>
</div>