<?php 
// crear un link para pasar el siguiente estado

$linkPrev = $linkNext = null;


// btn and
$linkPrev = array(
			'action'=>'comandero_estado_change_previous', 
			$comanda['Comanda']['id'], 
			);
$linkPrev = Router::url($linkPrev);


// btn next
$linkNext = array(
			'action'=>'comandero_estado_change_next', 
			$comanda['Comanda']['id'], 
			);
$linkNext = Router::url($linkNext);
?>


<div class="comanda" 
	 id="comanda-id-<?php echo $comanda['Comanda']['id'];?>"
	 data-comanda-id="<?php echo $comanda['Comanda']['id'];?>"
	 data-href-next="<?php echo $linkNext?>"
	 data-href-prev="<?php echo $linkPrev?>"
	 >
	<?php echo $this->element('Comanda.comanda', array('comanda'=>$comanda)); ?>

</div>

