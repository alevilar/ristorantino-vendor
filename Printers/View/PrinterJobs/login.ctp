<div class="row">
	<div class="col-md-12">
	<?php 
		if ( !$this->Session->check('Auth.User')){
			echo $this->element('Users.boxlogin');		
		} else {
			echo "<p class='alert alert-info'>Ya estas logueado</p>";
		}
	?>
	</div>
</div>