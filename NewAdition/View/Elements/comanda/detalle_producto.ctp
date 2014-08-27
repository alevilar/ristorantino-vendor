<?php foreach ($productos as $p) { ?>
    <div id="detalle_producto_<?php echo $p['Producto']['id'] ?>" class="producto" style="display: none">
        <h2><?php echo $p['Producto']['name']; ?></h2>
        <button class="duplicar-pedido">Agregar Pedido Diferente</button>
        
        <form data-ajax="false">
            <input type="hidden" name="producto_id" value="<?php echo $p['Producto']['id']?>" />
            
            <label for="cantidad">Cantidad:</label>
            <input type="number" value="0" name="cantidad" />

            <br>
            <label for="observacion">Observación:</label>
            <textarea name="observacion" placeholder="Ingrese una observación..."></textarea>

            <br>
            <label for="es_entrada">Es Entrada:</label>
            <select name="es_entrada" data-role="slider">
                <option value="0">No</option>
                <option value="1">Si</option>
            </select> 

            <br>
            <div>    
                <?php
                foreach ($p['GrupoSabor'] as $gs) {
                    if (count($gs['Sabor']) > 5) {
                        echo "<h3>" . $gs['name'] . "</h3>";
                        ?>
                        <select multiple name="<?php echo "grupo_id_" . $gs['id'] ?>">
                            <?php
                            foreach ($gs['Sabor'] as $sabor) {
                                ?>
                                <option value="<?php echo $sabor['id'] ?>"><?php echo $sabor['name'] ?></option>
                                <?
                            }
                            ?>
                        </select> 
                        <?php
                    } else {
                        ?>
                        <fieldset data-role="controlgroup" data-type="horizontal">
                            <legend><?php echo $gs['name'] ?></legend>
                            <?php
                            foreach ($gs['Sabor'] as $sabor) {
                                ?>
                                <input type="checkbox"  id="<?php echo $p['Producto']['id'] . "_grupo_sabor_" . $gs['id'] . "_sabor_" . $sabor['id'] ?>" name="<?php "_grupo_sabor_" . $gs['id'] ?>" value="<?php echo $sabor['id'] ?>" />
                                <label for="<?php echo $p['Producto']['id'] . "_grupo_sabor_" . $gs['id'] . "_sabor_" . $sabor['id'] ?>" ><?php echo $sabor['name'] ?></label>
                                <?
                            }
                            ?>
                        </fieldset>
                        <?php
                    }
                }
                ?>
            </div>

            <input type="button" value="Cancelar Pedido" class="cancelar-pedido"/>
        </form>
    </div>
    <?php
}     