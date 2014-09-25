<?php
if ( !empty($this->request->data['Egreso']['id'])) {
    $txt = 'Editar';
} else {
    $txt = 'Crear Nuevo';
}
?>
<h1><?php echo $txt; ?> Pago
    <?php if (!empty($cant_gastos)) {
        if ( $cant_gastos > 1) { 
    ?>
        <small>Total adeudado que suman los <?php echo $cant_gastos ?> gastos seleccionados: <?php echo $this->Number->currency($this->request->data['Egreso']['total']) ?></small>
    <?php } else { ?>
        <small>Total adeudado que suma el gasto seleccionado: <?php echo $this->Number->currency($this->request->data['Egreso']['total']) ?></small>
        <?php }  
    }
    ?>
</h1>

<div class="row">
    <div class="col-md-6">
<?php
echo $this->Form->create('Egreso', array('action' => 'save', 'data-ajax' => "false", 'type' => 'file'));

echo $this->Form->input('id');


echo $this->Form->input('fecha', array('type' => 'datetime'));


echo $this->Form->input('tipo_de_pago_id');
echo $this->Form->input('total', array('type' => 'number'));

?>
</div>

<div class="col-md-6">
    
    <?php

if (!empty($this->request->data['Egreso']['media_id'])) {    
        echo $this->Html->imageMedia( $this->request->data['Egreso']['media_id'] , array('class'=>'thumb'));
}
echo $this->Form->input('media_file', array('type' => 'file', 'label' => 'Subir PDF, Imagen, Archivo'));


echo $this->Form->input('observacion');
?>
</div>
    
    <?php
// listado de gastos seleccionados ocultos

echo "<div style='display:none'>";
foreach ($gastos as $gId => $g) {
    echo $this->Form->checkbox('Gasto.Gasto.' . $gId, array('checked' => true, 'value' => $gId));
}
echo "</div>";

echo $this->Form->button('guardar', array('type'=>'submit', 'class'=>'btn btn-lg btn-success'));
echo $this->Form->end(null);
