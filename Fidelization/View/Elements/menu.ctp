<ul class="nav nav-tabs  nav-justified">

  <?php $class = $this->request->controller == 'clientes' ? 'active':'';?>
  <li role="presentation" class="<?php echo $class?>">
  	<?php echo $this->Html->link('Clientes', array('plugin'=>'fidelization', 'controller'=>'clientes', 'action'=>'index'));?>
  </li>

  <?php $class = $this->request->controller == 'descuentos' ? 'active':'';?>
  <li role="presentation" class="<?php echo $class?>">
  <?php echo $this->Html->link('Descuentos', array('plugin'=>'fidelization', 'controller'=>'descuentos', 'action'=>'index'));?>
  </li>

</ul>