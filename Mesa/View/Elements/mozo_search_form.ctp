
<?php echo $this->Form->create('Mozo'); ?>
<div class="row mozo-search-form">
	<div class="col-sm-6 col-sm-offset-2 col-xs-10">
		<?php 
		echo $this->Form->text('search', array(
				'placeholder'=>'Buscar (Ej: Nombre, apellido, alias, número, etc.)',
				'class' =>'form-control'
				));?>
	</div>

	<div class="col-sm-2  col-xs-2">
		<?php echo $this->Form->button(__("Buscar"), array('type'=>'submit','class'=>'btn btn-primary btn-block'));?>
	</div>

</div>
<?php echo $this->Form->end();?>


<div class="clearfix"></div>
<br>