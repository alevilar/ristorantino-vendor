<?php $this->extend('Mesa.Mozos/index')?>


<?php $this->start('navbar-main-menu') ?>
<?php echo $this->element('MtSites.pasos', array('current'=> 2, 'nextLink'=> array(
	'plugin' => 'product',
	'controller' => 'productos',
	'action' => 'producto_first_time',
), 'backLink' => array(
	'plugin' => 'install',
	'controller' => 'configurations',
	'action' => 'first_configuration_wizard',
)))?>
<?php $this->end();?>

