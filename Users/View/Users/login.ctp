

<div class="col-md-8">
	<h3>Bienvenidos al...</h3>
	<h1>Ristorantino Mágico</h1>

	
</div>



<div class="col-md-4 login">
<?php 
if ( !$this->Session->check('Auth.User')): ?>
		<h3>&nbsp;</h3>
		<h1>Logueo De usuario</h1>
		<?php
		if($this->Session->check('Message.auth')) $this->Session->flash('auth');

		    /* @var $form FormHelper */
		$form;
		echo $this->Form->create('User', array('plugin'=>'users', 'controller'=>'users', 'action'=>'login', 'role'=>'form'));
		echo $this->Form->input('username',array('placeholder'=>'Usuario', 'label'=>false));
		echo $this->Form->input('password', array('type'=>'password','placeholder'=>'Contraseña', 'label'=>false));
		echo $this->Form->button('Entrar', array('type'=>'submit', 'class'=>'btn btn-primary btn-block'));
		echo $this->Form->end();
		?>
<?php else: ?>
	<h3>&nbsp;</h3>

		<?php echo $this->Html->link(__('Add New Site'), array('plugin'=>'Install', 'controller'=>'SiteSetup', 'action'=>'installsite'), array('class'=>'btn btn-success btn-lg center')); ?>

		<div class="clearfix"><br /></div>

		<h1>Mis Sitios</h1>

		
		<div class="list-group">

		<?php App::uses('MtSites', 'MtSites.MtSites'); ?>
		<?php if ( $this->Session->check('Auth.User.Sites') ): ?>
			<?php foreach ( $this->Session->read('Auth.User.Sites') as $s ): ?>
				<?php echo  $this->Html->link( $s['name'] , array( 'tenant' => $s['alias'], 'plugin'=>'risto' ,'controller' => 'pages', 'action' => 'display', 'dashboard' ), array('class'=>'list-group-item' ));?>
			<?php endforeach; ?>
		<?php endif; ?>

		 </div>
<?php endif; ?>
		
</div>
