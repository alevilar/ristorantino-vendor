<?php
$flashMes = $this->Session->flash();
$authMes  = $this->Session->flash('auth');          
if ( $flashMes || $authMes ) {
    ?>
<div class="fluid-container hidden-print">
    <div class="row">
        <div id="mesajes" class="col-md-12" role="alert">
            <?php
            echo $flashMes;
            echo $authMes;       
            ?>
        </div>
    </div>
</div>
<?php }?>
