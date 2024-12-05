<?php if(isset($productoUnico)): ?>
    <h1 style="text-align: center;"><?=ucfirst($productoUnico->nombre);?></h1>
    <div class="vista-producto-unico">
    </div>       
<?php else: ?>
    <h1>No se encontró el producto...</h1>
<?php endif; ?>

<div class="contenedor-producto-unico">
    <div class="imagen-destacada-producto" style="background-image: url('<?=base_url?>uploads/images/<?=$productoUnico->imagen;?>');">
    </div>
    <div class="detalles-unico">
    <div class="descripcion">
    <p><?= $productoUnico->descripcion; ?></p>

    <div class="precio-unico">
        <p>s/ <?= $productoUnico->precio; ?></p>
    </div>
        <div class="caracteristicas">
            <h3>Características</h3>
            <ul>
                <?php if (!empty($productoUnico->sistema_operativo)): ?>
                    <li><strong>Sistema Operativo:</strong> <?= $productoUnico->sistema_operativo; ?></li>
                <?php endif; ?>
                <?php if (!empty($productoUnico->ram)): ?>
                    <li><strong>RAM:</strong> <?= $productoUnico->ram; ?></li>
                <?php endif; ?>
                <?php if (!empty($productoUnico->camara_posterior)): ?>
                    <li><strong>Cámara Posterior:</strong> <?= $productoUnico->camara_posterior; ?></li>
                <?php endif; ?>
                <?php if (!empty($productoUnico->camara_frontal)): ?>
                    <li><strong>Cámara Frontal:</strong> <?= $productoUnico->camara_frontal; ?></li>
                <?php endif; ?>
                <?php if (!empty($productoUnico->bateria)): ?>
                    <li><strong>Batería:</strong> <?= $productoUnico->bateria; ?></li>
                <?php endif; ?>
                <?php if (!empty($productoUnico->almacenamiento)): ?>
                    <li><strong>Almacenamiento:</strong> <?= $productoUnico->almacenamiento; ?></li>
                <?php endif; ?>
                <?php if (!empty($productoUnico->pantalla)): ?>
                    <li><strong>Pantalla:</strong> <?= $productoUnico->pantalla; ?></li>
                <?php endif; ?>
                <?php if (!empty($productoUnico->procesador)): ?>
                    <li><strong>Procesador:</strong> <?= $productoUnico->procesador; ?></li>
                <?php endif; ?>
                <?php if (!empty($productoUnico->carga_rapida)): ?>
                    <li><strong>Carga Rápida:</strong> <?= $productoUnico->carga_rapida; ?></li>
                <?php endif; ?>
            </ul>
        </div>

            <button class="boton boton-agregar-carrito"><a href="<?=base_url?>carrito/agregar&id=<?=$productoUnico->id;?>">Añadir al Carrito</a> </button>
        </div>
    </div>

</div>
