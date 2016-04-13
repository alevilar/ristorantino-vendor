<div class="center">


<?php echo $this->Html->script('/comanda/js/packery.pkgd.min.js');?>

<?php 

if ( $cantComandas > 1) {
	$txtCom = "Comandas";
} else {
	$txtCom = "Comanda";
}
$txtCom = "<b>$cantComandas</b> $txtCom";
 ?>

	<h1><?php echo $txtCom ?> del

		<?php echo $this->Form->input('printer_id', array(
						'options'=>$printers, 
						'label' => 'Sector',
						'empty'=>'Todos',
						'default' => $printer_id,
						'id' => 'printer-id-select',
						'div' => false,
						'data-href' => Router::url(array('action'=>$this->action)),
						));
						?>

	</h1>

	<hr>

<div class="small">Última Actualización: <?php echo $this->Time->format(strtotime('now'),"%H:%M");?></div>
	<br>
</div>



<?php echo $this->Html->css('/comanda/css/comandero_comanda');?>




<div class="comandero" data-packery='{"itemSelector": ".comanda"}'>
	<div class="comandero-comanda-list">
		<?php
		foreach ($comandas as $comanda) {
			echo $this->element('comandero_comanda', array('comanda'=>$comanda));
		}
		?>
	</div>
</div>


<audio id="sound-alert">
  <source src="<?php echo Router::url('/comanda/sounds/electronic_chime.mp3')?>" type="audio/mpeg">
Your browser does not support the audio element.
</audio>

<script>
	
	$("#printer-id-select").on('change', function(e){
		location.href = $(this).data('href') + "/" + $(this).val();
	});



// actualizacion de pagina cuando hay una comanda nueva

	setInterval(function(){ 
		$.post('<?php echo Router::url(array("action"=>"hayActualizacion", $printer_id))?>', function( data ){
			if ( data ) {
				vid = document.getElementById("sound-alert");		
				vid.play();
				location.href =  window.location.href;
			}
		});


	 }, 8000);


</script>