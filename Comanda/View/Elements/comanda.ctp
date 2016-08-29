<div class="comanda-content comanda-estado-id-<?php echo $comanda['Comanda']['comanda_estado_id']?>">
		<?php $class = $comanda['ComandaEstado']['class_color'];?>

		<header class="<?php echo $class?> col-sm-12">
			<div class="row">
				<div class="col-sm-6 comanda-id small" style="text-align: left;">
					#<?php echo $comanda['Comanda']['id']?>
				</div>


				<div class="col-sm-6 comanda-id small" style="text-align: right;">
					<?php echo $comanda['ComandaEstado']['name']?>
				</div>

				<div class="center mesa-numero col-sm-12" ><?php echo $comanda['Mesa']['numero']?></div>
				
				<div class="col-sm-6 mozo small" style="text-align: left;">				
					<?php echo $comanda['Mesa']['Mozo']['numero']?>
				</div>


				<div class="col-sm-6 comanda-created small center" style="text-align: right;">
					<b><?php echo $this->Time->format( $comanda['Comanda']['created'], '%H:%M')?></b>
				</div>
			</div>
		</header>

		<div class="clearfix"></div>

		<?php if ( $comanda['Comanda']['observacion'] ) { ?>
		<div class="comanda-observacion text-info">
		<br/>
			<b>Observación de la Comanda:</b><br/><span class="hablar"><?php echo $comanda['Comanda']['observacion']?></span>
			<br/>
		</div>
		<?php } ?>


		<?php if (!empty($comanda['Entrada'])) { ?>
			<h4 class="tipo-plato tipo-plato-entrada">Entradas</h4>
			<ul class="listado-detalle-comanda">
			<?php foreach ( $comanda['Entrada'] as $dc ) {?>
				<?php 
				$cant =  $dc['DetalleComanda']['cant'] - $dc['DetalleComanda']['cant_eliminada'];
				$prodName = $dc['Producto']['name'];
				$obs = $dc['DetalleComanda']['observacion'];
				if ( $obs ) {
					$prodName .= " (Observación: $obs)";
				}

				if ( $cant > 0 ) {
					$adicionales = '';
					if ( count($dc['DetalleSabor']) ) {
						// si hay adicionales armo el listado
						$adicionales = '<ul>';
						foreach ( $dc['DetalleSabor'] as $ds ) {
							$adicionales .= "<li class='detalle-sabor'>".$ds['Sabor']['name']."</li>";
						}
						$adicionales .= '</ul>';
					}
					echo "<li class='detalle-comanda'><b class='detalle-comanda-cant'>$cant</b> $prodName$adicionales</li>";
				}
				?>
			<?php }?>
			</ul>
		<?php }?>

		<?php if (!empty($comanda['Entrada']) && !empty($comanda['Principal'])) { ?>
			<h4 class="tipo-plato tipo-plato-principal">Principal</h4>
		<?php } ?>
		<ul class="listado-detalle-comanda">
		<?php foreach ( $comanda['Principal'] as $dc ) {?>
			<?php 
			$cant =  $dc['DetalleComanda']['cant'] - $dc['DetalleComanda']['cant_eliminada'];
			$prodName = $dc['Producto']['name'];
			$obs = $dc['DetalleComanda']['observacion'];
			if ( $obs ) {
				$prodName .= " (Observación: $obs)";
			}

			if ( $cant > 0 ) {
				$adicionales = '';
				if ( count($dc['DetalleSabor']) ) {
					// si hay adicionales armo el listado
					$adicionales = '<ul>';
					foreach ( $dc['DetalleSabor'] as $ds ) {
						$adicionales .= "<li class='detalle-sabor'>".$ds['Sabor']['name']."</li>";
					}
					$adicionales .= '</ul>';
				}
				echo "<li class='detalle-comanda'><b class='detalle-comanda-cant'>$cant</b> $prodName$adicionales</li>";
			}
			?>
		<?php }?>
		</ul>

		

	</div>
	
	<div class="comanda-actions">
		<div class="btn-group center"  role="group">
		<?php 

			echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', array('action'=>'edit', $comanda['Comanda']['id']), array('class'=>'btn btn-default', 'escape'=>false));

			echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span>', array('action'=>'delete', $comanda['Comanda']['id']), array('class'=>'btn btn-danger', 'escape'=>false), __('Seguro desea eliminar la Comanda #%s ?', $comanda['Comanda']['id']));

		?>
		</div>
	</div>