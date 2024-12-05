<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .container h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            background: #3498db;
            border: none;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #2980b9;
        }
        .toggle-link {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #3498db;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistema de Login</h1>

        <div id="register-form" style="display: none;">
            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu apellido" required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" id="correo" name="correo" placeholder="Ingresa tu correo" required>
                </div>
                <div class="form-group">
                    <label for="clave">Clave</label>
                    <input type="password" id="clave" name="clave" placeholder="Ingresa tu clave" required>
                </div>
                <button type="submit">Registrar</button>
            </form>
            <p class="toggle-link" onclick="toggleForm()">¿Ya tienes cuenta? Inicia sesión aquí</p>
        </div>

        <div id="login-form">
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="correo-login">Correo</label>
                    <input type="email" id="correo-login" name="correo" placeholder="Ingresa tu correo" required>
                </div>
                <div class="form-group">
                    <label for="clave-login">Clave</label>
                    <input type="password" id="clave-login" name="clave" placeholder="Ingresa tu clave" required>
                </div>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <p class="toggle-link" onclick="toggleForm()">¿No tienes cuenta? Regístrate aquí</p>
        </div>
    </div>

    <script>
        function toggleForm() {
            const registerForm = document.getElementById('register-form');
            const loginForm = document.getElementById('login-form');
            if (registerForm.style.display === 'none') {
                registerForm.style.display = 'block';
                loginForm.style.display = 'none';
            } else {
                registerForm.style.display = 'none';
                loginForm.style.display = 'block';
            }
        }

        // Mostrar el formulario de login por defecto
        document.getElementById('login-form').style.display = 'block';
    </script>
</body>
</html>
