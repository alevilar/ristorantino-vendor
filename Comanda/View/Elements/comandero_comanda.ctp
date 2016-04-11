

<div class="comanda bg-success" id="comanda-id-<?php echo $comanda['Comanda']['id'];?>">

			<?php
			$class = '';
			if ($comanda['ComandaEstado']['id'] == COMANDA_ESTADO_PENDIENTE) {
				$class = 'text-danger bg-danger';
			}
			if ($comanda['ComandaEstado']['id'] == COMANDA_ESTADO_MARCHANDO) {
				$class = 'text-success bg-success';
			}
			if ($comanda['ComandaEstado']['id'] == COMANDA_ESTADO_LISTO) {
				$class = 'text-default';
			}
			?>

	<div class="small center"><b>Comanda #<?php echo $comanda['Comanda']['id']?></b></div>
	<div class="small center">Creada: <?php echo $this->Time->nice( $comanda['Comanda']['created'])?></div>


	<h2 class="center <?php echo $class?>"><?php echo $comanda['ComandaEstado']['name']?></h2>
	


	<div class="row center">
		<div class="col-md-6 mozo">	
			<?php 
			$mozoConFoto = $comanda['Mesa']['Mozo']['media_id'];
			if ( $mozoConFoto ) {
				echo $this->Html->imageMedia($mozoConFoto, array('width'=>'64', 'height' => '64'));
			}
			?>
			<div class="clearfix"></div>
			<?php
			echo $comanda['Mesa']['Mozo']['numero']
			?>
		</div>

		<div class="col-md-6 mesa-numero">
			Mesa: <?php echo $comanda['Mesa']['numero']?>
			
		</div>
	</div>



	<?php if ( $comanda['Comanda']['observacion'] ) { ?>
	<div class="comanda-observacion text-info">
		<?php echo $comanda['Comanda']['observacion']?>
	</div>
	<?php } ?>

	

	

	<ul class="listado-detalle-comanda">
	<?php foreach ( $comanda['DetalleComanda'] as $dc ) {?>
		<?php 
		$cant =  $dc['cant'] - $dc['cant_eliminada'];
		$prodName = $dc['Producto']['name'];
		$obs = $dc['observacion'];
		if ( $obs ) {
			$prodName .= " (OBSERVACION: $obs)";
		}

		if ( $cant > 0 ) {
			$adicionales = '';
			if ( count($dc['DetalleSabor']) ) {
				// si hay adicionales armo el listado
				$adicionales = '<ul>';
				foreach ( $dc['DetalleSabor'] as $ds ) {
					$adicionales .= "<li>".$ds['Sabor']['name']."</li>";
				}
				$adicionales .= '</ul>';
			}
			echo "<li><b>$cant</b> $prodName$adicionales</li>";
		}
		?>
	<?php }?>
	</ul>

	<?php 
	// crear un link para pasar el siguiente estado
	

	$linkPrev = $linkNext = null;

	// btn and
	$comandaEstadoAntId = $comanda['ComandaEstado']['id'] - 1;
	if ( $comandaEstadoAntId >= COMANDA_ESTADO_PENDIENTE ) {
		$linkPrev = array('action'=>'comandero_estado_change', $comanda['Comanda']['id'], $comandaEstadoAntId );
		$linkPrev = Router::url($linkPrev);

	}

	// btn next
	$comandaEstadoNextId = $comanda['ComandaEstado']['id'] + 1;
	if ( $comandaEstadoNextId <= COMANDA_ESTADO_LISTO ) {
		$linkNext = array('action'=>'comandero_estado_change', $comanda['Comanda']['id'], $comandaEstadoNextId );
		$linkNext = Router::url($linkNext);
	}
	?>
</div>


<script>
	
	comandaId = "#comanda-id-<?php echo $comanda['Comanda']['id'];?>";
	$comanda = $(comandaId);

	<?php if ( $linkNext ) { ?>
	$comanda.on('click', function(){
		location.href = "<?php echo $linkNext?>";
	});
	<?php } ?>


	<?php if ( $linkPrev ) { ?>
	$comanda.on('dblclick', function(){
		location.href = "<?php echo $linkPrev?>";
	});
	<?php } ?>
</script>