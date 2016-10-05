
<div class="comandero">
	<div id="comandero-comanda-list">
		<?php
		foreach ($comandas as $comanda) {
			echo $this->element('comandero_comanda', array('comanda'=>$comanda));
		}
		?>
	</div>
</div>