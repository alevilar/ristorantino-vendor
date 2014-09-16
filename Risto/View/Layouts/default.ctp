<!DOCTYPE html>
<html>
    <head>
        <script>
        var URL_DOMAIN = "<?php echo $this->Html->url('/', true); ?>";
        var TENANT = "<php echo $this->Session->read('MtSites.current')?>";
        </script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta charset="utf-8">

        <?php 
        if ( Configure::check('Site.favicon') ) {
            $favicon = Configure::check('Site.favicon');
            if ( is_array( $favicon ) ) {
                foreach ( $favicon as $f=>$ops) {
                    echo $this->Html->meta('icon', $this->Html->url( $f ), $ops ); 
                }
            } else {
                echo $this->Html->meta('icon', $this->Html->url( $favicon ) ); 
                
            }
        } else {
            echo $this->Html->meta('icon', $this->Html->url('/favicon.png')); 
        }
        ?>


        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php

        
        //echo $this->Html->meta('icon');

        echo $this->Html->css(array(
            '/risto/lib/bootstrap/css/bootstrap.min',
            '/risto/lib/bootstrap/css/bootstrap-theme.min',
            '/risto/css/ristorantino/style',
            '/risto/lib/bootstrap_datetimepicker/css/bootstrap-datetimepicker.min',
        ));


        echo $this->element('Risto.per_role_style');
        
        echo $this->Html->script(array(
            '/risto/js/jquery.min',
            '/risto/lib/bootstrap/js/bootstrap.min',
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
        <a class="sr-only" href="#content">Skip to main content</a>

        <!-- Docs master nav -->
        <header class="navbar navbar-default bs-docs-nav" role="banner">


            <div class="container">            

                <?php echo $this->element('Risto.user_login_nav'); ?>

                <div class="navbar-header">
                    <?php 
                    echo $this->fetch("navbar-brand");
                    if ( Configure::check('Site.logo_path') ) {
                        $imgLogo = $this->Html->image(Configure::read('Site.logo_path'), array('height'=>'50'));
                        echo $this->Html->link($imgLogo, '/', array('class' => 'navbar-brand navbar-brand-logo', 'escape'=>false)); 
                    }


                    if ( array_key_exists('tenant', $this->request->params) && !empty( $this->request->params['tenant']) ) {
                        // link a dashboard del sitio tenant
                        echo $this->Html->link(Configure::read('Site.name'), array('plugin'=>'risto', 'controller' => 'pages', 'action' => 'display', 'dashboard'), array('class' => 'navbar-brand tenant-name'));
                    } else {
                        // link a HOME
                        echo $this->Html->link(Configure::read('Site.name'), '/', array('class' => 'navbar-brand tenant-name')) ;
                    }
                    ?>
                </div>

                <?php if (!empty($elementMenu)) {
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
