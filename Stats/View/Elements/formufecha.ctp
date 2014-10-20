<?php
    echo $this->Form->create('Mesa', array('class' => 'form-inline formufecha'));
    ?>
    <legend>Filtrar por rango de fechas</legend>
    <?php
    echo $this->Form->input('desde', array('type' => 'date', 'label'=>false));
    echo $this->Form->input('hasta', array('type' => 'date', 'label'=>false));
    echo $this->Form->submit('Aceptar', array('class' => 'btn btn-default', 'div' => false));
    echo $this->Form->end();
?>