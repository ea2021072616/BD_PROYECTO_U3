<?php 
// Incluir el autoload generado por Composer
require_once __DIR__ . '/vendor/autoload.php';  // Asegúrate de que el archivo autoload.php esté en la carpeta vendor

// Configurar tu API Key y autenticación
$PUBLIC_KEY = "pk_test_a6f5009788dc42f7";
$SECRET_KEY = "sk_test_46c76ade66b10214";

// Crear una instancia de Culqi
$culqi = new \Culqi\Culqi(array('api_key' => $SECRET_KEY));

try {
    // Crear el cargo (pago)
    $charge = $culqi->Charges->create(
        array(
            "amount" => 1000,  // Monto en céntimos (S/10.00)
            "currency_code" => "PEN",  // Moneda (PEN = Sol Peruano)
            "description" => "Venta de prueba",  // Descripción del cargo
            "email" => $_POST["email"],  // Correo del cliente
            "source_id" => $_POST["token"]  // Token generado por Culqi
        )
    );

    echo "Pago Exitoso";  // Mostrar mensaje de éxito

} catch (\Exception $e) {
    // Capturar cualquier error y mostrarlo
    echo 'Error: ' . $e->getMessage();
}
?>

//Respuesta
/*print_r($charge);*/