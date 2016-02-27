<h1>Mercaderias</h1>

<?php echo $this->Html->link('Agregar Mercadería', array('action'=>'add'), array('class'=>'btn btn-success pull-right')); ?>

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
<?php foreach($mercaderias as $m ) { ?>
	<tr>
		<td><?php echo $m['Mercaderia']['id']?></td>
		<td><?php echo $m['Mercaderia']['name']?></td>
		<td><?php echo $m['UnidadDeMedida']['name']?></td>
		<td><?php echo $m['Proveedor']['name']?></td>
		<td><?php echo $m['Rubro']['name']?></td>
		<td>
			<?php echo $this->Html->link('editar', array('action'=>'edit', $m['Mercaderia']['id']), array('class'=>'btn btn-default'));?>

            <?php echo $this->Html->link(__('Borrar'), array('action'=>'delete',  $m['Mercaderia']['id']), array('class'=>'btn btn-link'), sprintf(__('Seguro que querés borrar # %s?'), $m['Mercaderia']['name'])); ?>

		</td>
	</tr>
<?php } ?>
</tbody>
</table>

<?php echo $this->element('Users.pagination') ?>