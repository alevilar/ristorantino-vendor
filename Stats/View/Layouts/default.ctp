<?php $this->extend('Risto.base'); ?>



<?php 
	$this->append('pos-tenant');
		echo $this->Html->image('/risto/css/ristorantino/home/stats.png', array('class'=>'paxapos-app-header-icon'));	
	$this->end(); 
?>




<?php echo $this->fetch('content');?>