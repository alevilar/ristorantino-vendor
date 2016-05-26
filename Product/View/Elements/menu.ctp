<ul class="nav nav-tabs  nav-justified">

  <?php $class = $this->request->controller == 'productos' ? 'active':'';?>
  <li role="presentation" class="<?php echo $class?>">
  	<?php echo $this->Html->link('Productos', array('plugin'=>'product', 'controller'=>'productos', 'action'=>'index'));?>
  </li>

  <?php $class = $this->request->controller == 'sabores' ? 'active':'';?>
  <li role="presentation" class="<?php echo $class?>">
  <?php echo $this->Html->link('Variantes', array('plugin'=>'product', 'controller'=>'sabores', 'action'=>'index'));?>
  </li>

  <?php $class = $this->request->controller == 'categorias' ? 'active':'';?>
  <li role="presentation" class="<?php echo $class?>">
  <?php echo $this->Html->link('Categorias', array('plugin'=>'product', 'controller'=>'categorias', 'action'=>'index'));?>
  </li>


  <?php $class = $this->request->controller == 'tags' ? 'active':'';?>
  <li role="presentation" class="<?php echo $class?>">
  <?php echo $this->Html->link('Tags', array('plugin'=>'product', 'controller'=>'tags', 'action'=>'index'));?>
  </li>
</ul>