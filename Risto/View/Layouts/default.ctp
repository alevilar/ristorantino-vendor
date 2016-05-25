<?php $this->extend('Risto.base'); ?>


<?php $this->start('header-nav'); ?>
    <div class="navbar-right" aria-expanded="false">
        <?php echo $this->element('Risto.user_login_nav'); ?>
    </div>
<?php $this->end();?>



<?php echo $this->fetch('content');?>