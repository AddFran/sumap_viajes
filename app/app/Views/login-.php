<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - SUMAQ VIAJES</title>
    <style>
        /* Estilo general del body */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #96AFFF, #7A8AFF);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Contenedor del logo */
        .logo-container {
            width: 100%;
            max-width: 400px; /* Mismo ancho máximo que el formulario */
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        /* Estilo del logo */
        .logo {
            width: 60%; /* Ajusta este porcentaje para hacerlo más pequeño (60% del contenedor) */
            max-width: 240px; /* Ancho máximo más pequeño */
        }

        .logo img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Estilo del contenedor principal */
        .container {
            width: 100%;
            max-width: 400px;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 26px;
            margin-bottom: 30px;
        }

        /* Estilo para los labels */
        label {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        /* Estilo para los inputs */
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background-color: #fafafa;
            box-sizing: border-box;
        }

        /* Estilo para el botón */
        button {
            width: 100%;
            background-color: #96AFFF;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #7a8aff;
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            .logo-container {
                max-width: 90%;
            }

            .logo {
                width: 50%;
                max-width: 200px;
            }

            h2 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <div class="logo">
            <img src="<?= base_url('upload/logo.png') ?>" alt="Logo SUMAQ VIAJES">
        </div>
    </div>

    <div class="container">
        <h2>Iniciar sesión - SUMAQ VIAJES</h2>
        <form action="<?= base_url('usuarios/login') ?>" method="post">
            <label for="email">Correo</label>
            <input type="email" name="email" required>

            <label for="password">Contraseña</label>
            <input type="password" name="password" required>

            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>