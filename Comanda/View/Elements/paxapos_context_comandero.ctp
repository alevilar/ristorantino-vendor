
<div class="list-group">

	    <?php echo $this->Html->link('Comandero', array('plugin'=>'comanda', 'controller'=>'comandas', 'action'=>'comandero'), array('class'=>'list-group-item')) ?>

	    <?php echo $this->Html->link('Histórico', array('plugin'=>'comanda', 'controller'=>'comandas', 'action'=>'terminadas'), array('class'=>'list-group-item')) ?>

	    <br>
	    <h3 class="center">Voice to Speech</h3>
	    	<label for="muted"><?php echo __("Silenciar")?></label> <input type="checkbox" name="muted" id="muted" /><br>
	    	<select name="lenguaje-comandero" id="lenguaje-comandero" disabled>
	    </select>
</div>

<?php $this->append("script");?>
	<script>

	// SELECT
		$lenguajeComandero = $("#lenguaje-comandero");
		if ( window && "speechSynthesis" in window ) {
			var seleccionado;
		    setTimeout(function(){
				var voices = speechSynthesis.getVoices();
				$options = [];
				$.each( voices, function ( i, voice ) {
					var name = voice.name; 
					var lang = voice.lang;
					var $option = $("<option>").val(lang).text(name);
					var langSelected = localStorage.getItem("Comandero.lang");
					if (langSelected == lang ) {						
						seleccionado = i;
					}
					$lenguajeComandero.append($option);
				});	

				if (seleccionado) {
					$lenguajeComandero.prop('selectedIndex',seleccionado);
				}
		    }, 2000);
			
			$lenguajeComandero.removeAttr("disabled");
		}	

		$lenguajeComandero.on("change", function(){
			localStorage.setItem("Comandero.lang", this.value);
		});

	// SILENCIAR
	var comanderoMuted = JSON.parse( localStorage.getItem("Comandero.muted") );
	$("#muted").prop( "checked",  comanderoMuted);
	$("#muted").on('click', function() {
		localStorage.setItem("Comandero.muted", this.checked);
	});
	</script>
<?php $this->end();?>