<form action="<?= base_url ?>producto/actualizar_promocion" method="POST">
    <input type="hidden" name="id" value="<?= $promocion->id ?>">
    
    <label for="fecha_inicio">Fecha Inicio</label>
    <input type="date" name="fecha_inicio" value="<?= $promocion->fecha_inicio ?>" required>

    <label for="fecha_fin">Fecha Fin</label>
    <input type="date" name="fecha_fin" value="<?= $promocion->fecha_fin ?>">

    <label for="descuento_porcentaje">Descuento (%)</label>
    <input type="number" step="0.01" name="descuento_porcentaje" value="<?= $promocion->descuento_porcentaje ?>" required>

    <label for="tipo_promocion_id">Tipo Promoción</label>
    <select name="tipo_promocion_id" required>
        <option value="1" <?= $promocion->tipo_promocion_id == 1 ? 'selected' : '' ?>>Descuento Directo</option>
        <option value="2" <?= $promocion->tipo_promocion_id == 2 ? 'selected' : '' ?>>Oferta Especial</option>
        <!-- Otros tipos de promoción -->
    </select>

    <label for="activo">Activo</label>
    <input type="checkbox" name="activo" value="1" <?= $promocion->activo ? 'checked' : '' ?>>

    <button type="submit">Guardar Cambios</button>
</form>
