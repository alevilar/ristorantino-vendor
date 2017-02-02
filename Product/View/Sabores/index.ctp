<?php $this->element("Risto.layout_modal_edit", array('title'=>'Variante'));?>


<div class="sabores index content-white">
	<div class="btn-group pull-right">
	<?php echo $this->Html->link(__('Crear Variante'), array('action'=>'add'), array('class'=>'btn btn-success btn-lg btn-add')); ?>
	</div>

	
	<h2><?php echo __('Variantes del Producto');?></h2>
	
	<table class="table">

	    <tr>
		<?php echo $this->Form->create('Sabor');?>
	    <th><?php echo $this->Form->input('Sabor.name',array('placeholder'=>'Nombre', 'label'=>false, 'required' => 0));?></th>
		<th><?php echo $this->Form->input('categoria_id',array(
						'empty' => 'Seleccionar',
						'required'=>false,
						'placeholder'=>'Categoria',
						'label'=>false));?></th>
		<th><?php echo $this->Form->input('Sabor.precio',array('placeholder'=>'Precio', 'label'=>false));?></th>
		<th></th>
		<th><?php echo $this->Form->submit('Buscar', array('class'=>'btn btn-primary'));
	              echo $this->Form->end();?></th>
	    </tr>
	    
	<tr>
		
		<th><?php echo $this->Paginator->sort('name',__('Nombre'));?></th>
		<th><?php echo $this->Paginator->sort('Categoria.name',__('Categoria'));?></th>
		<th><?php echo $this->Paginator->sort('precio',__('Precio'));?></th>
		<th><?php echo $this->Paginator->sort('created',__('Creado'));?></th>
		<th class="actions"><?php echo __('Acciones');?></th>
	</tr>
	<?php
	if ($this->Paginator->params['paging']['Sabor']['count']!=0) {
	$i = 0;
	foreach ($sabores as $sabor):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
		<tr<?php echo $class;?>>
			<td>
				<?php
	                        $name = ($sabor['Sabor']['deleted'])? 
	                            $sabor['Sabor']['name']." (borrado el ".date("d/m/y H:i:s", strtotime($sabor['Sabor']['deleted_date']))." )"
	                            :
	                            $sabor['Sabor']['name'];

	                        echo $name; ?>
			</td>
			<td>
				<?php echo $sabor['Categoria']['name']; ?>
			</td>
			<td>
				<?php echo "$".$sabor['Sabor']['precio']; ?>
			</td>
			<td>
				<?php echo date('d-m-y H:i:s',strtotime($sabor['Sabor']['created'])); ?>
			</td>
			<td class="actions">
				<!-- Split button -->
				<div class="btn-group">
				  <?php echo $this->Html->link(__('Editar'), array('action'=>'edit', $sabor['Sabor']['id']), array('class'=>'btn btn-default  btn-sm btn-edit')); ?>

				  <button type="button" class="btn btn-default  btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    <span class="caret"></span>
				    <span class="sr-only">Toggle Dropdown</span>
				  </button>
				  <ul class="dropdown-menu">
				    <li class="">
				    	<?php echo $this->Form->postLink( __('Borrar'), array('action'=>'delete', $sabor['Sabor']['id']), array('class'=>' btn-sm'), __('¿Esta seguro que desea borrar el producto: %s?', $sabor['Sabor']['name']) ); ?>
			    	</li>
				  </ul>
				</div>

				
			</td>
		</tr>
	<?php endforeach; 

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
</div>

