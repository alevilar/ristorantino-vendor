<?php
$flashMes = $this->Session->flash();
$authMes  = $this->Session->flash('auth');          
if ( $flashMes || $authMes ) {
    ?>
<div id="mesajes-container" class="hidden-print">
    <div id="mesajes" class="alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        <?php
        echo $flashMes;
        echo $authMes;       
        ?>
    </div>
</div>

  

<script>
	setTimeout(function(){

		$('#mesajes-container').hide('fade');
	}, 5000);
</script>    
<?php }?>
