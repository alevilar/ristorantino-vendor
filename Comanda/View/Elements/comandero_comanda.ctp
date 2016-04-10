<?php echo $this->Html->css('/comanda/css/comandero_comanda');?>
<div class="comanda col-sm-4">
<div class="box">

			<?php
			$class = '';
			if ($comanda['ComandaEstado']['id'] == COMANDA_ESTADO_PENDIENTE) {
				$class = 'text-primary';
			}
			if ($comanda['ComandaEstado']['id'] == COMANDA_ESTADO_MARCHANDO) {
				$class = 'text-success';
			}
			if ($comanda['ComandaEstado']['id'] == COMANDA_ESTADO_LISTO) {
				$class = 'text-danger';
			}
			?>
			<h2 class="center <?php echo $class?>"><?php echo $comanda['ComandaEstado']['name']?></h2>
	


	<div class="row center">
		<div class="col-md-3">	
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

		<div class="col-md-9">
			Mesa: <?php echo $comanda['Mesa']['numero']?>


			
			<h4>Comanda #<?php echo $comanda['Comanda']['id']?></h4>
		</div>
	</div>



	<?php if ( $comanda['Comanda']['observacion'] ) { ?>
	<div class="comanda-observacion text-info">
		<?php echo $comanda['Comanda']['observacion']?>
	</div>
	<?php } ?>

	Creada: <?php echo $this->Time->nice( $comanda['Comanda']['created'])?><br>

	

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
	


	// btn ant
	$comandaEstadoAntId = $comanda['ComandaEstado']['id'] - 1;
	if ( $comandaEstadoAntId >= COMANDA_ESTADO_PENDIENTE ) {
		$link = array('action'=>'comandero_estado_change', $comanda['Comanda']['id'], $comandaEstadoAntId );
		$estadoName = $comandaEstados[$comandaEstadoAntId];

		if ($comandaEstadoAntId == COMANDA_ESTADO_PENDIENTE) {
			$class = 'btn-primary';
		}
		if ($comandaEstadoAntId == COMANDA_ESTADO_MARCHANDO) {
			$class = 'btn-success';
		}
		if ($comandaEstadoAntId == COMANDA_ESTADO_LISTO) {
			$class = 'btn-danger';
		}
		echo $this->Html->link($estadoName, $link, array('class'=>"btn btn-sm $class")); 
	}

	// btn next
	$comandaEstadoNextId = $comanda['ComandaEstado']['id'] + 1;
	if ( $comandaEstadoNextId <= COMANDA_ESTADO_LISTO ) {
		$link = array('action'=>'comandero_estado_change', $comanda['Comanda']['id'], $comandaEstadoNextId );
		$estadoName = $comandaEstados[$comandaEstadoNextId];

		if ($comandaEstadoNextId == COMANDA_ESTADO_PENDIENTE) {
			$class = 'btn-primary';
		}
		if ($comandaEstadoNextId == COMANDA_ESTADO_MARCHANDO) {
			$class = 'btn-success';
		}
		if ($comandaEstadoNextId == COMANDA_ESTADO_LISTO) {
			$class = 'btn-danger';
		}
		echo $this->Html->link($estadoName, $link, array('class'=>"btn btn-sm $class")); 
	}
	?>
</div>
</div>
