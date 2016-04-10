<div class="center">
<?php if (!empty($printer_id)) { ?> 
	<h1>Viendo Comandas del Sector: <?php echo $printers[$printer_id]?></h1>
<?php } else { ?>
	<h1>Viendo Comandas de Todos los Sectores</h1>
<?php } ?>
	<hr>
</div>

<?php

foreach ($comandas as $comanda) {
	echo $this->element('comandero_comanda', array('comanda'=>$comanda));
}