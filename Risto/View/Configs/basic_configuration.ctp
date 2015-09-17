<?php

echo $this->Form->create("Config");


foreach ($this->request->data as $k=>$d ) {
	?>
	<div class="col-md-2">
	<?php
	echo $this->Form->input($k.'.Config.id', array('value'=>$d['Config']['id']));
	echo $this->Form->input($k.'.Config.value', array('value'=>$d['Config']['value'], 'label'=>$d['Config']['key'], 'after'=> $d['Config']['description']));
	?>
	</div>
	<?php
}
?>
<div class="clearfix"></div>
<?php

echo $this->Form->end("Guardar");
