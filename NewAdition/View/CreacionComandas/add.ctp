<?php $this->start('jquery-tmpl'); ?>
<?php echo $this->Html->script('/adition/js/jqm_events/comanda_add'); ?>
<?php echo $this->Html->script('/adition/js/View/ComandaAddView'); ?>
<?php $this->end(); 

?>

<div data-role="page" id="comanda-add" class="comanda" data-enhance="false">
    <?php echo $this->Html->css('/adition/css/comanda_add');?>
    <div data-role="header" data-id="mesa-header" data-position="fixed">
        <a href="#mesa-view" data-rel="back" data-transition="reverse">Volver</a>
        <h1>
            <span class="mesa-numero"></span>
            <?php
            echo $this->Html->image('mesa-abrio.png') . " " . Configure::read('Mesa.tituloMesa') . " - " .
            Configure::read('Mesa.tituloMozo') . " " . $this->Html->image('mozomoniob.png')
            ?>
            <span class="mozo-numero"></span>

            <span class="hora-abrio">Estado: <span class="mesa-estado"></span></span>
        </h1>      
    </div>

    <div data-role="content" data-enhance="false">
        <div id="listado_categorias">
            <?php echo $this->element('comanda_add/listar_categorias'); ?>
        </div>

        <div id="listado_productos">
            <?php echo $this->element('comanda_add/listar_productos'); ?>
        </div>

        <div id="detalle_productos">
            <?php echo $this->element('comanda_add/detalle_producto'); ?>
        </div>
    </div>    
</div>