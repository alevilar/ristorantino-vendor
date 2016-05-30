<?php $this->extend('Product.Productos/index')?>


<?php $this->start('css'); ?>
	<style>
		.btn-precio-futuro{
			display: none;
		}
	</style>
<?php $this->end();?>


?>

<?php $this->start('navbar-main-menu') ?>
<?php echo $this->element('MtSites.pasos', array('current'=> 3, 'nextLink'=> array(
	'plugin' => 'install',
	'controller' => 'configurations',
	'action' => 'first_configuration_wizard_end',
), 'backLink' => array(
	'plugin' => 'mesa',
	'controller' => 'mozos',
	'action' => 'add_first_time',
)))?>
<?php $this->end();?>

