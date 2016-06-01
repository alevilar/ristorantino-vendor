<?php if ($this->Session->check('Auth.User.id') ) { ?>
<div class="p-username center" aria-expanded="false">
    <?php
    $email = '';
    if ( $this->Session->check('Auth.User.email') ) {
    	$email = " <small>(" . $this->Session->read('Auth.User.email').")</small>";
    }
 	echo $this->Session->read('Auth.User.username') . $email; 
 	?>
 	<?php if ( Configure::check('Site.name') ) {?>
	 	<br>
	 	<b>"<?php echo Configure::read('Site.name');?>"</b>
 	<?php } ?>


 	<?php echo $this->fetch('pos-tenant');?>
</div>

<?php } ?>