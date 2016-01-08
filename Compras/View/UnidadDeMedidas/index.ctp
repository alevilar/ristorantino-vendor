<h1>Unidades de Medidas</h1>


<?php echo $this->Html->link('Crear Nueva Unidad', array('action'=>'add'), array('class'=>'btn btn-lg btn-success')); ?>

<div>
<br>
<ul>
	<?php foreach ( $unidadDeMedidas as $u ) { ?> 
		<li><?php echo $u['UnidadDeMedida']['name']?></li>
	<?php } ?>
</ul>
</div>