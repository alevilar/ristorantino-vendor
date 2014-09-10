<div id="listado-mesas" class="listado-mesas">

<ul>

	<?php foreach($mesas_cerradas as $m):?>
		<li id="mesa-id-<?php echo  $m['Mesa']['id']?>" onclick="cajero.cobrarMesa('<?php echo  $m['Mesa']['id']?>','<?php echo $m['Mesa']['total']?>'); return false;">		

			<span class="mesa-numero"><?php echo $m['Mesa']['numero']?></span>
			<span class="mozo-numero"><?php echo $m['Mozo']['numero']?></span>
			<div class="mozo-total">$<?php echo (int)$m['Mesa']['total']?></div>
			
			<div class="mesa-time-created">Abrió: <?php echo date('H:i',strtotime($m['Mesa']['created'])) ?></div>		
			<div class="mesa-time-cerro">Cerró: <?php echo date('H:i',strtotime($m['Mesa']['time_cerro'])) ?></div>	
				
			
		</li>
	<?php endforeach;?>
</ul>
</div>



<script type="text/javascript">
<!--
// TENGO QUE VOLVER A IREINICIALIZAR LOS SCROLL BARS !!!!
var mesas_scrollbar = 0; //este es el que contiene los datos de la mesa. la comanda
var mesas_listado = 0;//este es el del listado de mesas horizontal

//-->
</script>