 <?php if ($this->Session->check('Auth.User')): ?>
    <div class="nav navbar-right text-warning" style="padding: 15px 0px;">
        <?php
        echo $this->Session->read('Auth.User.nombre') . " " . $this->Session->read('Auth.User.apellido');

        echo " - " . $this->Session->read('Auth.User.role') . " -";
        ?>
        <?php echo $this->Html->link('salir', array('controller' => 'users', 'action' => 'logout', 'plugin' => 'users')); ?>
    </div>
<?php endif; ?>