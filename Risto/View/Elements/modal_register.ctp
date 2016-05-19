<div id="registerModal" class="modal fade p-login-box" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2 class="modal-title center text-success">Alta de Usuario</h2>
          </div>
          <div class="modal-body center grey">
          Podés usar tu cuenta existente de Facebook o Google:
                <?php
                // box Login OAUTH
                echo $this->element('Users.box_oauth_login'); 
                ?>
                <i>(sólo tomaremos tu email de allí)</i>

                <div class="users form row">
                    <h4 class="text-success"><?php echo __d('users', 'o registrarte con cuenta en PaxaPos'); ?></h4>
                    <fieldset class="col-sm-8 col-sm-offset-2">
                        <?php
                            echo $this->Form->create('User', array('url'=>array('plugin'=>'users','controller'=>'users', 'action'=>'register')));
                            echo $this->Form->input('username', array(
                                'label' => __d('users', 'Username')));
                            echo $this->Form->input('email', array(
                                'label' => __d('users', 'E-mail (used as login)'),
                                'error' => array('isValid' => __d('users', 'Must be a valid email address'),
                                'isUnique' => __d('users', 'An account with that email already exists'))));
                            echo $this->Form->input('password', array(
                                'label' => __d('users', 'Password'),
                                'type' => 'password'));
                            echo $this->Form->input('temppassword', array(
                                'label' => __d('users', 'Password (confirm)'),
                                'type' => 'password'));
                            $tosLink = $this->Html->link(__d('users', 'Terms of Service'), array('controller' => 'pages', 'action' => 'tos', 'plugin' => null));
                            echo $this->Form->input('tos', array(
                                'label' => __d('users', 'I have read and agreed to ') . $tosLink));

                            echo $this->Form->submit(__d('paxapos', 'Crear cuenta PaxaPos'), array('class'=>'btn btn-primary btn-block'));
                            echo $this->Form->end();
                        ?>
                        <br>
                    </fieldset>
                </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>