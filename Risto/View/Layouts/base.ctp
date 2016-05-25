<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->element('Paxapos.layout_head');?>
		<?php echo $this->Html->css('/risto/css/risto_base_style');?>
	</head>
	<body>
    	<?php echo $this->fetch('modals'); ?>
	    <div id="body-wrapper">

	        <div class="p-main-background"></div>
			    
		    <div id="content-wrapper">
		        
		        <a class="sr-only" href="#content">Skip to main content</a>

		        <?php echo $this->element('Risto.show_errors_for_config') ?>
	

				<?php echo $this->element('Risto.layout_messages');?>


		        <header id="p-header">
		        	<?php $headerNavbarClass = $this->fetch('header_navbar_class');
		        	?>
		            <nav class="navbar <?php echo $headerNavbarClass?>">
		                <div class="container-fluid">
		                            
		                    <div id="logo-image-container" class="center">
		                        <div id="isologo">
		                            <?php 
		                            if ( $this->fetch('navbar-brand') ) {
		                            	echo $this->fetch('navbar-brand');
		                            } else {
		                            	$img = $this->Html->image('/paxapos/img/isologo_rojo.png', array()); 
		                            	echo $this->Html->link($img, '/', array('escape' => false, 'class'=>'
		                            	'));
		                            }
		                            ?>
		                        </div>
		                    </div>

		                    <?php echo $this->fetch('header-nav');?>   
		                </div>
		            </nav>
		            <?php echo $this->fetch('post-header');?>
		        </header>

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
	        	<?php echo $this->element('Paxapos.google_analitycs') ?> 
	        </div>  <!-- EOF content wrapper -->
        </div><!-- EOF body wrapper -->
    </body>
</html>
