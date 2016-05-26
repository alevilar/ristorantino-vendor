
<div class="categorias index content-white">
    <?php echo $this->Html->link(__('Crear %s', __('Categoria')), array('admin'=>true,'plugin'>'productos', 'controller'=> 'categorias', 'action'=>'edit'), array('class'=>'btn btn-success btn-lg pull-right')); ?>


    <h2><?php echo __('Categorias');?></h2>
    

    <?php echo $this->Html->link('Reordenar Alfabeticamente',array('action'=>'reordenar'), array('class'=>'btn btn-sm btn-warning'));?>

    <br>


    <table class="table">
        <th><?php echo __('#ID'); ?></th>
        <th><?php echo __('Imagen'); ?></th>
        <th><?php echo __('Nombre'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
        <?php
        foreach($categorias as $catId => $catName){
        ?>
        <tr>
            <td><?php echo "#$catId";?></td>
            <td>
                <?php

                if( !empty($imagenes[$catId])) {
                        echo $this->Html->imageMedia( $imagenes[$catId],array('height'=>'64px;'));
                }
                ?>
            </td>
            <td><?php echo "$catName";?></td>
            <td class="actions" align="left">
                <?php echo $this->Html->link(__('Editar'), array('action'=>'edit', $catId), array('class'=>'btn btn-default')); ?>
                <?php echo $this->Html->link(__('Borrar'), array('action'=>'delete', $catId), array('class'=>'btn btn-danger'), null, sprintf(__('Seguro que querés borrar la categoria # %s?'), $catName)); ?>
            </td>
        </tr>
    <?php } ?>
    </table>
</div>
