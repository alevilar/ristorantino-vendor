<div class="modal fade" id="modal-for-images" tabindex="-1" role="dialog" aria-labelledby="modal-for-images">
	<div class="modal-dialog modal-full" role="document">
		<div class="modal-content">
			<div class="modal-body"></div>
		</div>
	</div>
</div>


<?php $this->append('footer'); ?>

	<!--  bootsrap 3 MODAL para imagenes -->
	<?php echo $this->Html->script('Risto.zoom-master/jquery.zoom.min');?>
	<?php echo $this->Html->css('Risto.img-modal');?>
	<?php echo $this->Html->script('Risto.img-modal');?>


<?php $this->end();?>