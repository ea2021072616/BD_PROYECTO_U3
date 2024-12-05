<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos en Promoción</title>
    <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
</head>
<body>
    <h1>Productos en Promoción</h1>
    <div class="productos-promocion">
        <?php while ($producto = $productos->fetch_object()): ?>
            <div class="producto">
                <!-- Etiqueta PROMO -->
                <?php if ($producto->descuento_porcentaje > 0): ?>
                    <div class="producto-promocion">
                        <span class="promocion-etiqueta">PROMO</span>
                    </div>
                <?php endif; ?>

                <!-- Imagen del producto -->
                <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" alt="<?= $producto->nombre ?>" class="producto-imagen" />
                
                <div class="producto-detalles">
                    <!-- Nombre del producto -->
                    <h2 class="producto-nombre"><?= $producto->nombre ?></h2>
                    
                    <!-- Descripción del producto -->
                    <p class="producto-descripcion"><?= $producto->descripcion ?></p>
                    
                    <!-- Precio y descuento -->
                    <p class="producto-precio">Precio: $<?= $producto->precio ?></p>
                    <p class="producto-descuento">Descuento: <?= $producto->descuento_porcentaje ?>%</p>
                    
                    <!-- Enlace para ver más detalles -->
                    <p><a class="producto-enlace" href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>">Ver más detalles</a></p>
                    
                    <!-- Botón para redirigir a producto único -->
                    <p><a class="boton boton-ver-mas" href="<?= base_url ?>producto/productoUnico&id=<?= $producto->id ?>">Ver más</a></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
