<div class="content-white">

<div class="row">
<div class="col-xs-2 col-sm-2 col-md-2">

<?php echo $this->Html->link('Volver a la lista de mercaderías', array('action'=>'index'), array('class'=>'btn btn-info'));?>

</div>

<?php
foreach($datosmercaderia as $m) {
$name = $m['Mercaderia']['name'];	?>

<div class="col-xs-10 col-sm-10 col-md-10">

<center><h4>Listado de duplicaciones de la mercadería ID: <?php echo $m['Mercaderia']['id'];?> - Nombre: <?php echo $m['Mercaderia']['name'];?>. Para unificar:</h4></center>

</div>

<?php } ?>

</div>

<h6>Info: Con las 'duplicaciones' nos referimos a mercaderia cuyo nombre es igual a la misma materia prima que usted dio click en 'Ver duplicados'. Si le da click en 'Unificar mercadería' las mercaderías listadas abajo se perderan (el proveedor, el rubro y la unidad de medida se mantienen almacenados).</h6>


<table class="table">

<thead>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Unidad de Medida</th>
		<th>Default Proveedor</th>
		<th>Rubro</th>
	</tr>
</thead>
<tbody>
<?php foreach($mercaderias as $m ) {

if ($m['Mercaderia']['id'] != $id) {	?>

	<tr>
		<td><?php echo $m['Mercaderia']['id']?></td>
		<td><?php echo $m['Mercaderia']['name']?></td>
		<td><?php echo $m['UnidadDeMedida']['name']?></td>
		<td><?php echo $m['Proveedor']['name']?></td>
		<td><?php echo $m['Rubro']['name']?></td>


	</tr>
<?php  
       }
     }       
?>
</tbody>
</table>


<center><?php echo $this->Html->link('Unificar mercadería', array('action'=>'unificarMercaderia',$id,$name), array('class'=>'btn btn-info')); ?></center>

</div>