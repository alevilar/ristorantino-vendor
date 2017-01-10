<table class="table">

<?php echo $this->Form->create("Pago", array('method'=>'get')); ?>

<?php if (!isset($mostrarBuscador) || $mostrarBuscador ) { ?>
	<thead>
	<tr>
		<th>&nbsp;</th>
	    <th><strong>
	           <?php echo __('Buscar')?>
	        </strong>
	       <?php echo $this->Form->input('mozo_id', array('placeholder' => __('N° %s', Configure::read('Mesa.tituloMozo')), 'label' => false, 'empty' => 'Seleccione')); ?></th>
		<th><?php echo $this->Form->input('mesa_numero', array('placeholder' => __('N° %s', Configure::read('Mesa.tituloMesa')), 'label' => false)); ?></th>
		<th><?php echo $this->Form->input('Pago.tipo_de_pago_id', array('placeholder' => 'Tipo de Pago', 'label' => false, 'empty' => 'Seleccione')); ?></th>
		<th>
	            <?php echo $this->Form->input('Pago.valor', array('placeholder' => 'Valor', 'label' => false)); ?>
	        </th>
	        <th>
	            <?php
	            echo $this->Form->input('Pago.created_from', array(
	                'placeholder' => 'Desde',
	                'label' => false,
	                'class' => 'datetimepicker form-control',
	                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
	            ));
	            ?>
	            <?php
	            echo $this->Form->input('Pago.created_to', array(
	                'placeholder' => 'Hasta',
	                'label' => false,
	                'class' => 'datetimepicker form-control',
	                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
	            ));
	            ?>
	        </th>
		<th class="actions"><?php echo $this->Form->submit('Buscar', array('class' => 'btn btn-primary', 'title' => __('Buscar')));
	                        echo $this->Form->end();?></th>
	</tr>
	</thead>
<?php } ?>


<thead>
<tr>
	<th><?php echo $this->Paginator->sort('id',__('Id'));?></th>
        <th><?php echo Configure::read('Mesa.tituloMozo',__('Mozo')) ?></th>
	<th><?php echo $this->Paginator->sort('Mesa.numero',__('Mesa'));?></th>
	<th><?php echo $this->Paginator->sort('TipoDePago.nombre',__('Tipo de Pago'));?></th>
	<th><?php echo $this->Paginator->sort('valor',__('Valor'));?></th>
        <th><?php echo $this->Paginator->sort('created',__('Creado'));?></th>
	<th class="actions">&nbsp;</th>
</tr>
</thead>
<?php if ($pagos) { ?>
<tbody>
<?php
$i = 0;

foreach ($pagos as $pago):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td class="text-center">
			<?php echo $pago['Pago']['id']; ?>
		</td>
        <td class="text-center">
			<?php echo $pago['Mesa']['Mozo']['numero']; ?>
		</td>
		<td class="text-center">
			<?php echo $this->Html->link($pago['Mesa']['numero'], array('plugin'=>'mesa', 'controller'=>'mesas', 'action'=>'edit', $pago['Mesa']['id'] )); ?>
		</td>
        <td class="text-center">
			<?php echo $this->Html->imageMedia($pago['TipoDePago']['media_id'], array('height'=> '45', 'title'=>$pago['TipoDePago']['name'], 'alt'=>$pago['TipoDePago']['name'])); ?>
		</td>
        <td class="text-right">
			<?php echo $this->Number->currency($pago['Pago']['valor']); ?>
		</td>
        <td class="text-center">
			<?php echo $this->Time->format($pago['Pago']['created'], '%a %e de %B %H:%M'); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar'), array('action'=>'edit', $pago['Pago']['id']), array('class'=>'btn-edit')); ?>
			<?php echo $this->Html->link(__('Eliminar'), array('action'=>'delete', $pago['Pago']['id']), array('class'=>'text-danger'), __('Are you sure you want to delete # %s?', $pago['Pago']['id'])); ?>
		</td>
	</tr>
<?php
 endforeach;
}else{
    echo('<td colspan="7" class=" center"><span class="text-info">No se encontraron elementos</span></td>');
}

?>
        </tbody>
</table>