<?php $this->element("Risto.layout_modal_edit", array('title'=>Configure::read('Mesa.tituloMozo')));?>



<?php
$this->Paginator->options(array('url' => $this->passedArgs)); 
?>

<div class="mozos index">
	<div class="content-white">

		<?php echo $this->Html->link( __('Crear %s', Configure::read('Mesa.tituloMozo') ),
									array(
										'plugin' => 'mesa',
										'controller' => 'mozos',
										'action' => 'edit',
									),
									array(
										'class' => 'btn btn-success btn-lg pull-right btn-add'
									)
			);?>


		<h1><?php echo Inflector::pluralize( Configure::read('Mesa.tituloMozo') ); ?></h1>


		<?php if ( !empty($mozos)) { ?>

			<?php echo $this->element('Mesa.mozo_search_form');?>

			<table cellpadding="0" cellspacing="0" class="table">
			<tr>
			    <th><?php echo $this->Paginator->sort('activo');?></th>
				<th><?php echo $this->Paginator->sort('numero', 'Alias');?></th>
			    <th><?php echo $this->Paginator->sort('nombre');?></th>
			    <th><?php echo $this->Paginator->sort('appellido');?></th>
			    <th>Foto</th>
				<th class="actions"><?php echo __('Acciones');?></th>
			</tr>
			<?php
			$i = 0;
			foreach ($mozos as $mesa):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
				<tr<?php echo $class;?>>
						
					<td>
					<?php 

						$glymp = "glyphicon-eye-open";
						if ( !$mesa['Mozo']['activo'] ) {
							$glymp = "glyphicon-eye-close";
						}

						$spanClass = $mesa['Mozo']['activo'] ? "text-success" : "text-default";
				    	echo  '<span class="glyphicon '.$glymp.' mozo-puntito '.$spanClass.'" aria-hidden="true" style="font-size:18pt"></span>';
					?>
			        </td>
					<td>
						<?php echo $mesa['Mozo']['numero']; ?>
					</td>
			        <td>
			            <?php echo $mesa['Mozo']['nombre']; ?>
					</td>
					<td>
			            <?php echo $mesa['Mozo']['apellido']; ?>
					</td>
					<td>
			             <?php 
			             if (!empty($mesa['Mozo']['media_id']) ) {
			             	echo $this->Html->imageMedia( $mesa['Mozo']['media_id'], array('img-polaroid', 'style'=>'width: 68px')); 
						 } else {
						 	echo "&nbsp;";
						 }
			             	?>
					</td>
					<td class="actions">
						
			            <!-- Split button -->
						<div class="btn-group">
						  <?php echo $this->Html->link(__('Editar'), array('action'=>'edit', $mesa['Mozo']['id']), array(
						  			'class'=>'btn btn-default  btn-sm btn-edit',
						  			)); ?>

						  <button type="button" class="btn btn-default  btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <span class="caret"></span>
						    <span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu">


						  	<li class="">
						    	<?php 
						    	$linkActivo = array('plugin'=>'mesa','controller'=>'mozos','action'=>'edit_activo',$mesa['Mozo']['id'],  !$mesa['Mozo']['activo']);

								$linkName = 'Activar';
								if ( $mesa['Mozo']['activo'] ) {
									$linkName = 'Desactivar';
								}
								
						    	echo $this->Form->postLink( $linkName, $linkActivo, array(
						    		'data' => array('Mozo' => array(
						    				'activo' => !$mesa['Mozo']['activo']
						    			)),
						    		'class'=>' btn-sm')); 	
						    	?>
					    	</li>

						    <li class="">
						    	<?php echo $this->Form->postLink( __('Borrar'), array('action'=>'delete', $mesa['Mozo']['id']), array('class'=>' btn-sm'), __('¿Desea borrar el %s nº # %s?. Si lo borra perderá todo el historial y sus estadísticas.', Configure::read('Mesa.tituloMozo'), $mesa['Mozo']['numero']) ); ?>
					    	</li>
						  </ul>
						</div>

					</td>
				</tr>
			<?php endforeach; ?>
			</table>


			<p>
			<?php
			echo $this->Paginator->counter(array(
			    'format' => __('Página {:page} de {:pages}, mostrando {:current} elementos de {:count}')
			));
			?></p>
			<div class="paging">
				<?php echo $this->Paginator->prev('<< '.__('anterior'), array(), null, array('class'=>'btn btn-default'));?>
			 | 	<?php echo $this->Paginator->numbers();?>
				<?php echo $this->Paginator->next(__('próximo').' >>', array(), null, array('class'=>'btn btn-default'));?>
			</div>


		<?php }  else { // end if ?>

			<p class="alert alert-info center">
				Por favor, deberá crear <?php echo Inflector::pluralize(Configure::read('Mesa.tituloMozo'))?> 
			</p>
		<?php }?>
	</div>

</div>

