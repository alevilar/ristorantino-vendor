<!DOCTYPE html>
<html>
    <head>
        <script>
        <?php App::uses('MtSites', 'MtSites.Utility'); ?>
        var URL_DOMAIN = "<?php echo $this->Html->url('/', true); ?>";
        var TENANT = "<php echo MtSites::getSiteName()?>";
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
    </head>
    <body>
    <div class="p-main-background"></div>
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

        <header class="navbar navbar-default bs-docs-nav hidden-print" role="banner" id="p-header">
            <div class="fluid-container">
                 
                <div class="navbar-header col-md-4 col-sm-12">
                            <?php 
                            echo $this->fetch("navbar-brand");

                            $logeadoClassForLogo = '';
                            if ( $this->Session->read('Auth.User.id') ) {
                                $logeadoClassForLogo = 'logo-logueado';
                            }

                             // link a HOME
                            if ( Configure::check('Site.logo_path') ) {
                                $imgLogo = $this->Html->image(Configure::read('Site.logo_path'), array());
                                echo $this->Html->link($imgLogo, '/', array('class' => 'navbar-brand navbar-brand-logo '.$logeadoClassForLogo, 'escape'=>false)); 
                            } else {
                                echo $this->Html->link(Configure::read('Site.name'), '/', array('class' => 'navbar-brand tenant-name '.$logeadoClassForLogo)) ;
                            }
                            ?>
                        <p class="text-nowrap eslogan">Innovando, gestionando, creciendo.</p>
                </div>

                
                <div aria-expanded="false" class=" col-md-8 col-sm-12">
                    
                    <?php
                    if ( array_key_exists('tenant', $this->request->params) && !empty( $this->request->params['tenant']) ) {
                        ?>
                        <h1 class="tenant-name text-info">
                        <?php
                        echo $this->Html->link(Configure::read('Site.name'), array('plugin'=>'risto', 'controller' => 'pages', 'action' => 'display', 'dashboard'));
                        ?>
                        </h1>
                        <?php
                    }
                    ?>



                    <div class="navbar-right">
                        <?php echo $this->element('Risto.user_login_nav'); ?>
                    </div> 
                </div>
            </div>
        </header>


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


        <?php echo $this->fetch('pre-content'); ?>

        <div class="container bs-docs-container" id="content">       
            
            <div class="row">
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>

        <?php echo $this->fetch('post-content'); ?>



        <footer id="p-footer" class="hidden-print">      
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="p-links text-center">
                                    <?php
                                     echo $this->Html->link('Términos y Condiciones', array('plugin'=>false, 'controller'=>'pages', 'action'=>'tos')); 
                                     ?>                                     
                                    <br>
                                    <cite>info@paxapos.com</cite>
                                    <br>
                                    <?php

                                    echo $this->Html->link('Contacto',
                                        array('plugin'=>'paxapos', 'controller'=>'paxapos', 'action'=>'contact')
                                        );
                                    ?>
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
                <br><br><br>   
            </div>
            
        </footer>        
    </body>
</html>
