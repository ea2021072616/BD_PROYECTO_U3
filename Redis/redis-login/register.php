<?php
include 'redis.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);

    if (empty($nombre) || empty($apellido) || empty($correo) || empty($clave)) {
        die('Por favor, completa todos los campos.');
    }

    $redis = connectRedis();

    // Verificar si el correo ya existe
    if ($redis->exists("user:$correo")) {
        die('El correo ya está registrado.');
    }

    // Guardar usuario
    $redis->hMSet("user:$correo", [
        'nombre' => $nombre,
        'apellido' => $apellido,
        'correo' => $correo,
        'clave' => $clave
    ]);

    echo 'Usuario registrado con éxito.';
} else {
    echo 'Método no permitido.';
}
?>
