<?php
// Usar una ruta absoluta basada en DOCUMENT_ROOT
require_once 'config/db.php';  // Asegúrate de que la ruta sea correcta

// Obtener la conexión a la base de datos
$db = Database::conexion();  // Llamar al método estático para obtener la conexión

// Verificar si la conexión fue exitosa
if (!$db) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>

<div class="contenedor-carrito">
    <h1 style="text-align: center">Carrito</h1>
    <div class="alinear-tabla">
        <button class="boton">
            <a href="<?=base_url?>carrito/eliminar">Vaciar Carrito</a> 
        </button>
    </div>
    <table style="margin-bottom: 20px;">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Eliminar</th>
        </tr>
        <?php if(isset($carrito)):
            foreach($carrito as $indice => $producto): 
                $item = $producto['producto']; 

                // Verificar si el producto está en promoción
                $descuento = 0;
                $productoPromocion = $db->query("SELECT descuento_porcentaje FROM promocion WHERE producto_id = {$item->id} AND activo = 1 AND CURDATE() BETWEEN fecha_inicio AND IFNULL(fecha_fin, CURDATE()) LIMIT 1");
                
                if ($productoPromocion && $productoPromocion->num_rows > 0) {
                    $promo = $productoPromocion->fetch_assoc();
                    $descuento = $promo['descuento_porcentaje'];
                }

                // Calcular precio con descuento
                $precioFinal = $item->precio * (1 - ($descuento / 100)); 

                // Verificar el stock disponible
                $stockDisponible = $db->query("SELECT stock FROM producto WHERE id = {$item->id}");
                $stock = 0;
                if ($stockDisponible && $stockDisponible->num_rows > 0) {
                    $stockData = $stockDisponible->fetch_assoc();
                    $stock = $stockData['stock'];
                }

                // Limitar la cantidad a 10 o el stock disponible
                $maxUnidadesPermitidas = min(10, $stock);
                
                // Si el usuario intenta agregar más de 10 unidades, limitar
                if ($_SESSION['carrito'][$indice]['unidades'] > $maxUnidadesPermitidas) {
                    $_SESSION['carrito'][$indice]['unidades'] = $maxUnidadesPermitidas; // Limitar a 10 o al stock disponible
                    $mensajeStock = "¡Solo hay $maxUnidadesPermitidas unidades disponibles!";
                } else {
                    $mensajeStock = "";
                }
            ?>
            <tr>
                <td>
                    <img width="115px;" src="<?=base_url?>uploads/imageS/<?=$item->imagen?>" alt="imagen del producto"> 
                </td>
                <td>
                    <a href="<?=base_url?>producto/productoUnico&id=<?=$item->id?>"><?= $item->nombre; ?></a>
                </td>
                <td>
                    <?php if ($descuento > 0): ?>
                        <span style="text-decoration: line-through; color: red;">S/. <?= $item->precio ?></span> 
                        <span>S/. <?= number_format($precioFinal, 2, '.', '') ?></span>
                    <?php else: ?>
                        S/. <?= $item->precio ?>
                    <?php endif; ?>
                </td>
                <td>
                    <fieldset class="control-unidades-carrito">
                        <button class="boton-disminuir menos" type="button" onclick="location.href='<?=base_url?>carrito/reducir&indice=<?=$indice?>'">-</button>
                        <input type="text" name="cantidad" value="<?= $_SESSION['carrito'][$indice]['unidades']?>" readonly />
                        <button class="boton-aumentar mas" type="button" onclick="location.href='<?=base_url?>carrito/aumentar&indice=<?=$indice?>'">+</button>
                    </fieldset>                    
                    <?php if ($mensajeStock): ?>
                        <p style="color: red; font-size: 12px;"><?= $mensajeStock ?></p>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?=base_url?>carrito/quitar&indice=<?=$indice?>">
                        <i class="icono-borrar fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach;
        endif;
        ?>
    </table>

    <?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) : ?>
        <div class="alinear-tabla total">
            <h3>Total:</h3>
            <?php 
                $valores = Utilidades::valoresCarrito(); 
                $totalConDescuento = 0;
                foreach ($_SESSION['carrito'] as $indice => $producto) {
                    $item = $producto['producto'];
                    $descuento = 0;
                    $productoPromocion = $db->query("SELECT descuento_porcentaje FROM promocion WHERE producto_id = {$item->id} AND activo = 1 AND CURDATE() BETWEEN fecha_inicio AND IFNULL(fecha_fin, CURDATE()) LIMIT 1");

                    if($productoPromocion && $productoPromocion->num_rows > 0) {
                        $promo = $productoPromocion->fetch_assoc();
                        $descuento = $promo['descuento_porcentaje'];
                    }

                    $precioFinal = $item->precio * (1 - ($descuento / 100)); 
                    $totalConDescuento += $precioFinal * $_SESSION['carrito'][$indice]['unidades'];
                }
            ?>
            <p>s/ <?=number_format($totalConDescuento, 2, '.', '');?></p>
        </div>
        <div class="alinear-tabla">
        <!-- Formulario para enviar el total al controlador -->
        <form action="<?= base_url ?>pedido/pedido" method="POST">
            <!-- Aquí pasamos el total como campo oculto -->
            <input type="hidden" name="total" value="<?= number_format($totalConDescuento, 2, '.', '') ?>" />
            <button class="boton" type="submit">
                Procesar Pago
            </button>
        </form>
        </div>
    <?php endif; ?>
</div>
