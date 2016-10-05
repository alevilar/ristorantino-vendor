

<div id="printer-selection">
	<?php 
		$printer = isset($printer_id) ? $printers[$printer_id] : '';
		echo "<h3>";

		echo $this->Form->input('printer_id', array(
				'options'=>$printers, 
				'label' => 'Sector',
				'empty'=>'Todos',
				'default' => $printer_id,
				'id' => 'printer-id-select',
				'div' => false,
				'data-href' => Router::url(array('action'=>$this->action)),
				));
		echo "</h3>";


	?>
</div>

<?php 
echo $this->append("script");
	echo $this->Html->script('/comanda/js/printer_selection'); 
echo $this->end();
?>