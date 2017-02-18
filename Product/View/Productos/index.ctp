<?php $this->element("Risto.layout_modal_edit", array('title'=>'Producto'));?>


<div class="productos index content-white">


	<?php    
	$this->append("script");
		echo $this->Html->script('/risto/js/jquery/jquery.jeditable.mini');
		echo $this->Html->script('/risto/js/ale_fieldupdates');
		?>
		<script type="text/javascript">
		    new Afups("<?php echo $this->Html->url(array('action'=>'update'))?>");
		</script>
		<?php
	$this->end();

	$img = $this->Html->image('/product/img/explicacion_producto_categoria_variantes.png', array('width'=>'100px', "class"=>"img-thumbnail"));

	$linkImg = $this->Html->link( $img, 
							'/product/img/explicacion_producto_categoria_variantes.png',
							array('target'=>'_blank', 'escape' => false, 'class'=>'pull-left')
						);
	?>


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

	<div class="btn-group pull-right">


	<?php
	    echo $this->Html->link(__('Crear Nuevo Producto'), 
	    					array(
	    						'plugin' => 'product',
	    						'controller' => 'productos',
	    						'action' => 'add'
	    					),
	    					array(
	    						'class'=>'btn btn-lg btn-success btn-add',
    						));

	    echo $this->Html->link('<span class="glyphicon glyphicon-usd"></span>Aplicar Precios Futuros'
	    	, array('action' => 'actualizarPreciosFuturos')
	    	, array('class' => 'btn btn-default btn-lg btn-precio-futuro', 'escape' => false )
	    	, 'Está por modificar todos los precios, por su valor futuro. ¿Seguro?');
	    ?>
	</div>
	<h2><?php echo __('Productos');?></h2>

	<br>

	<?php if ( !empty($msgSinProductos) ) { ?>
		<p class="alert alert-info center">
			<?php echo $msgSinProductos; ?>
		</p>


	<?php } else { ?>
	<p>
	    <?php
	//echo $this->Paginator->options(array('url'=>$this->params['PaginateConditions']));
	?>
	</p>
	<table class="productos table">
	        <tr>
		<?php 
		echo $this->Form->create("Producto", array('url'=>array('action' => 'index'))); 
		echo $this->Form->input("id") 
		?>
		<th><?php echo $this->Form->input('sin_stock',array(
			'placeholder'=>'Sin Stock', 
			'label'=>false, 
			'required'=>false, 
			'type'=>'select', 
			'empty' => 'Con o Sin Stock',
			'options'=> array(
				1 => "Sin Stock (no se muestra en menú)",
				0 => "Con Stock"
		)));?></th>
		<th><?php echo $this->Form->input('name',array('placeholder'=>'Interno', 'label'=>false, 'required'=>false));?></th>
		<th><?php echo $this->Form->input('abrev',array('placeholder'=>'Ticket', 'label'=>false, 'required'=>false));?></th>

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
		<th><?php echo $this->Form->input('precio',array('placeholder'=>'Precio','label'=>false, 'required'=>false, 'type' => 'number'));?></th>
		<th><?php echo $this->Form->input('precio_futuro',array('placeholder'=>'P. Futuro','label'=>false, 'required'=>false, 'type' => 'number'));?></th>
	    <th><?php echo $this->Form->input('order',array('placeholder'=>'Orden','label'=>false));?></th>
		<th colspan="2" class="actions"><?php echo $this->Form->submit('Buscar', array('class'=>'btn btn-primary'))?></th>

		<?php echo $this->Form->end()?>
	        </tr>

	<tr>
		<th><?php echo $this->Paginator->sort('sin_stock', 'Stock');?></th>
		<th><?php echo $this->Paginator->sort('name', 'Nombre Interno');?></th>
		<th><?php echo $this->Paginator->sort('abrev', 'Nombre Ticket');?></th>
		<th><?php echo $this->Paginator->sort('Printer.name', 'Printer');?></th>
		<th><?php echo $this->Paginator->sort('Categoria.name', 'Categoria');?></th>
		<th><?php echo $this->Paginator->sort('precio');?></th>
		<th><?php echo $this->Paginator->sort('ProductosPreciosFuturo.precio', 'Precio Futuro');?></th>
	    <th><?php echo $this->Paginator->sort('order', 'Orden');?></th>
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


	        <td class='edit' field='sin_stock' options_types='<?php echo json_encode($sinStocks) ?>' product_id='<?php echo $prodId ?>'>
	        	<?php 
	        		if ( $producto['Producto']['sin_stock']) {
	        			echo "<span class='grey'>Sin Stock</span>";
	        		} else {
	        			echo "✔";
	        		}
        		?>
	        </td>


			<td class='edit' field='name' product_id='<?php echo $prodId ?>'><?php echo $name; ?></td>
				
	                
	        <td class='edit abrev' field='abrev' product_id='<?php echo $prodId ?>'><?php echo $abrev; ?></td>

			<td class="edit_field_types" options_types='<?php echo json_encode($printers) ?>' field="printer_id" product_id="<?php echo $prodId; ?>"><?php
				echo $producto['Printer']['name'];
			?></td>


			<td class="edit_field_types" options_types='<?php print json_encode($categorias) ?>' field="categoria_id" product_id="<?php echo $prodId; ?>"><?php echo $producto['Categoria']['name']; ?></td>


			<td  class='edit' field='precio' product_id='<?php echo $prodId ?>'><?php 
	                        echo $this->Number->currency( $producto['Producto']['precio'] );                        
	                ?></td>
	                
	                
	                <td  class='edit text text-success'  field='precio_futuro' 
	                     product_id='<?php echo $prodId ?>'><?php 
	                        if ( isset($producto['ProductosPreciosFuturo']['precio']) ) {
	                          echo $this->Number->currency( $producto['ProductosPreciosFuturo']['precio']);
	                        }
	                ?></td>
	                
	                <td  class='edit' field='order' product_id='<?php echo $prodId ?>'><?php 
	                    echo $producto['Producto']['order']; 
	                ?></td>
			<td class="actions" style="min-width: 112px;">
				<!-- Split button -->
				<div class="btn-group">
				  <?php echo $this->Html->link(__('Editar'), array('action'=>'edit', $producto['Producto']['id']), array('class'=>'btn btn-default  btn-sm btn-edit')); ?>

				  <button type="button" class="btn btn-default  btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    <span class="caret"></span>
				    <span class="sr-only">Toggle Dropdown</span>
				  </button>
				  <ul class="dropdown-menu">
				    <li class="">
				    	<?php echo $this->Form->postLink( __('Borrar'), array('action'=>'delete', $producto['Producto']['id']), array('class'=>' btn-sm'), __('¿Esta seguro que desea borrar el producto: %s?', $producto['Producto']['name']) ); ?>
			    	</li>
				  </ul>
				</div>
				
			</td>
		</tr>
	<?php
	endforeach; 

	}else{
	    echo('<td>No se encontraron elementos</td>');
	}
	    
	?>
	       
	</table>


		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de  {:count} registros totales, iniciando en el registro {:start}, y terminando en el registro {:end}')
		));
		?>
		</p>

<?php echo $this->element('Risto.pagination'); ?>

	<div class="clearfix"></div><br><br>

	<p class="alert alert-info">
	<?php echo $linkImg?>
	 En esta imagen podrás ver el Menú de un restaurante y entender lo que es un Producto, una Categoria y una Variante. <br> <br>
	</p>

	<?php } // end if si no hay productos?>

</div>

