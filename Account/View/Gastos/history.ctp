<?php echo $this->Html->css('/account/css/style');?>

<?php echo $this->Html->link('Nuevo Gasto', array('plugin'=>'account', 'controller'=>'gastos', 'action'=>'add'), array('class' => 'btn btn-lg btn-success pull-right')) ?>
<h1>Listado de Gastos</h1>


<?php
echo $this->Html->link(' <span class="glyphicon glyphicon-download"></span> '.__('Descargar Excel')
    , array(
        'action'=> $this->action, 'ext'=> 'xls'
        )
    , array(
        'escape' => false,
        'data-ajax' => 'false',
        'class' => 'btn btn-primary pull-right',
        'div'=> array(
            'class' => 'pull-right'
            )
    ));
?>
<?php echo $this->element('form_mini_year_month_search'); ?>

<?php echo $this->Form->create('Cierre'); ?>
<div id='place-for-inputs' class="cq-hide"></div>
<div id='descripcion-cierre' class="well cq-hide">
    <div class="pull-right">
        <span class="glyphicon glyphicon-info-sign"></span>
        <small><cite>Al cerrar un conjunto de gastos se impide que estos sean modificados.</cite></small>
    </div>
    <p><span class='detalle-gastos'></span> gastos seleccionados</p>
    <?php
    echo $this->Form->input('name', array('placeholder'=>'Ejemplo: Cierre de Abril','label' => 'breve descripción del cierre', 'required' => true));
    echo $this->Form->button('Cancelar', array('type' => 'button', 'id'=>'CancelBtn', 'class'=>'btn'));
    echo "&nbsp;";
    echo $this->Form->button('Guardar', array('type' => 'submit', 'class'=>'btn btn-primary'));
    
    ?>
</div>


<div class="">
<?php
echo $this->Form->button('Aplicar Cierre', array(
    'type' => 'button',
    'data-theme' => 'b',
    'data-inline' => 'true',
    'data-role' => 'button',
    'class' => 'btn btn-default',
    'id' => 'btn-gastos-apli-cierre'));

echo $this->Form->end();
?>


    </div>

<br>

<?php echo $this->element('gastos_full_table'); ?>


<script type="text/javascript">
    $('#CancelBtn').bind('click', function() {
        $("#descripcion-cierre").hide("fade")
    });

</script>