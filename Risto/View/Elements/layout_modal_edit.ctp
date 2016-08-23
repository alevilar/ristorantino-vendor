<?php $size = (!empty($size)) ? $size : '';?>
<?php $this->start('modals');?>        
	<div id="addModal" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog <?php echo $size?>">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Crear <span class="modal-title-name"><?php echo !empty($title)?$title:""?></span></h4>
	      </div>
	      <div class="modal-body">
				<i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
				<span class="sr-only">Loading...</span>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<div id="editModal" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog <?php echo $size?>">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Editar <span class="modal-title-name"><?php echo !empty($title)?$title:""?></span></h4>
	      </div>
	      <div class="modal-body">
	      		<i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
				<span class="sr-only">Loading...</span>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<?php $this->end();?>



<?php $this->append('script');?>
<script type="text/javascript">

	function doLoad ( elementSelector ){
		return function(e) {
			// ocultar modals anteriormente abiertos
			$(".modal").modal("hide");

			// detener comportamiento por defecto del evento generado
			e.preventDefault();

			// cargar pagina por ajax usando el attr: href
			// el modal debera mostrar un LOADER porque puede que se
			// demore en cargar la pagina
			$(".modal-body", elementSelector).load(this.href);

			// mostrar la pagina cargada
			$( elementSelector ).modal('show');

			return false;
		}
	}

	$(".btn-edit").on('click', doLoad('#editModal') );

	$(".btn-add").on( 'click', doLoad('#addModal') );
</script>
<?php $this->end();?>