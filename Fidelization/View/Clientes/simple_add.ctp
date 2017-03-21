<div data-role="page" id="clientes-addfacturaa">

    <div data-role="header">
        <h1><?php echo Inflector::pluralize( Configure::read('Mesa.tituloCliente')) ?></h1>
    </div>
        
    <div data-role="content" data-theme="f">
        <div id="form-cliente-a" class="clientes form">
            <?php echo $this->Form->create('Cliente', array( 
                                        'url' => array(
                                            'action'=>'simple_add', 
                                        ),
                                        'onsubmit' => 'return false;',
                                        'id' =>'form-cliente-add', 
                                        'data-ajax'=>'false'));?>


            <div class="ui-grid-b">
                <div class="ui-block-a">
                    <?php
                        echo $this->Form->input('iva_responsabilidad_id', array('data-theme'=>'d', 'default' => IVA_RESPONSABILIDAD_CONSUMIDOR_FINAL));
                        echo $this->Form->input('nombre',array('label'=>'Nombre/Razón Social', 'style'=> 'width:85%'));
                        echo $this->Form->input('domicilio',array('label'=>'Domicilio', 'style'=> 'width:85%'));                 
                    ?>
                </div>
                

                <div class="ui-block-b">
                    <?php
                        echo $this->Form->input('tipo_documento_id', array('data-theme'=>'d', 'empty' => 'Seleccionar', 'required'=>false ));
                        echo $this->Form->input('nrodocumento', array('label'=>'Número', 'type'=>'number', 'step'=>1, 'style'=> 'width:85%'));
                        echo $this->Form->input('telefono',array('label'=>'Telefono', 'style'=> 'width:85%'));
                    ?>
                </div>


                <div class="ui-block-c">
                    <?php 
                        echo $this->Form->input('descuento_id', array('empty'=>'Sin Descuento', 'data-theme'=>'d')); 
                        echo $this->Form->input('fecha', array('style'=> 'width:85%', 'placeholder'=>'YYYY-MM-DD', 'label'=>'Fecha (YYYY-MM-DD)'));
                        echo $this->Form->input('observacion', array('style'=> 'width:85%'));
                    ?>
                </div>
            </div>
           
        <div class="ui-grid-b">
            <div class="ui-block-a">
            <?php echo $this->Form->submit('Volver atras', array('class' => 'btn btn-default', 'data-theme' => 'd')); ?>   
            </div>
            <div class="ui-block-b">
            </div>
            <div class="ui-block-c">
            <?php echo $this->Form->submit('Agregar', array('class'=>'btn btn-success', 'data-theme'=>'b')); ?>
            </div>
            </div>          
            <?php echo $this->Form->end(); ?>
        </div>
    </div>

</div>