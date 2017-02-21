<?php echo $this->element('Risto.layout_modal_edit', array('title'=>'Mercaderia'));

 $indice = 0;

?>
<div class="content-white">
<h1>Mercaderias</h1>

<?php echo $this->Html->link('Agregar Mercadería', array('action'=>'add'), array('class'=>'btn btn-success pull-right btn-add')); ?>

<br><br>

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

		    <?php echo $this->Html->link('Ver', array('action'=>'view', $m['Mercaderia']['id'], $m['Mercaderia']['name']), array('class'=>'btn btn-default'));?>

			<?php echo $this->Html->link('Editar', array('action'=>'edit', $m['Mercaderia']['id']), array('class'=>'btn btn-default btn-edit'));?>

            <?php echo $this->Html->link(__('Borrar'), array('action'=>'delete',  $m['Mercaderia']['id']), array('class'=>'btn btn-danger'), sprintf(__('Seguro que querés borrar # %s?'), $m['Mercaderia']['name'])); ?>

 <?php
     if( count($mercaDuplicadosList[$indice]) > 0) { 
          if ( count($mercaDuplicadosList[$indice]) > 1) {
               $txt = 'Existen %s duplicados';
          } else {
               $txt = 'Existe %s duplicado';
          } 
	    echo $this->Html->link(
               __($txt, count($mercaDuplicadosList[$indice]) ), 
	          array(
                    'action'=>'ver_duplicados',
	               $m['Mercaderia']['id'],
               ),
	          array('class'=>'btn btn-primary')
          );
    }
$indice = $indice + 1;
?>

		</td>

	</tr>
<?php } //end foreach ?>
</tbody>
</table>
<?php echo $this->element('Risto.pagination'); ?>
</div>