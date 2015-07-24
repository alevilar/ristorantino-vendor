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


        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php


        //echo $this->Html->meta('icon');

        echo $this->Html->css(array(
            '/risto/lib/bootstrap/css/bootstrap.min',
           // '/risto/lib/bootstrap/css/bootstrap-theme.min',
          //  '/risto/lib/bootstrap/css/dataTables.bootstrap',
            '/risto/css/ristorantino/style',
            '/risto/lib/bootstrap_datetimepicker/css/bootstrap-datetimepicker.min',
        ));


        echo $this->element('Risto.per_role_style');
        
        echo $this->Html->script(array(
            '/risto/js/jquery.min',
            '/risto/lib/bootstrap/js/bootstrap.min',
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
        <?php echo $this->element('Risto.show_errors_for_config') ?>
        <a class="sr-only" href="#content">Skip to main content</a>

        <!-- Docs master nav -->
        <header class="navbar navbar-default bs-docs-nav" role="banner">


            <div class="container">            

                <?php echo $this->element('Risto.user_login_nav'); ?>

                <div class="navbar-header">
                    <?php 
                    echo $this->fetch("navbar-brand");

                    if ( array_key_exists('tenant', $this->request->params) && !empty( $this->request->params['tenant']) ) {
                        if ( Configure::check('Site.logo_path') ) {
                            $imgLogo = $this->Html->image(Configure::read('Site.logo_path'), array('height'=>'50'));
                            echo $this->Html->link($imgLogo, array('plugin'=>'risto', 'controller' => 'pages', 'action' => 'display', 'dashboard'), array('class' => 'navbar-brand navbar-brand-logo', 'escape'=>false)); 
                        }
                        // link a dashboard del sitio tenant
                        echo $this->Html->link(Configure::read('Site.name'), array('plugin'=>'risto', 'controller' => 'pages', 'action' => 'display', 'dashboard'), array('class' => 'navbar-brand tenant-name'));
                    } else {
                        // link a HOME
                        if ( Configure::check('Site.logo_path') ) {
                            $imgLogo = $this->Html->image(Configure::read('Site.logo_path'), array('height'=>'50'));
                            echo $this->Html->link($imgLogo, '/', array('class' => 'navbar-brand navbar-brand-logo', 'escape'=>false)); 
                        } else {
                            echo $this->Html->link(Configure::read('Site.name'), '/', array('class' => 'navbar-brand tenant-name')) ;
                        }
                    }
                    ?>
                </div>

                <?php if ( !empty($elementMenu) && $this->elementExists($elementMenu)) {
                    echo $this->element($elementMenu);
                }
                echo $this->fetch("navbar-main-menu");
                ?>
            </div>
        </header>

        <div class="container bs-docs-container" id="content">

            <div class="row">
                <div id="mesajes alert  alert-dismissible" class="col-md-12" role="alert">
                    <?php
                    echo $this->Session->flash();
                    echo $this->Session->flash('auth');                    
                    ?>
                </div>
            </div>
            
            <div class="row">
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>

        <footer>
            <div class="container">
                <div class="logo">
                    <h1><?php echo Configure::read('System.name') . ' ' . Configure::read('System.version') ?></h1>
                </div>               
            </div>
        </footer>
    </body>
</html>
