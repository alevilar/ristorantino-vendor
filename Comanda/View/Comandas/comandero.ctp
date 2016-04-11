<div class="center">
<?php if (!empty($printer_id)) { ?> 
	<h1>Viendo <?php echo $cantComandas ?> Comandas del Sector: <?php echo $printers[$printer_id]?></h1>
<?php } else { ?>
	<h1>Viendo <?php echo $cantComandas ?> Comandas de Todos los Sectores</h1>
<?php } ?>
	<hr>
</div>



<?php echo $this->Html->css('/comanda/css/comandero_comanda');?>


<div class="comandero">
	<div class="comandero-comanda-list">
		<?php
		foreach ($comandas as $comanda) {
			echo $this->element('comandero_comanda', array('comanda'=>$comanda));
		}
		?>
	</div>
</div>