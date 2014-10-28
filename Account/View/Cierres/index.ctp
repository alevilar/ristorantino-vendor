<div class="tipoDocumento index">
<?php
echo $this->Html->link(' <span class="glyphicon glyphicon-download"></span> '.__('Descargar Excel')
    , array(
        'action'=> $this->action, 'ext'=> 'xls'
        )
    , array(
        'escape' => false,
        'data-ajax' => 'false',
        'class' => 'btn btn-primary pull-right',
        'div'=> array(
            'class' => 'pull-right'
            )
    ));
?>

    <h2><?php echo __('Listado de Cierres'); ?></h2>

<table class="table">
<tr>

	<th><?php echo $this->Paginator->sort('id','Código');?></th>
	<th><?php echo $this->Paginator->sort('name','Fecha');?></th>
	<th><?php echo $this->Paginator->sort('name','Nombre');?></th>
	<th><?php echo $this->Paginator->sort('Listado de Gastos Cerrados');?></th>
	<th class="actions"><?php echo __('Acciones');?></th>
</tr>
<?php
if ($this->Paginator->params['paging']['Cierre']['count']!=0) {
$i = 0;
foreach ($cierres as $c):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php
                echo $c['Cierre']['id']; ?>
		</td>
		<td>
			<?php echo  date('d-m-Y H:i', strtotime($c['Cierre']['created'])) ; ?>
		</td>
		<td>
			<?php echo $c['Cierre']['name']; ?>
		</td>
		<td>
           <table class="table table-condensed">
              <thead>
                  <tr>
                     <th>Fecha</th>
                     <th>Factura</th>
                     <th>Proveedor</th>
                     <th>Neto</th>
                     <th>Total</th>
                     <th>Obs.</th>
                  </tr>
              </thead>
              <tbody>
               <?php
                $proveedor = '';
                $tipoFactura = '';
                $monto_neto_total= 0;
                $monto_importe_total= 0;
                foreach ( $c['Gasto'] as $gasto ){
                $monto_neto_total= $monto_neto_total + $gasto['importe_neto'];
                $monto_importe_total= $monto_importe_total + $gasto['importe_total'];
                         if ( !empty($gasto['Proveedor']) ) {
                           $proveedor = $gasto['Proveedor']['name'] . ', ';
                                                             }
                         if ( !empty($gasto['TipoFactura']) ) {
                            $tipoFactura = $gasto['TipoFactura']['name'];
                                                               }
                         ?>
                         <tr>
                           <td><?php echo date('d-m-Y', strtotime($gasto['fecha'])) ?></td>
                           <td><?php echo $tipoFactura ?> <?php echo $gasto['factura_nro'] ?></td>
                           <td><?php echo $proveedor ?></td>
                           <td><?php echo $gasto['importe_neto'] ?></td>
                           <td><?php echo $gasto['importe_total'] ?></td>
                           <td><?php echo $gasto['observacion'] ?></td>
                         </tr>
                  <?php
                     }
                  ?>
                  <tr>
                    <td colspan="3"><strong>Total de Cierre: </strong></td>
                    <td><strong><?php echo $monto_neto_total;?>.00</strong></td>
                    <td><strong><?php echo $monto_importe_total;?>.00</strong></td>
                    <td></td>
                  </tr>

             </table>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action'=>'edit', $c['Cierre']['id']), array('class'=>'btn btn-default')); ?>
		</td>
	</tr>
<?php endforeach;

}else{
    echo('<td>No se encontraron elementos</td>');
}
?>


</table>
</div>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de  {:count} registros totales, iniciando en el registro {:start}, y terminando en el registro {:end}')
	));
	?>
	</p>

<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('anterior'), array(), null, array('class'=>'btn btn-default'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('siguiente').' >>', array(), null, array('class'=>'btn btn-default'));?>
</div>