<?php
function connectRedis() {
    $redis = new Redis();
    try {
        $redis->connect('127.0.0.1', 6379); // Conecta a Redis en localhost y puerto 6379
        return $redis;
    } catch (Exception $e) {
        die('Error de conexión a Redis: ' . $e->getMessage());
    }
}
?>
