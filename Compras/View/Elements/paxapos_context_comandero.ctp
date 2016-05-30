
<h3 class="center">
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
</h3>