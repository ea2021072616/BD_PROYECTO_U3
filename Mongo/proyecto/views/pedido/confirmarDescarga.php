<?php $ultimoPedido = $pedidoDescarga->fetch_object(); ?>

<!-- Incluir Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    /* Estilos Generales */
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
        color: #333;
    }

    .container {
        width: 100%;
        max-width: 900px;
        margin: 30px auto;
        padding: 40px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Header de la Empresa */
    .header {
        background-color: #34495e; /* Gris oscuro */
        color: white;
        padding: 5px 0; /* Reducir padding a 5px arriba y abajo */
        text-align: center;
        font-size: 12px; /* Reducir tamaño de fuente a 12px */
        border-radius: 6px; /* Bordes más suaves */
        margin-bottom: 10px; /* Reducir margen inferior */
    }

    .header p {
        margin: 5px 0;
        font-weight: bold;
    }

    .header i {
        margin-right: 8px;
    }

    h1 {
        font-size: 32px;
        color: #e67e22; /* Naranja */
        text-align: center;
        margin-bottom: 20px;
        font-weight: 700;
    }

    hr {
        margin: 20px auto;
        border: 0;
        border-top: 3px solid #f1c40f; /* Dorado */
        width: 80%;
    }

    /* Logo de la Empresa */
    .logo {
        width: 160px;
        display: block;
        margin: 20px auto 40px;
    }

    /* Detalles del Pedido */
    p {
        font-size: 16px;
        margin: 15px 0;
        line-height: 1.6;
    }

    span {
        font-weight: bold;
        color: #2980b9; /* Azul */
    }

    .grupo-producto {
        margin-bottom: 30px;
        padding-bottom: 30px;
        border-bottom: 2px solid #ecf0f1;
    }

    .grupo-producto h2 {
        font-size: 24px;
        color: #34495e;
        margin-bottom: 20px;
    }

    .grupo-producto h4 {
        color: #e67e22;
        font-size: 18px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .grupo-producto ul {
        list-style-type: none;
        padding: 0;
    }

    .grupo-producto ul li {
        font-size: 16px;
        margin-bottom: 8px;
        padding-left: 20px;
        position: relative;
    }

    .grupo-producto ul li::before {
        content: "\2022";
        color: #f39c12; /* Naranja oscuro */
        position: absolute;
        left: 0;
        top: 0;
        font-size: 18px;
    }

    .grupo-producto a {
        color: #e67e22;
        text-decoration: none;
        font-weight: 600;
    }

    .grupo-producto a:hover {
        color: #d35400;
        text-decoration: underline;
    }

    /* Footer */

    .footer {
        background-color: #34495e; /* Gris oscuro */
        color: white;
        padding: 5px 0; /* Reducir padding a 5px arriba y abajo */
        margin-top: 15px; /* Reducir margen superior */
        text-align: center;
        font-size: 12px; /* Reducir tamaño de fuente a 12px */
        border-radius: 6px; /* Bordes más suaves */
    }

    .footer p {
        margin: 5px 0;
    }

    .footer i {
        margin-right: 8px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
            width: 90%;
        }

        h1 {
            font-size: 28px;
        }

        .grupo-producto h4 {
            font-size: 16px;
        }

        .grupo-producto ul li {
            font-size: 14px;
        }
    }
</style>

<div class="container">
    <!-- Header de la Empresa -->
    <div class="header">
        <p><i class="fas fa-store"></i> RUC: 20609683415</p>
        <p><i class="fas fa-building"></i> Razón Social: MIJO STORE E.I.R.L.</p>
        <p><i class="fas fa-cogs"></i> Tipo de Empresa: Empresa Individual de Responsabilidad Limitada</p>
        <p><i class="fas fa-check-circle"></i> Condición: Activo</p>
        <p><i class="fas fa-calendar-day"></i> Fecha Inicio Actividades: 06 / Julio / 2022</p>
        <p><i class="fas fa-shopping-cart"></i> Actividad Comercial: Comercio al por menor de productos alimenticios</p>
    </div>

    <!-- Logo de la Empresa -->
    <img src="C:/xampp/htdocs/proyecto/assets/img/logo.png" alt="Logo" class="logo">

    <!-- Detalles de la compra -->
    <h1>Detalles de tu Pedido</h1>
    <hr>

    <p><span>ID del Pedido:</span> <?=$ultimoPedido->id?></p>
    <p><span>Dirección:</span> <?=$ultimoPedido->direccion?>, <?=$ultimoPedido->provincia?>, <?=$ultimoPedido->departamento?></p>
    <p><span>Fecha del Pedido:</span> <?=$ultimoPedido->fecha?></p>
    <p><span>Hora del Pedido:</span> <?=$ultimoPedido->hora?></p>

    <!-- Footer -->
    <div class="footer">
        <p><i class="fas fa-map-marker-alt"></i> Dirección: <?=$ultimoPedido->direccion?>, <?=$ultimoPedido->provincia?>, <?=$ultimoPedido->departamento?></p>
        <p><i class="fas fa-phone"></i> Teléfono: 01-23456789</p>
        <p><i class="fas fa-envelope"></i> Email: contacto@mijostore.com</p>
    </div>
</div>
