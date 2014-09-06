<?php
echo $this->Html->css('/risto/css/ristorantino/home/ristorantino.home');


?>
<div class="jumbotron">
    <div style="text-align: center">
    <h1><?php echo Configure::read('Site.name');?></h1>
  
  </div>
  <p>
   <ul class="dashboard-buttons">
    <li>
        <?php echo $this->Html->link('Adición', '/aditions/adicionar', array('id' => 'bton-adicion')); ?>
    </li>
   

    <li>  
        <?php echo $this->Html->link('Contabilidad', array('controller' => 'account', 'action' => 'index', 'plugin' => 'account'), array('id' => 'bton-contabilidad')); ?>
    </li>       

    <li>  
        <?php echo $this->Html->link('Arqueo', '/cash/arqueos', array('id' => 'bton-arqueo')); ?>
    </li>  
     

<!--    <li>   
        <?php echo $this->Html->link('Inventario', '/inventory', array('id' => 'bton-inven')); ?>
    </li>  -->
   </ul>
  
  <ul class="dashboard-buttons">


    <li>  
        <?php echo $this->Html->link('Reservas', '/ReservationManager/reservations', array('id' => 'bton-reservations')); ?>
    </li>

    <li>  
        <?php echo $this->Html->link('Estadisticas', array('plugin' => 'stats', 'controller' => 'stats', 'action' => 'mesas_total'), array('id' => 'bton-estadisticas')); ?>
    </li>     

     <li>   
        <?php echo $this->Html->link('Admin', '/pages/administracion', array('id' => 'bton-admin')); ?>
    </li>

       

</ul>
      
  </p>
</div>
