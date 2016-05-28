<?php $this->assign('title', 'Mi Cuenta');?>


<?php $this->append('paxapos-main-menu');?>

	<h3 class="center blue-8">Mis Comercios</h3>

	<!-- Button trigger modal -->
		<button type="button" class="btn btn-success btn-lg btn-block center" data-toggle="modal" data-target="#modal-nuevo-comercio">
			<i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;
		    <?php echo __('Crear Nuevo Comercio')?>
		</button>


		<br>
		<?php echo $this->element("Risto.paxapos_main_menu/mi_cuenta");?>
<?php $this->end();?>


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



<style>
	.nuevo-comercio{
		opacity: 0.6;
	}

	.nuevo-comercio:hover{
		opacity: 1;
	}

	#p-comercios-list{
		display: none;
	}
</style>


<div id="loading" class="center blue blue-9">
	<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
	<span class="sr-only">Cargando...</span>
</div>

<div id="p-comercios-list" class="col-sm-4 col-sm-offset-4">
		<?php 
		if ( !$this->Session->check('Auth.User')){
			echo $this->element('Users.boxlogin');			
		} else {		
	 	?>
		<h1 class="center">Mis Comercios</h1>

		<div class="list-group center">
			<?php App::uses('MtSites', 'MtSites.MtSites'); ?>
			<?php if ( $this->Session->check('Auth.User.Site') ): ?>
				<?php foreach ( $this->Session->read('Auth.User.Site') as $s ):
				?>
						
						<?php echo  $this->Html->link( "<h4>".$s['name']."</h4>" , array( 'tenant' => $s['alias'], 'plugin'=>'risto' ,'controller' => 'pages', 'action' => 'display', 'dashboard' ), array('class'=>'list-group-item', 'escape'=>false ));?>

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
				<?php endforeach; ?>
	    	<?php endif; ?>
	    </div>

	 	

		<?php } // fin IF usuario logeado ?>
</div>




<?php $this->append('script');?>
	<script type="text/javascript">
		$(function() {
			var $el = $("#p-comercios-list");
			var topos = ( $(window).height() - $el.height() ) / 2  - 100 + "px";
		    $el.css({
		       // 'position' : 'absolute',
		       // 'top' : '50%',
		        'margin-top' : topos
		    });

		    $("#loading").hide();
		    setTimeout(function(){
		    	$el.show('fade');
		    }, 500);
		});
	</script>
<?php $this->end();?>