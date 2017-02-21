<div class="content-white">



<h1 class="center"><?php echo __("Detalles de Mercadería") ?></h1>


<h3 class="grey pull-right"><?php echo __("Proveedor por defecto: %s",$mercaderia['Proveedor']['name']); ?> </h3>

<h2><?php echo $mercaderia['Mercaderia']['name']; ?></h2>

<div class="btn-group">

<?php echo $this->Html->link('Editar', array('action'=>'edit', $mercaderia['Mercaderia']['id']), array('class'=>'btn btn-default btn-edit'));?>

<?php echo $this->Html->link(__('Borrar'), array('action'=>'delete',  $mercaderia['Mercaderia']['id']), array('class'=>'btn btn-danger'), sprintf(__('Seguro que querés borrar # %s?'), $mercaderia['Mercaderia']['name'])); ?>

<?php          
     if( count($mercaDuplicadosList) > 0) { 
          if ( count($mercaDuplicadosList) > 1) {
               $txt = 'Existen %s duplicados';
          } else {
               $txt = 'Existe %s duplicado';
          }
	    echo $this->Html->link(
               __($txt, count($mercaDuplicadosList) ), 
	          array(
                    'action'=>'ver_duplicados',
	               $mercaderia['Mercaderia']['id'],
               ),
	          array('class'=>'btn btn-primary')
          );
    }

?>

</div>


<?php 

if (count($pedidos)) {
     echo $this->element("Compras.pedido_mercaderia_list");
} else {
     ?>
     <br><br><br>
     <div class="row">
          <div class="alert alert-warning col-sm-6 col-sm-offset-3 center">
               <?php echo __("Aún no existen pedidos realizados para esta mercadería"); ?></div>
     </div>

     <?php
}
?>

<center><?php echo $this->Html->link('Volver a la lista de mercaderías', array('action'=>'index'), array('class'=>'btn btn-default'));?></center>

</div>