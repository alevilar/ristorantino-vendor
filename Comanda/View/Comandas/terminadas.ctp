

<link href='https://fonts.googleapis.com/css?family=Chau+Philomene+One' rel='stylesheet' type='text/css'>


<?php $this->start('comandero-title'); ?>
	<div id="comandero-left-header">
		<?php echo $this->element("Comanda.printer_selection"); ?>
	</div>
<?php $this->end();?>




<h1 class="center">Histórico de Comandas</h1><br>

<div id="comandero-content">
	<?php echo $this->element("Comanda.comanda_list");?>
</div>

<div class="clearfix"></div>

<hr>

<?php echo $this->Html->css('/comanda/css/comandero_comanda');?>

