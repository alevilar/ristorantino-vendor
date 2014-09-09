 <?php if ($this->Session->check('Auth.User')): ?>
    <div class="nav navbar-right text-warning" style="padding: 15px 0px;">
        <?php

        $userName = $this->Session->read('Auth.User.nombre') . " " . $this->Session->read('Auth.User.apellido');

        echo $this->Html->link( $userName, '/');

        ?>
        |
        <?php echo $this->Html->link('salir', array('controller' => 'users', 'action' => 'logout', 'plugin' => 'users')); ?>
    </div>
<?php endif; ?>