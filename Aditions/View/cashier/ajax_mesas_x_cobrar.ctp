<div id="listado-mesas" class="listado-mesas">

<ul>

	<?php foreach($mesas_cerradas as $m):?>
		<li id="mesa-id-<?=  $m['Mesa']['id']?>" onclick="cajero.cobrarMesa('<?=  $m['Mesa']['id']?>','<?= $m['Mesa']['total']?>'); return false;">		

			<span class="mesa-numero"><?= $m['Mesa']['numero']?></span>
			<span class="mozo-numero"><?= $m['Mozo']['numero']?></span>
			<div class="mozo-total">$<?= (int)$m['Mesa']['total']?></div>
			
			<div class="mesa-time-created">Abrió: <?= date('H:i',strtotime($m['Mesa']['created'])) ?></div>		
			<div class="mesa-time-cerro">Cerró: <?= date('H:i',strtotime($m['Mesa']['time_cerro'])) ?></div>	
				
			
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