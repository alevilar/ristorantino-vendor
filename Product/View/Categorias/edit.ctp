<?php
     if (empty($this->request->data['Categoria']['id'])):?>
        <h2><?php echo __d('users', 'Agregar Categoria'); ?></h2>
<?php else: ?>
        <h2><?php echo __d('users', 'Editar Categoria'); ?></h2>
<?php endif; ?>


        <?php    
        
        if ( !empty($this->request->data['Media']) && !empty($this->request->data['Media']['id'] )) {
        	echo $this->Html->imageData( $this->request->data['Media'], array('width'=>100));	
        }
        ?>

<div class="categorias form">
<?php echo $this->Form->create('Categoria', array('type' => 'file'));?>
	<div class="col-md-6">

                
	<?php
            if (!empty($this->request->data['Categoria']['id'])){
		echo $this->Form->input('id');
            }
		echo $this->Form->input('parent_id',array('type'=>'select', 'options'=> $categorias, 'default'=>1,'label'=>'Categoria Padre'));
		echo $this->Form->input('name',array('label'=>'Nombre'));
                
    ?>
    <br><br>
     <?php
    if (empty($this->request->data['Categoria']['id'])):?>
     <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg btn-block')); ?>
     <?php else: ?>
     <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg btn-block')); ?>
    <?php endif; ?>


    </div>
    
    <div class="col-md-6">
<?php
        echo $this->Form->input('media_file',array('label'=>'Foto/Imagen', 'type'=>'file'));
		echo $this->Form->input('description',array('label'=>'Descripción'));
        ?>
    </div>
   
     <?php echo $this->Form->end() ?>

</fieldset>
</div>