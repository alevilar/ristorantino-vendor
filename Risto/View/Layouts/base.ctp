<!DOCTYPE html>
<?php App::uses('MtSites', 'MtSites.Utility'); ?>


<html lang="es-AR">

<html>
	<head>
		<?php echo $this->element('Risto.header_inner_ristorantino') ?>
		<?php echo $this->Html->css('/risto/css/risto_base_style');?>
		<?php echo $this->element('Paxapos.layout_head');?>
		<!-- <script src="https://use.fontawesome.com/a785a3f126.js"></script> -->

		<?php echo $this->Html->css('/risto/font-awesome-4.6.3/css/font-awesome.min');?>


		<?php echo $this->Html->script('Risto.jquery/jquery-ui')?>


	</head>
	<body>


		<!-- Modal -->
		<div class="modal fade" id="paxapos-main-menu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
		      
		      <div class="modal-body">
		       		<?php echo $this->fetch('paxapos-main-menu');?>
		      </div>
		      <div class="modal-footer center">
		        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('Cerrar')?></button>
		      </div>
		    </div>
		  </div>
		</div>



    	<?php echo $this->fetch('modals'); ?>
	    <div id="body-wrapper">

	        <div id="p-main-background">
	        	<?php echo $this->Html->image('/paxapos/img/logotip_azul_con_isologo_rojo.png');?>
	        </div>
			    
		    <div id="content-wrapper">
		        

		        <?php echo $this->element('Risto.show_errors_for_config') ?>
	

				<?php echo $this->element('Risto.layout_messages');?>


				<?php echo $this->element('Risto.layout_header_late');?>		        

		        <?php echo $this->fetch('pre-content'); ?>

		        <?php
		        // element cargado en el beforeFilter de los controllers para mostrar un menu automaticamente
		        $autoElementMenu = '';
		        if ( !empty($elementMenu) && $this->elementExists($elementMenu)) {
		            $autoElementMenu = $this->element($elementMenu);
		        }

		        ?>

		        <div id="content" class="container-fluid bs-docs-container">
		        	<?php if ($this->fetch('sidebar')) { ?>
		        		<div class="row">
		        			<div class="col-sm-3">
		        				<?php echo $this->fetch('sidebar'); ?>
		        			</div>	
		        			<div class="col-sm-9">
						        <?php 
						        echo $autoElementMenu;
						        echo $this->fetch("navbar-main-menu");
						        echo $this->fetch('content'); 
						        ?>
		        			</div>
		        		</div>
		        	<?php } else { ?>
				        <?php 
				        echo $autoElementMenu;
				        echo $this->fetch("navbar-main-menu");
				        echo $this->fetch('content'); 
				        ?>
	            	<?php } ?>
		        </div>

		        <?php echo $this->fetch('post-content'); ?>
				<?php echo $this->fetch('footer'); ?>

				<div class="row">
					<div class="col-md-8 col-md-offset-2 col-xs-12">
						<br><br><br>
						<?php echo $this->element("Risto.google_ads/horizontal") ?>
					</div>
				</div>


	        	<?php echo $this->element('Paxapos.google_analitycs') ?> 
	        </div>  <!-- EOF content wrapper -->
        </div><!-- EOF body wrapper -->


        
		
		<!-- ESTILOS RECOLECTADOS -->
		<?php
		echo $this->fetch('script');
        ?>        
    </body>
</html>
