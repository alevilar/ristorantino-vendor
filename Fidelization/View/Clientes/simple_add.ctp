<div data-role="page" id="clientes-addfacturaa">

<div data-role="header">
	<a href="#mesa-view" data-direction="reverse" data-role="button" data-inline="true">Volver</a>
    <h1><?php echo __('Nuevo %s', Configure::read('Mesa.tituloCliente')) ?></h1>
    <button type="submit" data-theme="c" form="form-cliente-add"><?php echo __('Guardar') ?></button>
</div>
    
<div data-role="content" data-theme="f">
    <div id="form-cliente-a" class="clientes form">
        <?php echo $this->Form->create('Cliente', array( 
                                    'url'=>array('plugin'=>'fidelization','controller'=>'clientes','action'=>'simple_add'), 
                                    'onsubmit' => 'return false;',
                                    'id' =>'form-cliente-add', 
                                    'data-ajax'=>'false'));?>


        <div class="ui-grid-a">
            <div class="ui-block-a">
            	<div style="padding: 1%">
                <?php
                    echo $this->Form->input('iva_responsabilidad_id', array('default'=> IVA_RESPONSABILIDAD_RESPONSABLE_INSCRIPTO ));
                    echo $this->Form->input('nombre',array('label'=>'Nombre/Razón Social'));

                ?>

                <?php

                	echo $this->Form->input('codigo');
                    echo $this->Form->input('descuento_id', array('empty'=>'Sin Descuento'));
                ?>
                </div>
            </div>
            

            <div class="ui-block-b">
            	<div style="padding: 1%">
                <?php

                    echo $this->Form->input('tipo_documento_id', array('default'=> TIPO_DOCUMENTO_CUIT ));
                    echo $this->Form->input('nrodocumento', array('label'=>'Número (sin los guiones)'));                                
                ?>

                <?php

                   
					echo $this->Form->input('mail', array('type'=>'email'));
					echo $this->Form->input('telefono');
					echo $this->Form->input('domicilio');                           
                ?>
                </div>
            </div>

        </div>
       
        <?php 
        echo $this->Form->end();

        ?>
    </div>
</div>

</div>