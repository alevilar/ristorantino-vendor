

	<div>
	    
	    <div id="mesajes"><?php $this->Session->flash(); $this->Session->flash('auth'); ?></div>    
	    
	    <p>
	        <a href="#mesa-view" rel="back" data-rel="reverse" data-role="button" data-theme="c">Volver</a>
	        <br />
	        <?php 

	        	if ( !empty($cliente_id) ) { 
	        		$cliente = $this->request->data['Cliente'];
	        		$cliente['IvaResponsabilidad'] = $this->request->data['IvaResponsabilidad'];
	        		$cliente['TipoDocumento'] = $this->request->data['TipoDocumento'];
	        		if ( !empty($this->request->data['Descuento']['id']) ) {
	        			$cliente['Descuento'] = $this->request->data['Descuento'];
	        		}
	        		$cliJson = json_encode( $cliente );
	        	?>
	        	<script type="text/javascript">
	        		var dataClientes = {
	        			"cli-<?php echo $cliente['id']?>" : <?php echo $cliJson; ?>
	        		};
	        	</script>
	            <a href="#mesa-view" rel="back" data-rel="reverse" data-role="button" data-theme="b" 
	            onclick="Risto.Adition.adicionar.currentMesa().setDataCliente( 'cli-<?php echo $cliente['id']?>')">Agregar a <b><?php echo $cliente['nombre']?></b> a la <?php echo Configure::read('Mesa.tituloMesa'); ?></a>
	        <?php } ?>
	    </p>
	</div>

