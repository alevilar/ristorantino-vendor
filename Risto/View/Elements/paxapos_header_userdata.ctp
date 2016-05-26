<?php if ($this->Session->check('Auth.User.id') ) { ?>
<div class="p-username center" aria-expanded="false">
    <?php
 	echo $this->Session->read('Auth.User.username') . " <small>(" . $this->Session->read('Auth.User.email').")</small>"; 
 	?>
 	<?php if ( Configure::check('Site.name') ) {?>
	 	<br>
	 	<b>"<?php echo Configure::read('Site.name');?>"</b>
 	<?php } ?>
</div>

<?php } ?>