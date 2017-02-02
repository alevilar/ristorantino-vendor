<?php $this->element("Risto.layout_modal_edit", array('title'=>'Cobro'));?>


<div class="pagos index content-white">
<!--<div class="btn-group pull-right">
<?php echo $this->Html->link(__('Create New %s', __('User')), array('admin'=>true,'plugin'>'users', 'controller'=> 'users', 'action'=>'add'), array('class'=>'btn btn-success btn-lg')); ?>
<?php echo $this->Html->link(__('Add Existing %s', __('User')), array('admin'=>true,'plugin'>'users', 'controller'=> 'users', 'action'=>'add_existing'), array('class'=>'btn btn-default btn-lg')); ?>
</div>-->
<h2><?php echo __d('pagos', 'Cobros'); ?></h2>


<p>
<?php
$this->Paginator->options(array('url' => $this->request->query));

?>
</p>
<?php echo $this->element("Mesa.cobros_table_list"); ?>
		<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de  {:count} registros totales, iniciando en el registro {:start}, y terminando en el registro {:end}')
		));
		?>
		</p>

<?php echo $this->element('Risto.pagination'); ?>
</div>
