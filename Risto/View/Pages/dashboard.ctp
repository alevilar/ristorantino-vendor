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
        <?php 

        if ( Configure::read('Site.type') != SITE_TYPE_HOTEL ) {
          echo $this->Html->link('Adición', array('plugin' =>'aditions', 'controller'=>'aditions', 'action'=>'adicionar'), array('id' => 'bton-adicion')); 
        } else {
          echo $this->Html->link('Reservas', array('plugin' =>'aditions', 'controller'=>'aditions', 'action'=>'adicionar'), array('id' => 'bton-reservations')); 
        }
        ?>
    </li>
   

    <li>  
        <?php echo $this->Html->link('Contabilidad', array('controller' => 'account', 'action' => 'index', 'plugin' => 'account'), array('id' => 'bton-contabilidad')); ?>
    </li>       

    <li>  
        <?php echo $this->Html->link('Arqueo', array('plugin' => 'cash', 'controller' => 'arqueos'), array('id' => 'bton-arqueo')); ?>
    </li>  
     

<!--    <li>   
        <?php echo $this->Html->link('Inventario', '/inventory', array('id' => 'bton-inven')); ?>
    </li>  -->
   </ul>
  
  <ul class="dashboard-buttons">



    <li>  
        <?php echo $this->Html->link('Estadisticas', array('plugin' => 'stats', 'controller' => 'stats', 'action' => 'mesas_total'), array('id' => 'bton-estadisticas')); ?>
    </li>     

     <li>   
        <?php echo $this->Html->link('Admin', array('plugin'=>'risto', 'controller'=>'pages', 'action'=>'display', 'administracion'), array('id' => 'bton-admin')); ?>
    </li>

       

</ul>
      
  </p>
</div>
