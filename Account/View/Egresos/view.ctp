<?php echo $this->Html->css('/account/css/style'); ?>
<h1>Pago #<?php echo $egreso['Egreso']['id']?></h1>

<div class="pagos-list">
    <p><?php
echo "<span class='fecha'>(" . date('d-m-y', strtotime($egreso['Egreso']['fecha'])) . ")</span>";
echo "<span class='total'> " . $this->Number->currency($egreso['Egreso']['total']) . "</span>";

echo "<span class='tipo_de_pago'> " . $this->Html->imageMedia($egreso['TipoDePago']['media_id']) . "</span>";

echo "<p>";

if ( $egreso['Egreso']['media_id'] ) {
    $img = $this->Html->imageMedia( $egreso['Egreso']['media_id'] );
    echo $this->Html->link($img, array('plugin'=>'risto', 'controller'=>'medias', 'action'=>'download', $egreso['Egreso']['media_id'] ), array( 'escape' => false) );
}


if (!empty($egreso['Egreso']['observacion'])) {
    echo "<span class='observacion'> " . $egreso['Egreso']['observacion'] . "</span>";
}
?></p>
    
    <p>
    <?php echo $this->Html->link('  Editar pago',array('action' => 'edit', $egreso['Egreso']['id'])); ?>
        <br>
     <?php echo $this->Html->link('Eliminar pago', array('action'=>'delete', $egreso['Egreso']['id']), null, sprintf(__('¿Está seguro que desea borrar el pago $%s', true), $egreso['Egreso']['total'])) ?>
    </p>
    <div>
        <h3>Listado de Gastos</h3>
        <ul>
            <?php
            foreach ($egreso['Gasto'] as $ga){ ?>
                    <li>
                        <?php
                        $proveedor = '';
                        if (!empty($ga['Proveedor'])) {
                            $proveedor = $ga['Proveedor']['name'];
                        }
                        echo "$proveedor Total: ".$this->Number->currency($ga['importe_total'])
                        ." Pagado: ".$this->Number->currency($ga['AccountEgresosGasto']['importe'])
                        ." (".date('d-m-Y',strtotime($ga['fecha'])).") ";
                        echo $this->Html->link(                                
                                'ver', 
                                array(
                                    'controller'=>'gastos', 
                                    'action'=>'view', 
                                    $ga['id']
                                )
                                );
                        
                        if (!empty($ga['observacion'])) {
                        ?>
                        <p>
                            <?php 
                            echo $ga['observacion'];
                            ?>
                        </p>
                        <?php } ?>
                    </li>
                    <?php } ?>
        </ul>
    </div>

</div>