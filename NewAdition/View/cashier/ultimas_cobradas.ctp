<script type="text/javascript">
var cajero = new Cajero();

cajero.urlGuardar = "<?php echo $html->url('/pagos/add');?>";


function cobrarMesa(mesa, total){
    cajero.cobrarMesa(mesa,total);
    return false;
}
</script>



<div id="listado-mesas" class="listado-mesas">
    <ul>
        <?php foreach($mesa as $m):?>
        <li id="mesa-id-<?php echo  $m['Mesa']['id']?>" onclick="cobrarMesa(<?php echo $m['Mesa']['id']?>,<?php echo $m['Mesa']['total']?>)">
            <span class="mesa-numero"><?php echo $m['Mesa']['numero']?></span>
            <span class="mozo-numero"><?php echo $m['Mozo']['numero']?></span>
            <div class="mesa-time-created">Abrió: <?php echo date('H:i',strtotime($m['Mesa']['created'])) ?></div>
            <div class="mesa-time-created">Cerró: <?php echo date('H:i',strtotime($m['Mesa']['time_cerro'])) ?></div>
            <div class="mesa-time-created">Cobró: <?php echo date('H:i',strtotime($m['Mesa']['time_cobro'])) ?></div>
            <span style="font-size: 9px;"><?php echo (!empty($m['Cliente']['Descuento']))?"Dto: ".$m['Cliente']['Descuento']['porcentaje']."%":''; ?></span>
        </li>
        <?php endforeach;?>
    </ul>
</div>

<?php echo $this->renderElement('cierre_efectivo_tarjeta');?>
<?php echo $this->renderElement('mesas_scroll');?>

<div id="mesas-paginador">
	<?php echo $this->Paginator->prev(); ?> 
	<?php echo $this->Paginator->numbers(); ?> 
	<?php echo $this->Paginator->next(); ?>
</div>