<script type="text/javascript">
var cajero = new Cajero();

cajero.urlGuardar = "<?php echo $html->url('/pagos/add');?>";


function abrirVentana(mesa, total){
    var t = total || 0;
    cajero.cobrarMesa(mesa, t);
    return false;
}
</script>


<div id="listado-mesas" class="listado-mesas">
	<ul>
		<?php foreach($mesas_abiertas as $m):?>
		
			<li id="mesa-id-<?php echo  $m['Mesa']['id']?>" onclick="return abrirVentana(<?php echo  $m['Mesa']['id']?>);">
					
				<span class="mesa-numero"><?php echo $m['Mesa']['numero']?></span>
				<span class="mozo-numero"><?php echo $m['Mozo']['numero']?></span>
				<div class="mesa-time-created">Abrió: <?php echo date('H:i',strtotime($m['Mesa']['created'])) ?></div>	
				<span style="font-size: 9px;"><?php echo (!empty($m['Cliente']['Descuento']))?"Dto: ".$m['Cliente']['Descuento']['porcentaje']."%":''; ?></span>
				<div style="font-size: 9px;"><?php echo "Tiene ".count($m['Comanda'])." comandas";?></div>
				
			</li>
		<?php endforeach;?>
	</ul>
</div>



<?php echo $this->renderElement('mesas_scroll');?>

<div id="mesas-paginador">
	<?php echo $this->Paginator->prev(); ?> 
	<?php echo $this->Paginator->numbers(); ?> 
	<?php echo $this->Paginator->next(); ?>
</div>


<?php echo $this->renderElement('cierre_efectivo_tarjeta');?>
