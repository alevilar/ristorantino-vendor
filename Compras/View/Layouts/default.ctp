<?php $this->extend('Risto.base'); ?>


<?php $this->append('paxapos-main-menu');?>
    <?php echo $this->element("Risto.paxapos_main_menu/tenant_home_btn");?>
    <br>
   
    <?php echo $this->element("Compras.paxapos_context_menu");?>
<?php $this->end();?>


<?php 
	$this->append('pos-tenant');
		echo $this->Html->image('/risto/css/ristorantino/home/pedidos.png', array('class'=>'paxapos-app-header-icon'));	
	$this->end(); 
?>




<?php echo $this->fetch('content');?>