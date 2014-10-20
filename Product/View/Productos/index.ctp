<?php    

echo $this->Html->script('/risto/js/jquery/jquery.jeditable.mini', array('inline'=>false));
echo $this->Html->script('/risto/js/ale_fieldupdates', array('inline'=>false));


?>


<script type="text/javascript">
    new Afups("<?php echo $this->Html->url(array('action'=>'update'))?>");
</script>

<style type="text/css">
	.abrev{
		font-size: 8pt;
		opacity: 0.9;
		font-weight: bolder;
	}
	.edit input[type="text"]{
		text-align: left;
	}
</style>


<div class="productos index">

<div class="users index">
<div class="btn-group pull-right">
<?php
    echo $this->Html->link(__('Nuevo Producto'), array('action'=>'add'), array('class'=>'btn btn-lg btn-success pull-right'));


    echo $this->Html->link('<span class="glyphicon glyphicon-usd"></span>   Aplicar Precios Futuros'
    	, array('action' => 'actualizarPreciosFuturos')
    	, array('class' => 'btn btn-warning btn-lg', 'escape' => false )
    	, 'Está por modificar todos los precios, por su valor futuro. ¿Seguro?');
    ?>
</div>
<h2><?php echo __('Productos');?></h2>

<br>
<p>
    <?php
//echo $this->Paginator->options(array('url'=>$this->params['PaginateConditions']));
?>
</p>
<table class="productos table">
        <tr>
	<?php 
	echo $this->Form->create("Producto",array("action"=>"index")); 
	echo $this->Form->input("id") 
	?>
	<th><?php echo $this->Form->input('name',array('placeholder'=>'Nombre del producto', 'label'=>false, 'required'=>false));?></th>
	<th><?php echo $this->Form->input('abrev',array('placeholder'=>'Abreviatura', 'label'=>false, 'required'=>false));?></th>

        <th><?php echo $this->Form->input('printer_id',array(
        					'placeholder'=>'Printer',
        					'required'=>false,
        					'label'=>false, 
        					'empty'=>'Selecionar'
        					));?></th>
	<th>
		<?php echo $this->Form->input('categoria_id',array(
					'empty' => 'Seleccionar',
					'required'=>false,
					'placeholder'=>'Categoria',
					'label'=>false));?></th>
	<th><?php echo $this->Form->input('precio',array('placeholder'=>'Precio','label'=>false, 'required'=>false));?></th>
	<th><?php echo $this->Form->input('precio_futuro',array('placeholder'=>'P. Futuro','label'=>false, 'required'=>false));?></th>
    <th><?php echo $this->Form->input('order',array('placeholder'=>'Orden','label'=>false, 'style'=>'width:40px'));?></th>
	<th colspan="2" class="actions"><?php echo $this->Form->submit('Buscar', array('class'=>'btn btn-primary'))?></th>

	<?php echo $this->Form->end()?>
        </tr>

<tr>
	<th><?php echo $this->Paginator->sort('name', 'Nombre');?></th>
	<th><?php echo $this->Paginator->sort('abrev', 'Ticket');?></th>
	<th><?php echo $this->Paginator->sort('Printer.name', 'Printer');?></th>
	<th><?php echo $this->Paginator->sort('Categoria.name', 'Categoria');?></th>
	<th><?php echo $this->Paginator->sort('precio');?></th>
	<th><?php echo $this->Paginator->sort('ProductosPreciosFuturo.precio', 'Precio Futuro');?></th>
    <th><?php echo $this->Paginator->sort('order', 'Orden');?></th>
	<th><?php echo $this->Paginator->sort('created', 'Creado');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php

if ($this->Paginator->params['paging']['Producto']['count']!=0) {
$i = 0;
foreach ($productos as $producto):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
        $prodId = $producto['Producto']['id'];
?>
	<tr<?php echo $class;?>>
		<?php 
        $name = ($producto['Producto']['deleted'])? 
            $producto['Producto']['name']." (borrado el ".date("d/m/y H:i:s", strtotime($producto['Producto']['deleted_date']))." )"
            :
            $producto['Producto']['name'];

        $name =  trim($name);
        $abrev =  trim($producto['Producto']['abrev']);
        ?>


		<td class='edit' field='name' product_id='<?php echo $prodId ?>'><?php echo $name; ?></td>
			
                
        <td class='edit abrev' field='abrev' product_id='<?php echo $prodId ?>'><?php echo $abrev; ?></td>

		<td class="edit_field_types" options_types='<?php print json_encode($printers) ?>' field="printer_id" product_id="<?php echo $prodId; ?>"><?php 
			echo $producto['Printer']['name']; 
		?></td>


		<td class="edit_field_types" options_types='<?php print json_encode($categorias) ?>' field="categoria_id" product_id="<?php echo $prodId; ?>"><?php echo $producto['Categoria']['name']; ?></td>


		<td  class='edit' field='precio' product_id='<?php echo $prodId ?>'><?php 
                        echo $this->Number->currency( $producto['Producto']['precio'] );                        
                ?></td>
                
                
                <td  class='edit text text-success'  field='precio_futuro' 
                     product_id='<?php echo $prodId ?>'><?php 
                        if ( isset($producto['ProductosPreciosFuturo']['precio']) ) {
                          echo $this->Number->currency( $producto['ProductosPreciosFuturo']['precio'] );
                        }
                ?></td>
                
                <td  class='edit' field='order' product_id='<?php echo $prodId ?>'><?php 
                    echo $producto['Producto']['order']; 
                ?></td>
		<td>
			<?php echo date('d D, M Y',strtotime($producto['Producto']['created'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action'=>'edit', $producto['Producto']['id']), array('class'=>'btn btn-default')); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $producto['Producto']['id']), array('class'=>'btn btn-default'), null, sprintf(__('¿Esta seguro que desea borrar el producto: %s?', true), $producto['Producto']['name'])); ?>
		</td>
	</tr>
<?php
endforeach; 

}else{
    echo('<td>No se encontraron elementos</td>');
}
    
?>
       
</table>


</div>
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
