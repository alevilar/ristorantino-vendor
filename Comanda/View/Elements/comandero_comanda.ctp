

<div class="comanda" id="comanda-id-<?php echo $comanda['Comanda']['id'];?>">
	<div class="comanda-content">
			<?php
			$class = '';
			if ($comanda['ComandaEstado']['id'] == COMANDA_ESTADO_PENDIENTE) {
				$class = 'text-danger bg-danger';
			}
			if ($comanda['ComandaEstado']['id'] == COMANDA_ESTADO_MARCHANDO) {
				$class = 'text-warning bg-warning';
			}
			if ($comanda['ComandaEstado']['id'] == COMANDA_ESTADO_LISTO) {
				$class = 'text-default';
			}
			?>

		<header class="<?php echo $class?>">


			<div class="center mesa-numero" ><?php echo $comanda['Mesa']['numero']?></div>

			<div class="col-sm-3 comanda-id small center">
				#<?php echo $comanda['Comanda']['id']?>
			</div>

			<div class="col-sm-3 mozo small center">				
				<?php echo $comanda['Mesa']['Mozo']['numero']?>
			</div>

			<div class="col-sm-3 comanda-id small center">
				<?php echo $comanda['ComandaEstado']['name']?>
			</div>

			<div class="col-sm-3 comanda-created small center">
				<b><?php echo $this->Time->format( $comanda['Comanda']['created'], '%H:%M')?></b>
			</div>
			<hr class="<?php echo $class?>">
		</header>

		<div class="clearfix"></div>

		<?php if ( $comanda['Comanda']['observacion'] ) { ?>
		<div class="comanda-observacion text-info">
			<b>Observación:</b> <?php echo $comanda['Comanda']['observacion']?>
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
	
	<div class="comanda-actions btn-group center"  role="group">
	<?php 

		echo $this->Html->link('Mover a otra Mesa', array('action'=>'edit', $comanda['Comanda']['id']), array('class'=>'btn btn-default'));

		echo $this->Html->link('Borrar Comanda', array('action'=>'delete', $comanda['Comanda']['id']), array('class'=>'btn btn-danger'), __('Seguro desea eliminar la Comanda #%s ?', $comanda['Comanda']['id']));

	?>
	</div>

</div>


<script>
	
	comandaId = "#comanda-id-<?php echo $comanda['Comanda']['id'];?>";
	$comanda = $('.comanda-content', comandaId);

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