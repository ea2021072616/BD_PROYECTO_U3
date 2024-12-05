<div class="contenedor-ver-imagenes">
    <h2>Imágenes de <?= $productoUnico->nombre; ?></h2>

    <!-- Mostrar las imágenes existentes -->
    <?php if ($imagenes && count($imagenes) > 0): ?>
        <div class="galeria-imagenes">
            <?php foreach ($imagenes as $imagen): ?>
                <div class="imagen-item">
                    <!-- Mostrar la imagen actual -->
                    <img src="<?= base_url ?>uploads/images/<?= $imagen['imagen_url']; ?>" alt="Imagen del producto" style="width: 200px; height: auto; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    
                    <!-- Formulario para cambiar la imagen -->
                    <form action="<?= base_url ?>producto/guardar_o_editar_imagen" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="producto_id" value="<?= $productoUnico->id ?>">
                        <input type="hidden" name="imagen_id" value="<?= $imagen['id'] ?>">

                        <!-- Input para seleccionar una nueva imagen (opcional) -->
                        <div>
                            <label for="imagen">Seleccionar nueva imagen:</label>
                            <input type="file" name="imagen">
                        </div>

                        <button type="submit">Cambiar Imagen</button>
                    </form>

                    <!-- Formulario para eliminar la imagen -->
                    <form action="<?= base_url ?>producto/eliminar_imagen" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta imagen?');">
                        <input type="hidden" name="imagen_id" value="<?= $imagen['id'] ?>">
                        <input type="hidden" name="producto_id" value="<?= $productoUnico->id ?>">

                        <button type="submit" style="background-color: red; color: white;">Eliminar Imagen</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No hay imágenes para este producto.</p>
    <?php endif; ?>

    <!-- Formulario para agregar una nueva imagen -->
    <h3>Agregar Nueva Imagen</h3>
    <form action="<?= base_url ?>producto/guardar_o_editar_imagen" method="POST" enctype="multipart/form-data">
        <!-- Campo oculto para el ID del producto -->
        <input type="hidden" name="producto_id" value="<?= $productoUnico->id; ?>">

        <!-- Campo para seleccionar una nueva imagen -->
        <div>
            <label for="imagen">Seleccionar imagen:</label>
            <input type="file" name="imagen" required>
        </div>

        <button type="submit">Agregar Imagen</button>
    </form>
</div>
