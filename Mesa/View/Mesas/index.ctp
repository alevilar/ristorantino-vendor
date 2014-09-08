<?php
echo $this->Html->script('mesas/index_head', false);



?>

<div id="mesas-index">


<?php echo $this->Html->link(__('Abrir %s', Configure::read('Mesa.tituloMesa')), array('action' => 'add'), array('class'=>'btn btn-lg btn-success pull-right')); ?>
<h1><?php echo Inflector::pluralize(   Configure::read('Mesa.tituloMesa')) ;?></h1>


    <div class="row">
        
        <?php echo $this->Form->create("Mesa", array("action" => "index")); ?>
        <div class=" col-md-1">
            <?php echo $this->Form->input('numero', array('label' => __('N° %s', Configure::read('Mesa.tituloMesa') ), 'required'=>false)); ?>
            <?php echo $this->Form->input('mozo_numero', array('label' => __('N° %s', Configure::read('Mesa.tituloMozo') ))); ?>
        </div>
        <div class="col-md-2">
            <?php echo $this->Form->input('total', array('label' => 'Importe'));
            echo $this->Form->input('estado_id', array(
                'label' => __('¿Qué %s?', Inflector::pluralize( Configure::read('Mesa.tituloMesa')) ),
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

        <?php echo $this->Form->end("Buscar") ?>


        <p class="text-center">
            <?php
            echo $this->Paginator->counter(
                'Page {:page} of {:pages}, showing {:current} records out of
                 {:count} total, starting on record {:start}, ending on {:end}'
            );
            
            // echo "..... y suman un total de <b>$$mesas_suma_total</b> pesos";
            ?>
        </p>

        <?php
        if ($this->Paginator->params['paging']['Mesa']['count'] != 0) {
            echo $this->element('listado_tabla');
        } else {
            ?>
            </br>
            <strong>            
                <?php  echo __( 'No se encontraron %s', Inflector::pluralize(Configure::read('Mesa.tituloMesa') ) ); ?>
            </strong>
        }
        ?>


    </div>
    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class' => 'disabled')); ?>
        | 	<?php echo $this->Paginator->numbers(); ?>
        <?php echo $this->Paginator->next(__('próximo', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
    </div>
    
</div>  