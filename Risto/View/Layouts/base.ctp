<!DOCTYPE html>
<html>
    <head>
        <?php App::uses('MtSites', 'MtSites.Utility'); ?>
        <script>
        var TENANT = "<?php echo MtSites::getSiteName()?>";
        var URL_DOMAIN = "<?php echo $this->Html->url('/', true); ?>";
        </script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta charset="utf-8">

        
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">

        <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#666666">
        <meta name="msapplication-TileImage" content="/mstile-144x144.png">
        <meta name="theme-color" content="#ffffff">



        <!--google  font Lato-->
        <link href='http://fonts.googleapis.com/css?family=Merriweather+Sans:700,400,300' rel='stylesheet' type='text/css'>
        


        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php



        //echo $this->Html->meta('icon');

        echo $this->Html->css(array(
            'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
           // '/risto/lib/bootstrap/css/bootstrap-theme.min',
          //  '/risto/lib/bootstrap/css/dataTables.bootstrap',
            '/paxapos/css/paxapos-bootstrap-supernice',
            '/risto/css/ristorantino/style',
            '/risto/css/ristorantino/paxapos.bootstrap',
            '/risto/css/ristorantino/p-carousel-fade',
            '/risto/lib/bootstrap_datetimepicker/css/bootstrap-datetimepicker.min',
        ));

        echo $this->Html->css(array('/risto/css/ristorantino/print'), 'stylesheet', array('media' => 'print'));



        echo $this->element('Risto.per_role_style');
        
        echo $this->Html->script(array(
            '/risto/js/jquery.min',
            'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
         //   '/risto/lib/bootstrap/js/jquery.dataTables.min',
            '/risto/lib/bootstrap_datetimepicker/js/bootstrap-datetimepicker.min',
        ));

        //echo $this->Html->script->link('Controls'); // PAD numerico
        
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    </head>
    <body>


    <?php echo $this->fetch('modals'); ?>




    <div id="body-wrapper">
        <div class="p-main-background"></div>
		    <div id="content-wrapper">

		        <?php echo $this->element('Risto.show_errors_for_config') ?>
		        <a class="sr-only" href="#content">Skip to main content</a>


		        <?php
		        $flashMes = $this->Session->flash();
		        $authMes  = $this->Session->flash('auth');          
		        if ( $flashMes || $authMes ) {
		            ?>
		        <div class="fluid-container hidden-print">
		            <div class="row">
		                <div id="mesajes" class="col-md-12" role="alert">
		                    <?php
		                    echo $flashMes;
		                    echo $authMes;       
		                    ?>
		                </div>
		            </div>
		        </div>
		        <?php }?>



		        <header id="p-header">
		        	<?php $headerNavbarClass = $this->fetch('header_navbar_class');
		        	?>
		            <nav class="navbar navbar-default <?php echo $headerNavbarClass?>">
		                <div class="container-fluid">
		                            
		                    <div id="logo-image-container" class="navbar-header center">
		                        <div id="isologo" class="navbar-brand">
		                            <?php 
		                            if ( $this->fetch('navbar-brand') ) {
		                            	echo $this->fetch('navbar-brand');
		                            } else {
		                            	$img = $this->Html->image('/paxapos/img/isologo_rojo.png', array('height'=>'46px')); 
		                            	echo $this->Html->link($img, '/', array('escape' => false));
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

		        <div id="content" class="container-fluid bs-docs-container">
		        	<?php if ($this->fetch('sidebar')) { ?>
		        		<div class="row">
		        			<div class="col-sm-3">
		        				<?php echo $this->fetch('sidebar'); ?>
		        			</div>	
		        			<div class="col-sm-9">


						        <?php 
						        if ( !empty($elementMenu) && $this->elementExists($elementMenu)) {
						            ?>
						            <nav class="hidden-print" role="navigation">
					                    <ul class="nav nav-tabs nav-justified">
					                    <?php echo $this->element($elementMenu); ?>
					                    </ul>
						            </nav>
						            <?php
						        }
						        echo $this->fetch("navbar-main-menu");
						        ?>
						        
		        				<?php echo $this->fetch('content'); ?>
		        			</div>
		        		</div>
		        	<?php } else { ?>

				        <?php 
				        if ( !empty($elementMenu) && $this->elementExists($elementMenu)) {
				            ?>
				            <nav class="hidden-print" role="navigation">
				                <div class="container">
				                    <ul class="nav nav-tabs nav-justified">
				                    <?php echo $this->element($elementMenu); ?>
				                    </ul>
				                </div>
				            </nav>
				            <?php
				        }
				        echo $this->fetch("navbar-main-menu");
				        ?>

		            	<?php echo $this->fetch('content'); ?>
	            	<?php } ?>
		        </div>

		        <?php echo $this->fetch('post-content'); ?>


		        <footer id="p-footer" class="hidden-print">
		        	<?php echo $this->element('Risto.google_ads/horizontal'); ?> 
		            <div class="container-fluid">
		                <div class="row">
		                    <div class="col-sm-4">
		                        <div class="p-links text-center">
		                                    <?php
		                                     echo $this->Html->link('Términos y Condiciones', array('plugin'=>false, 'controller'=>'pages', 'action'=>'tos')); 
		                                     ?>                                     
		                                    <br>
		                                    <?php

		                                    echo $this->Html->link('Contacto',
		                                        array('plugin'=>'paxapos', 'controller'=>'paxapos', 'action'=>'contact')
		                                        );
		                                    ?>
		                                    <br>
		                                    <small>
		                                        info@paxapos.com<br>
		                                        Av del Mar 32, esquina Bunge.<br>
		                                        Pinamar, Buenos Aires, Argentina.
		                                    </small>
		                                </li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-sm-4">
		                        <div class="p-logo-footer">
		                            <span class="p-hide">PaxaPos</span>
		                        </div>
		                    </div>
		                    <div class="col-sm-4">
		                        <div class="p-social-media">
		                                <ul class="nav list-unstyled">
		                                    <li class="img-circle"><a href="https://facebook.com/paxapos" class="p-sm-facebook"><span class="p-hide">Facebook</span></a></li>
		                                    <li class="img-circle"><a href="https://www.youtube.com/channel/UCa90_rTOMD4qdOhi2WQV6rw" class="p-sm-youtube"><span class="p-hide">Youtube</span></a></li>
		                                    <li class="img-circle"><a href="https://twitter.com/paxapos" class="p-sm-twitter"><span class="p-hide">Twitter</span></a></li>
		                                </ul>
		                            </div>
		                        </div>
		                    </div>
		                </div>    
		                <div class="clearfix"></div>         
		            </div>
		            
		        </footer>        

        <?php echo $this->element('Paxapos.google_analitycs') ?>    
        </div>
    </body>
</html>
