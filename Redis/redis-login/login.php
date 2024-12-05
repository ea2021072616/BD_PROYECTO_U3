<?php
include 'redis.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    if (empty($correo) || empty($clave)) {
        die('Por favor, completa todos los campos.');
    }

    $redis = connectRedis();

    // Verificar si el correo existe
    if (!$redis->exists("user:$correo")) {
        die('Correo no registrado.');
    }

    // Obtener datos del usuario
    $user = $redis->hGetAll("user:$correo");

    // Verificar contraseña
    if (password_verify($clave, $user['clave'])) {
        echo 'Inicio de sesión exitoso. Bienvenido, ' . $user['nombre'] . ' ' . $user['apellido'] . '!';
    } else {
        echo 'Contraseña incorrecta.';
    }
} else {
    echo 'Método no permitido.';
}
?>
