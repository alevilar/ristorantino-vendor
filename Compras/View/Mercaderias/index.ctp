<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Mercaderia'));?>


<div class="content-white">
<h1>Mercaderias</h1>

<?php echo $this->Html->link('Agregar Mercadería', array('action'=>'add'), array('class'=>'btn btn-success pull-right btn-add')); ?>


<br><br>

<?php

$nombres = array(); //se setea el array.

 foreach($mercaderias as $m) { //por cada mercaderia, se guarda el nombre en el array.
		$indice = count($nombres) + 1; 
		$nombres[$indice] = $m['Mercaderia']['name'];		
}

?>

<table class="table">

<thead>
	<tr>
		<th>ID</th>
		<th>Nombre</th>
		<th>Unidad de Medida</th>
		<th>Default Proveedor</th>
		<th>Rubro</th>
		<th>Acciones</th>
	</tr>
</thead>
<tbody>
<?php foreach($mercaderias as $m ) { ?>
	<tr>
		<td><?php echo $m['Mercaderia']['id']?></td>
		<td><?php echo $m['Mercaderia']['name']?></td>
		<td><?php echo $m['UnidadDeMedida']['name']?></td>
		<td><?php echo $m['Proveedor']['name']?></td>
		<td><?php echo $m['Rubro']['name']?></td>
		<td class="btn-group">

			<?php echo $this->Html->link('editar', array('action'=>'edit', $m['Mercaderia']['id']), array('class'=>'btn btn-default btn-edit'));?>

            <?php echo $this->Html->link(__('Borrar'), array('action'=>'delete',  $m['Mercaderia']['id']), array('class'=>'btn btn-danger'), sprintf(__('Seguro que querés borrar # %s?'), $m['Mercaderia']['name'])); ?>

 <?php 


          $i = 1; //se inicia en 1 porque el array arranca desde el indice 1, el indice 0 esta vacio.
          $cantidad_duplicados = 0;

          while (isset($nombres[$i])) { //Mientras este seteado el indice $i...

          	$nombre = $nombres[$i]; //El valor del array en ese indice lo recibe esta variable $nombre
          
          	if (strtolower($m['Mercaderia']['name']) == strtolower($nombre)) { 
          	//Se hace una comparación case insensitive (no sensible a mayusculas /minusculas)

          		$cantidad_duplicados = $cantidad_duplicados + 1; //Si entra en este if, la variable $cantidad_duplicados suma 1.
          	}

          	$i = $i + 1; //Suma de a 1 para recorrer el siguiente indice.

          }

        if($cantidad_duplicados >= 2) { 
        //Si esta variable llega a 2 o más, quiere decir que se encontro en dos o más indices dicho nombre de mercadería.

		    echo $this->Html->link('Ver duplicados', 
		    array('action'=>'verDuplicados',
		    $m['Mercaderia']['id'],
		    $m['Mercaderia']['name']), 
		    array('class'=>'btn btn-primary')); 

		  }


?>

		</td>

	</tr>
<?php } ?>
</tbody>
</table>

</div>