<table class="table table-condensed">
<tr>
	<th><?php echo $this->Paginator->sort( 'numero', Configure::read('Mesa.tituloMesa'));?></th>
	<th><?php echo $this->Paginator->sort('mozo_id', Configure::read('Mesa.tituloMozo'));?></th>
	<th><?php echo $this->Paginator->sort('subtotal');?></th>
	<th><?php echo $this->Paginator->sort('total');?></th>
        <th>Descuento</th>
        
        <?php if ( Configure::read('Adicion.cantidadCubiertosObligatorio') ) { ?>
        <th><?php echo $this->Paginator->sort('cant_comensales', Inflector::pluralize(Configure::read('Mesa.tituloCubierto')) );?></th>		
        <?php } ?>
        <th>
        <?php echo $this->Paginator->sort('estado_id', 'Estado');?><br />
        </th>        
		<th>Factura</th>
        <th><?php echo $this->Paginator->sort('Cliente.nombre', Configure::read('Mesa.tituloCliente'));?></th>
		<th>Pago</th>
		<th><?php echo $this->Paginator->sort('checkin');?></th>
		<th><?php echo $this->Paginator->sort('checkout');?></th>
		<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php

 if (!isset($arqueoId) ) {
 	$arqueoId = null;
 }

$i = 0;
foreach ($mesas as $mozo):
	$class = "";
	if ( $mozo['Mesa']['deleted'] ) {
		$class = ' class="danger"';		
	}
?>
	<tr<?php echo $class;?>>
		<td>
		<strong><?php echo $mozo['Mesa']['numero']; ?><strong>
		</td>
		<td>
			<?php echo $this->Html->link( $mozo['Mozo']['numero'], array('plugin'=>'mesa', 'controller'=>'mozos', 'action'=>'view', $mozo['Mesa']['mozo_id'])); ?>
		</td>
		<td>
			<?php echo $this->Number->currency( $mozo['Mesa']['subtotal']); ?>
		</td>
		<td>
			<?php echo $this->Number->currency( $mozo['Mesa']['total']); ?>
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

		<?php if ( Configure::read('Adicion.cantidadCubiertosObligatorio') ) { ?>
    	<td>
			<?php echo $mozo['Mesa']['cant_comensales'] ?>
		</td>
		<?php } ?>


		<td>
			<?php 
			$estadoName = $mozo['Estado']['name'];

			if ($mozo['Mesa']['deleted']) {
				$estadoName = __("Borrada");				
			}
			echo $estadoName;
			?>
		</td>
		<td align="center">
			<?php 
			if(!empty($mozo['Cliente']) && !empty($mozo['Cliente']['IvaResponsabilidad']) && !empty($mozo['Cliente']['IvaResponsabilidad']['TipoFactura'])){
			 	echo $mozo['Cliente']['IvaResponsabilidad']['TipoFactura']['name']; 
			 }
			else {
			 echo ' '.Configure::read('Restaurante.tipofactura_name');
			}
			?>
		</td>
        <td>
			<?php
			if(!empty($mozo['Cliente'])){
                            echo $mozo['Cliente']['nombre'];
                        }
                        ?>
		</td>

		<td>
			<?php
			foreach ($mozo['Pago']as $p) {
				echo $this->Number->currency( ($p['valor']) );
			}
            ?>
		</td>


		<td>
			<?php echo $this->Time->niceShort($mozo['Mesa']['checkin']);?>
		</td>



		<td>
			<?php echo $this->Time->niceShort($mozo['Mesa']['checkout']); ?>
		</td>


		<td class="actions">
		<?php 
		$actionsBtnClass = "";
		if ( $mozo['Mesa']['deleted'] ) { 
			$actionsBtnClass = "disabled";
		}

		?>
			<!-- Split button -->
			<div class="btn-group">
			  <button type="button" class="btn btn-default <?php echo $actionsBtnClass?>"><?php echo $this->Html->link(__('Editar'), array('plugin' => 'mesa', 'controller' => 'mesas', 'action'=>'edit', $mozo['Mesa']['id'], $arqueoId), array('class'=>'btn-edit')); ?></button>
			  <button type="button" class="btn btn-default dropdown-toggle <?php echo $actionsBtnClass?>" data-toggle="dropdown">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			  </button>

			  <ul class="dropdown-menu" role="menu">
			  	<?php if( !empty($mozo['Mesa']['time_cerro'])){
			  		?> <li><?php echo $this->Html->link(__('Reabrir'), array('action'=>'reabrir', $mozo['Mesa']['id']));  ?></li>                                
                 <?php } ?>

			    <li><?php echo $this->Html->link(__('Imprimir Ticket'), array('plugin' => 'mesa', 'controller' => 'mesas', 'action'=>'imprimirTicket', $mozo['Mesa']['id']), null, sprintf(__('¿Desea imprimir el ticket nº %s?', true), $mozo['Mesa']['numero'])); ?>
			    </li>
			    
			    <li class="divider"></li>
			    
			    <li> <?php echo $this->Html->link(__('Borrar')
                        						, array('plugin' => 'mesa', 'controller' => 'mesas', 'action'=>'delete', $mozo['Mesa']['id'], $arqueoId)
                        						, null
                        						, __('¿Esta seguro que quiere borrar la %s nº %s?\nSi se elimina se perderán los pedidos y no sera computada en las estadísticas.', Configure::read('Mesa.tituloMesa'), $mozo['Mesa']['numero'])
                        						); ?>
				</li>
			    
			  </ul>
			</div>
			</br>
                        </br>           
		</td>
	</tr>
<?php endforeach; ?>      
</table>