<div class="content-white">

<?php
$nombres = array(); //se setea el array.

 foreach($mercaderias as $m) { //por cada mercaderia, se guarda el nombre en el array.
		$indice = count($nombres) + 1; 
		$nombres[$indice] = $m['Mercaderia']['name'];

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
}	

?>

<?php foreach($datosmercaderia as $m) { ?>


<h3>Viendo la mercaderia: <?php echo $m['Mercaderia']['name']; ?></h3>

<div class="btn-group">

<?php echo $this->Html->link('Editar', array('action'=>'edit', $m['Mercaderia']['id']), array('class'=>'btn btn-default btn-edit'));?>

<?php echo $this->Html->link(__('Borrar'), array('action'=>'delete',  $m['Mercaderia']['id']), array('class'=>'btn btn-danger'), sprintf(__('Seguro que querés borrar # %s?'), $m['Mercaderia']['name'])); ?>

<?php        if($cantidad_duplicados >= 2) { 
        //Si esta variable llega a 2 o más, quiere decir que se encontro en dos o más indices dicho nombre de mercadería.

		    echo $this->Html->link('Ver duplicados', 
		    array('action'=>'verDuplicados',
		    $m['Mercaderia']['id'],
		    $m['Mercaderia']['name']), 
		    array('class'=>'btn btn-primary')); 

		  }
?>

</div>
<br><br>
<p>Default Proveedor: <?php echo $m['Proveedor']['name']; ?> </p>
<?php } //End foreach ?>

<table class="table">
<tr>
<th>Proveedores vinculados</th>
<th>Rubros vinculados</th>
<th></th>
</tr>
</table>

</div>