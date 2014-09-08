<table class="table">
<tr>
	<th><?php echo $this->Paginator->sort( 'numero', Configure::read('Mesa.tituloMesa'));?></th>
	<th><?php echo $this->Paginator->sort('mozo_id', __('Nº de %s', Configure::read('Mesa.tituloMozo') ));?></th>
	<th><?php echo $this->Paginator->sort('total');?></th>
        <th>Descuento</th>
        <th><?php echo $this->Paginator->sort('cant_comensales', Inflector::pluralize(Configure::read('Mesa.tituloCubierto')) );?></th>
	<th>
        <?php echo $this->Paginator->sort('created', 'Fecha Abrió');?><br />
        </th>
        <th>
        <?php echo $this->Paginator->sort('time_cerro', 'Fecha Cerró');?><br />
        </th>
        <th>
        <?php echo $this->Paginator->sort('time_cobro', 'Fecha Cobró');?><br />
        </th>
	<th>Factura</th>
        <th><?php echo $this->Paginator->sort('Cliente.nombre', Configure::read('Mesa.tituloCliente'));?></th>


	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($mesas as $mozo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
		<strong><?php echo $mozo['Mesa']['numero']; ?><strong>
		</td>
		<td>
			<?php echo $this->Html->link('N° '.$mozo['Mozo']['numero'],'/Mozos/view/'.$mozo['Mesa']['mozo_id']); ?>
		</td>
		<td>
			<?php echo $mozo['Mesa']['total']; ?>
		</td>
                <td>
			<?php
			if(!empty($mozo['Cliente']['Descuento']['porcentaje'])){
			 	echo $mozo['Cliente']['Descuento']['porcentaje']."%"; }
			 else{
			 	echo '0%';
			 }
                             ?>
		</td>
                <td>
			<?php echo $mozo['Mesa']['cant_comensales'] ?>
		</td>
		<td>
			<?php
                        if ( $mozo['Mesa']['created'] != '0000-00-00 00:00:00'){
                            echo date('d-m-y (H:i)',strtotime($mozo['Mesa']['created']));
                        } else {
                            echo "Sin Abrir";
                        }
                        ?>
		</td>
                <td>
                    <?php
                        if ( $mozo['Mesa']['time_cerro'] != '0000-00-00 00:00:00'){
                            echo date('d-m-y (H:i)',strtotime($mozo['Mesa']['time_cerro']));
                        } else {
                            echo "Abierta";
                        }
                    ?>
		</td>
                <td>
                    <?php
                        if ( $mozo['Mesa']['time_cobro'] != '0000-00-00 00:00:00'){
                            echo date('d-m-y (H:i)',strtotime($mozo['Mesa']['time_cobro']));
                        } else {
                            echo "Sin Cobrar";
                        }
                    ?>
		</td>
		<td align="center">
			<?php 
			if(!empty($mozo['Cliente']['Descuento']['porcentaje'])){
			 	echo 'remito'; }
			 elseif($mozo['Cliente']['tipofactura']) {
			 	echo ' "'.$mozo['Cliente']['tipofactura'].'"';
			 }
			 else echo ' "B"'?>
		</td>
                <td>
			<?php
			if(!empty($mozo['Cliente'])){
                            echo $mozo['Cliente']['nombre'];
                        }
                        ?>
		</td>

		<td class="actions">
			<?php if($mozo['Mesa']['time_cerro'] != '0000-00-00 00:00:00'){
                                echo $this->Html->link(__('Reabrir', true), array('action'=>'reabrir', $mozo['Mesa']['id'])); 
                                echo ('</br>');
                        }?>
			
                        <?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $mozo['Mesa']['id'])); ?>
			</br>
                        <?php echo $this->Html->link(__('Borrar', true)
                        						, array('action'=>'delete', $mozo['Mesa']['id'])
                        						, null
                        						, sprintf(__('¿Esta seguro que quiere borrar la %s nº %s?\nSi se elimina se perderán los pedidos y no sera computada en las estadísticas.', true), Configure::read('Mesa.tituloMesa'), $mozo['Mesa']['numero'])); ?>
                        </br>
                        <?php echo $this->Html->link(__('Imprimir Ticket', true), array('action'=>'imprimirTicket', $mozo['Mesa']['id']), null, sprintf(__('¿Desea imprimir el ticket nº %s?', true), $mozo['Mesa']['numero'])); ?>
		</td>
	</tr>
<?php endforeach; ?>      
</table>