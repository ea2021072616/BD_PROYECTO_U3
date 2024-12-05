<?php if(!isset($_SESSION['identity'])): ?>
    <h3 class="alinear-tabla">¡Por favor, inicia sesión para completar tu compra!</h3>
<?php else: ?>
    <div class="alinear-tabla">
        <button class="boton"><a href="<?=base_url?>/carrito/index">Regresar al Carrito</a></button>
    </div>

    <h1 class="texto-centrado">Formulario de Pedido</h1>

    <!-- Mostrar el total calculado del pedido -->
    <div class="total-pedido alinear-tabla">
        <h3>Total de la Orden:</h3>
        <p><strong>s/ <?= number_format($total, 2, '.', '') ?></strong></p> <!-- Total del pedido -->
    </div>

    <div class="formulario-pedido alinear-tabla">
        <form id="form-pedido" action="<?=base_url?>/pedido/agregar" method="POST">
            <div class="grupo-formulario">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion">
            </div>
            <div class="grupo-formulario">
                <label for="provincia">Ciudad:</label>
                <input type="text" name="provincia" id="provincia">
            </div>
            <div class="grupo-formulario">
                <label for="departamento">Departamento:</label>
                <input type="text" name="departamento" id="departamento">
            </div>

            <!-- Campo oculto para el token de pago -->
            <input type="hidden" name="payment_token" id="payment_token">

            <!-- Campo oculto para el total de la compra -->
            <input type="hidden" name="total" value="<?= $total ?>">

            <!-- Botón de pago -->
            <button type="button" id="btn_pagar" class="boton">Comprar Ahora</button>
        </form>
    </div>
<?php endif; ?>

<script src="https://checkout.culqi.com/js/v4"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Configura tu clave pública de Culqi
    Culqi.publicKey = 'pk_test_a6f5009788dc42f7'; // Asegúrate de usar tu clave pública real

    // Botón de pago
    const btn_pagar = document.getElementById('btn_pagar');
    btn_pagar.addEventListener('click', function (e) {
        // Obtener el monto total (en céntimos)
        const total = <?= $total ?> * 100; // Convertir a céntimos

        // Configuración de Culqi
        Culqi.settings({
            title: 'Culqi Store',
            currency: 'PEN',
            amount: total, // Monto en céntimos (S/. <?= number_format($total, 2, '.', '') ?>)
        });

        // Opciones adicionales (opcional)
        Culqi.options({
            lang: "es",
            paymentMethods: {
                tarjeta: true,
                yape: true,
                bancaMovil: true,
                agente: true,
                billetera: true,
                cuotealo: true,
            },
            style: {
                logo: "https://static.culqi.com/v2/v2/static/img/logo.png",
            }
        });

        Culqi.open(); // Abre el formulario de Culqi
        e.preventDefault();
    });

    // Función que procesa el token generado
    function culqi() {
        if (Culqi.token) {
            const token = Culqi.token.id;
            const email = Culqi.token.email;

            console.log('Token generado: ', token);

            // Asigna el token al campo oculto del formulario
            document.getElementById('payment_token').value = token;

            // Ahora, envía el formulario con el token al servidor
            document.getElementById('form-pedido').submit(); // Envía el formulario con el token
        } else {
            console.error("Error en Culqi: ", Culqi.error);
            alert("Ocurrió un error al generar el token: " + Culqi.error.merchant_message);
        }
    }

    // Llamada a la función `culqi` después de que se genere el token
    Culqi.callback = culqi;
</script>
