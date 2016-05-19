<div id="loginModal" class="modal fade p-login-box" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title center">Login de Usuario</h4>
      </div>
      <div class="modal-body">
        <div class="p-login center">

            
            <?php
            // box Login OAUTH
            echo $this->element('Users.box_oauth_login'); 
            ?>
            <hr>
            <h2 style="    margin-top: -37px; position: relative;" class="grey">O</h2>
            <?php echo $this->element("Users.boxlogin");?>
            
            <p class="p-new-user">
            <hr>
            <p>Si no tenés cuenta. ¡Empezá a usarlo!</p>
            <?php
             echo $this->Html->link('Registrate acá.',
                array('plugin'=>'users', 'controller'=>'users', 'action'=>'login'),
                array(
                    'class'=>'btn btn-success btn-sm btn-block')
                );
            ?>
            </p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>