
<link href='https://fonts.googleapis.com/css?family=Chau+Philomene+One' rel='stylesheet' type='text/css'>

<?php $this->start('comandero-title'); ?>

<div class="row">
	<div class="col-md-6">
			<h1 style="margin-top: 10px;">

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
	</div>


	<div class="col-md-6">
		<div id="time">
			<span id="clockDisplay" class="clockStyle"></span>

			<div class="small">Última Actualización: <span id="comandero-updated-time"><?php echo $this->Time->format(strtotime('now'),"%H:%M");?></span>
			</div>
		</div>
	</div>
	
</div>
	



	

<?php $this->end();?>


<hr>

<div id="comandero-content"></div>

<div class="clearfix"></div>

<hr>

<?php echo $this->Html->css('/comanda/css/comandero_comanda');?>





<audio id="sound-alert">
  <source src="<?php echo Router::url('/comanda/sounds/electronic_chime.mp3')?>" type="audio/mpeg">
Your browser does not support the audio element.
</audio>

<script>	
	URL_HAY_ACTUALIZACION = '<?php echo Router::url(array("action"=>"hayActualizacion", $printer_id))?>';

	URL_COMANDERO_INDEX = '<?php echo Router::url(array("action"=>"comandero_index", $printer_id))?>';


	COMANDA_ESTADO_PENDIENTE = <?php echo COMANDA_ESTADO_PENDIENTE?>;
	COMANDA_ESTADO_LISTO 	 = <?php echo COMANDA_ESTADO_LISTO?>;
	COMANDA_ESTADO_MARCHANDO = <?php echo COMANDA_ESTADO_MARCHANDO?>;
	COMANDA_ESTADO_SALIENDO  = <?php echo COMANDA_ESTADO_SALIENDO?>;
</script>


<?php echo $this->Html->script('/comanda/js/packery.pkgd.min.js');?>
<?php echo $this->Html->script('/comanda/js/comandero'); ?>