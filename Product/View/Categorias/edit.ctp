

<div class="categorias form content-white">
    <div class="row">

    <?php
         if (empty($this->request->data['Categoria']['id'])):?>
            <h2 class="center"><?php echo __d('users', 'Agregar Categoria'); ?></h2>
    <?php else: ?>
            <h2 class="center"><?php echo __d('users', 'Editando a "%s"', $this->request->data['Categoria']['name']); ?></h2>
    <?php endif; ?>

    <br>

    <?php    
        if ( !empty($this->request->data['Media']) && !empty($this->request->data['Media']['id'] )) {
    ?>
    <div class="col-sm-2">
        <?php
            echo $this->Html->imageMedia( $this->request->data['Media'], array('width'=>200, 'class'=>'img-thumbnail img-responsive'));   
        ?>
    </div>
    <?php } ?>

    <?php echo $this->Form->create('Categoria', array('type' => 'file'));?>
    	<div class="col-sm-5">

    	<?php
        if (!empty($this->request->data['Categoria']['id'])) {
    		echo $this->Form->input('id');
        }

		echo $this->Form->input('parent_id',array('type'=>'select', 'options'=> $categorias, 'default'=>1,'label'=>'Categoria Padre'));

        		
    	echo $this->Form->input('description',array('label'=>'Descripción'));
                    
        ?>
        <br><br>
         


        </div>
        
        <div class="col-sm-5">
            <?php
            echo $this->Form->input('name',array('label'=>'Nombre'));
            echo $this->Form->input('media_file',array('label'=>'Foto/Imagen', 'type'=>'file'));
            ?>

            <?php
            
            // submit

            if (empty($this->request->data['Categoria']['id'])):?>
             <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success btn-lg btn-block')); ?>
             <?php else: ?>
             <?php echo $this->Form->submit('Actualizar', array('class'=>'btn btn-success btn-lg btn-block')); ?>
            <?php endif; ?>


        </div>
       
         <?php echo $this->Form->end() ?>

    </div>
</div>