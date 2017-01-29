<div class="content-white">

<div class="row">

	<div class="col-sm-4">
	<?php


	echo $this->Form->create('PedidoMercaderia');

	echo $this->Form->input('order', array(
		'label' => 'Ordenar',
		'type' => 'radio',
		'default' => $order,
		'options' => array(
			'precio'   => 'Precio',
			'cantidad' => 'Cantidad',
		))
	);

	echo $this->Form->input('type', array(
		'label' => false,
		'type' => 'radio',
		'default' => $type,
		'options' => array(
			'desc' => ' Descendente',
			'asc'  => 'Ascendente',
		))
	);


	echo $this->Form->input('created_from', array('type'=>'datetime', 'default'=>$created_from));

	echo $this->Form->input('created_to', array('type'=>'datetime', 'default'=>$created_to));

	$from=date_create(date($created_from));
	$to=date_create($created_to);
	$diff=date_diff($to,$from);
	$cantDias = $diff->format('%a');

	?>
	<p class="center"><?php echo __("%s días en el rango de búsqueda",$cantDias)?></p>

	<?php
	echo $this->Form->submit('Filtrar');

	echo $this->Form->end();


	?>

	</div>

	<div class="col-sm-8">
		<table class="table">
			<?php

			$aheades = array(
				'Mercaderia',
				'Unidad de Medida',
				'Cantidad',
				'Costo',
				'Cant x Día',
				'Costo x Día',
				);

			echo $this->Html->tableHeaders($aheades);

			$porcenTot = $totales[0][0][$order];
			$leyPareto = 0;
			foreach ( $pedidoMercaderias as $pm ) {
				$porcentaje = ((int) (($pm[0][$order] / $porcenTot) * 10000)) / 100;
	            if ( $leyPareto < 70 ) {
	                $trclass = 'success';
	            } elseif ($leyPareto < 80) {
	                $trclass = 'warning';
	            } else {
	                $trclass = 'danger';
	            }
	            ?>
	            <tr class="<?php echo $trclass ?>">
		            <td><?php echo $pm['Mercaderia']['name']; ?></td>
		            <td><?php echo $pm['UnidadDeMedida']['name'] ?></td>
		            <td><?php echo $pm[0]['cantidad']; ?></td>
		            <td><?php echo $this->Number->currency($pm[0]['precio']); ?></td>
		            <td><?php echo sprintf("%F",$pm[0]['cantidad']/$cantDias); ?></td>
		            <td><?php echo $this->Number->currency($pm[0]['precio']/$cantDias); ?></td>
		        </tr>

	            <?php
	            $leyPareto += $porcentaje;
			}
			?>
		</table>
	</div>

</div>
</div>