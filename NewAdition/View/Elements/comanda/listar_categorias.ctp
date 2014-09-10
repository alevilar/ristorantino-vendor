<?php
$catId = $categoria['Categoria']['id'];
$catName = $categoria['Categoria']['name'];
?>
<button id='categoria-id-<?php echo $catId ?>' value="<?php echo $catId ?>" class="btn btn-primary">
    <?php echo $catName ?>
</button>

<?php if ( !empty($categoria['Hijos']) ) { ?>
    <div class="body" id='categoria-hijos-<?php echo $catId ?>' style="display:none">
    <?php
        foreach ($categoria['Hijos'] as $c) {
            echo $this->element('comanda/listar_categorias', array('categoria' => $c));
        }
    ?>
    </div>
<?php } ?>

