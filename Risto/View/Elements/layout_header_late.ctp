<?php echo $this->Html->css('Risto.layout_header_late');?>


<?php echo $this->Html->script('Risto.layout_header_late', false);?>


<header id="p-header">

	<?php echo $this->element('Risto.paxapos_header_userdata');?>
	

	<?php $headerNavbarClass = $this->fetch('header_navbar_class');
	?>
    <nav class="navbar <?php echo $headerNavbarClass?>">
        <div class="container-fluid">
                    
            <div id="logo-image-container" class="center">
            	<div id="loader-container">
                    	<i class="fa fa-cog fa-spin fa-3x fa-fw red"></i>
						<span class="sr-only">Loading...</span>
                </div>
                <div id="isologo" class="late" style="display:none;">
                    <?php 
                    if ( $this->fetch('navbar-brand') ) {
                    	echo $this->fetch('navbar-brand');
                    } else {

                    if ( $this->fetch('paxapos-main-menu') ) {
                    	$link = '#paxapos-main-menu';
                    } else {
                    	if (Configure::check('Site.alias')) {
                    		$link = array(
                    			'tenant' => Configure::read('Site.alias'),
                    			'plugin' => 'risto',
                    			'controller' => 'pages',
                    			'action' => 'display',
                    			'dashboard'
                    		);
                    	} else {
                        	$link = '/'; // root del usuario
                    	}
                    }

                    	$img = $this->Html->image('/paxapos/img/isologo_rojo.png', array()); 
                    	echo $this->Html->link($img, $link, array(
                    			'escape' => false, 
                    			'class'=>'',
                    			'data-toggle' => "modal",
                    			// 'data-target' => "#paxapos-main-menu",
                    			));
                    }
                    ?>
                    
                </div>
            </div>

            <?php echo $this->fetch('header-nav');?>
        </div>
    </nav>
    <?php echo $this->fetch('post-header');?>
</header>