<div class="sabores view">
<h2><?php  __('Adicional');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sabor['Sabor']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sabor['Sabor']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Categoria Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sabor['Sabor']['categoria_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sabor['Sabor']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sabor['Sabor']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar Adicional', true), array('action'=>'edit', $sabor['Sabor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Borrar Adicional', true), array('action'=>'delete', $sabor['Sabor']['id']), null, sprintf(__('Seguro desea eliminar el Adicional id# %s?', true), $sabor['Sabor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Adicionales', true), array('action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Crear Adicional', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
