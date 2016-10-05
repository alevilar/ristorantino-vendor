<?php $this->extend('Risto.base'); ?>


<?php $this->append('paxapos-main-menu');?>
    <?php echo $this->element("Risto.paxapos_main_menu/tenant_home_btn");?>
    <br>
   
    <?php echo $this->element("Comanda.paxapos_context_comandero");?>
<?php $this->end();?>


<?php 

    $this->append('pre-header');
        echo $this->fetch("comandero-title");
    $this->end();
    
    $this->append('pos-tenant');
        echo $this->Html->image('/risto/css/ristorantino/home/comandero.png', array('class'=>'paxapos-app-header-icon')); 
    $this->end(); 
?>



<?php echo $this->fetch('content');?>