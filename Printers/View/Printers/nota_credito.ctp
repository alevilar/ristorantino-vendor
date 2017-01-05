<div data-role="dialog" id="adition-nota-credito">

    <div data-role="header">
        <h1>Nota de crédito</h1>
    </div>

    <div data-role="content">

        <?php echo $this->Session->flash(); ?>

        <div class="listado-mesas">

    <?php

    echo $this->Form->create('Cajero', array(
        // 'url'=>'nota_credito', 
        'type' =>'post', 
        'data-rel' => 'back', 
        'data-direction' =>"reverse",
        ));

    ?>
               <fieldset data-role="controlgroup" data-type="horizontal">
               <?php
    echo $this->Form->input('tipo', array('label' => 'Seleccionar Tipo de Factura','options'=> ClassRegistry::init('Risto.TipoFactura')->find('list'), 'type'=>'radio', 'required'=>'required'));
    ?>
               </fieldset>
    <?php
    
    echo $this->Form->input('cliente_id', array(
                            'empty' => 'Seleccione',
                            'options' => ClassRegistry::init('Fidelization.Cliente')->find('list')
                                                        ));


    echo $this->Form->input('numero_ticket', array('label' => 'Número de Ticket (sin guiones "-")'));

    echo $this->Form->input('importe');

    echo $this->Form->input('descripcion', array('default'=>'Error Corregido', 'label' => 'Ingresar una pequeña descripción'));

    ?>
                <div class="ui-grid-a">
                    <div class="ui-block-a">
                        <a href="#listado-mesas-cerradas" data-role="button">Volver</a>
                    </div>
                    <div class="ui-block-b">
                        <button type="submit" data-theme="b">Imprimir</button>
                    </div>
                </div>
                
       <?php echo $this->Form->end() ?>    



        </div>
    </div>



</div>

