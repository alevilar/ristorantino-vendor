<div class="reservas index">
<h2><?php __('Reservas');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Nueva Reserva', true), array('action' => 'add')); ?></li>
	</ul>
</div>

<table class="table">
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('nombre');?></th>
	<th><?php echo $this->Paginator->sort('personas');?></th>
        <th><?php echo $this->Paginator->sort('menores');?></th>
	<th><?php echo $this->Paginator->sort('mesa');?></th>
        <th><?php echo $this->Paginator->sort('pago');?></th>
        <th><?php echo $this->Paginator->sort('debe_pagar');?></th>
        <th>Saldo</th>
	<th><?php echo $this->Paginator->sort('evento');?></th>
	<th><?php echo $this->Paginator->sort('fecha');?></th>
        <th><?php echo $this->Paginator->sort('observaciones');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($reservas as $reserva):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $reserva['Reserva']['id']; ?>
		</td>
		<td>
			<?php echo $reserva['Reserva']['nombre']; ?>
		</td>
		<td>
			<?php echo $reserva['Reserva']['personas']; ?>
		</td>
                <td>
			<?php echo $reserva['Reserva']['menores']; ?>
		</td>
		<td>
			<?php echo $reserva['Reserva']['mesa']; ?>
		</td>
                
                <td>
			$<?php echo $reserva['Reserva']['pago']; ?>
		</td>
                <td>
			$<?php echo $reserva['Reserva']['debe_pagar']; ?>
		</td>
                <td>
			<?php 
                        if ( $reserva['Reserva']['debe_pagar'] - $reserva['Reserva']['pago'] > 0 ) {
                            echo "<span style='color: red'>Faltan $". ($reserva['Reserva']['debe_pagar'] - $reserva['Reserva']['pago']) ."</span>";
                        } else {
                            echo "<span style='color: green'>Listo</span>";
                        }
                        
                        
                        ?>
		</td>
                
		
		<td>
			<?php echo $reserva['Reserva']['evento']; ?>
		</td>
		<td>
			<?php echo $reserva['Reserva']['fecha']; ?>
		</td>
                <td>
			<?php echo $reserva['Reserva']['observaciones']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $reserva['Reserva']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $reserva['Reserva']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $reserva['Reserva']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $reserva['Reserva']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Nueva Reserva', true), array('action' => 'add')); ?></li>
	</ul>
</div>
