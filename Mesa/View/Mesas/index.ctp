<div id="mesas-index">
<?php echo $this->Html->link(__('Abrir %s', Configure::read('Mesa.tituloMesa')), array('action' => 'add'), array('class'=>'btn btn-lg btn-success pull-right')); ?>
<h1><?php echo Inflector::pluralize(   Configure::read('Mesa.tituloMesa') ) ;?></h1>

        <?php echo $this->Form->create("Mesa", array("action" => "index")); ?>
         <div class="row">
            <strong>
            <?php echo __('Buscar')?>
            </strong>
        </div>
        <div class=" col-md-1">
            <?php echo $this->Form->input('numero', array('label' => Configure::read('Mesa.tituloMesa'), 'required'=>false)); ?>
            <?php echo $this->Form->input('mozo_numero', array('label' => Configure::read('Mesa.tituloMozo') )); ?>
        </div>
        <div class="col-md-2">
            <?php echo $this->Form->input('total', array('label' => 'Importe'));
            echo $this->Form->input('estado_id', array(
                'label' => __('Estado'),
                'type' => 'select',
                'empty' => 'Seleccione',                
            ));
            ?>
        </div>


        <div class="col-md-3">
            <?php
            echo $this->Form->input('created_from', array(
                'label' => 'Abierta desde',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
            <?php
            echo $this->Form->input('created_to', array(
                'label' => 'Abierta hasta',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
        </div>

        <div class="col-md-3">
            <?php
            echo $this->Form->input('time_cerro_from', array(
                'label' => 'Cerró desde',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
            <?php
            echo $this->Form->input('time_cerro_to', array(
                'label' => 'Cerró hasta',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
        </div>

        <div class="col-md-3">
            <?php
            echo $this->Form->input('time_cobro_from', array(
                'label' => 'Cobrada desde',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
            <?php
            echo $this->Form->input('time_cobro_to', array(
                'label' => 'Cobrada hasta',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
        </div>
        <div class="clear"></div>

        <?php echo $this->Form->submit('Buscar', array('class' => 'btn btn-primary', 'title' => __('Buscar')));
              echo $this->Form->end();?>

        <?php
        if ($this->Paginator->params['paging']['Mesa']['count'] != 0) {
            echo $this->element('listado_tabla');
        } else {
            ?>
            </br>
            <strong>            
                <?php  echo __( 'No se encontraron %s', Inflector::pluralize(Configure::read('Mesa.tituloMesa') ) ); ?>
            </strong>
            <?php
        }
        ?>


    </div>
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
</div>