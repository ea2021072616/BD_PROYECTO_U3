<?php
// Asegúrate de que la variable $producto_id esté disponible
if (isset($producto_id)) {
    // Puedes cargar los detalles del producto si es necesario
    // $producto = new Producto();
    // $producto->setId($producto_id);
    // $productoDetalles = $producto->obtenerProductoActual();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Promoción</title>
    <link rel="stylesheet" href="path_to_your_css_file.css"> <!-- Asegúrate de agregar tu archivo CSS -->
</head>
<body>
    <div class="container">
        <h1>Agregar Nueva Promoción</h1>

        <?php if (isset($_SESSION['promocion']) && $_SESSION['promocion'] == 'completado'): ?>
            <p style="color: green;">La promoción se ha agregado correctamente.</p>
        <?php elseif (isset($_SESSION['promocion']) && $_SESSION['promocion'] == 'fallido'): ?>
            <p style="color: red;">Hubo un error al agregar la promoción. Por favor, intenta nuevamente.</p>
            <?php unset($_SESSION['promocion']); ?>
        <?php endif; ?>

        <form action="<?= base_url ?>producto/guardar_promocion" method="POST">
            <input type="hidden" name="producto_id" value="<?= $producto_id ?>">

            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" required>
            </div>

            <div class="form-group">
                <label for="fecha_fin">Fecha de Fin:</label>
                <input type="date" name="fecha_fin" id="fecha_fin">
            </div>

            <div class="form-group">
                <label for="descuento_porcentaje">Descuento (%):</label>
                <input type="number" name="descuento_porcentaje" id="descuento_porcentaje" min="0" max="100" required>
            </div>

            <div class="form-group">
                <label for="tipo_promocion_id">Tipo de Promoción:</label>
                <select name="tipo_promocion_id" id="tipo_promocion_id" required>
                    <option value="">Seleccionar...</option>
                    <option value="1">Descuento en porcentaje</option>
                    <option value="2">Descuento fijo</option>
                    <!-- Aquí puedes agregar más tipos de promociones según tu lógica -->
                </select>
            </div>

            <div class="form-group">
                <label for="activo">¿Está activa?</label>
                <input type="checkbox" name="activo" id="activo" checked>
            </div>

            <div class="form-group">
                <button type="submit">Guardar Promoción</button>
            </div>
        </form>

        <a href="<?= base_url ?>producto/ver_promocion&id=<?= $producto_id ?>">Volver al Producto</a>
    </div>

    <script src="path_to_your_js_file.js"></script> <!-- Si necesitas algún JS, como validación o interacción -->
</body>
</html>
