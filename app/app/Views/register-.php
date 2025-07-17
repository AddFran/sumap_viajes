<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - SUMAQ VIAJES</title>
    <style>
        /* Estilos generales */
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
            max-width: 450px; /* Mismo ancho máximo que el formulario */
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        /* Estilo del logo */
        .logo {
            width: 60%; /* Tamaño reducido */
            max-width: 270px; /* 60% de 450px */
        }

        .logo img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Contenedor del formulario */
        .container {
            width: 100%;
            max-width: 450px;
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
        input[type="text"], input[type="email"], input[type="password"], select, input[type="file"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background-color: #f9f9f9;
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
            margin-top: 10px;
        }

        button:hover {
            background-color: #7a8aff;
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .logo-container {
                max-width: 90%;
            }
            
            .logo {
                width: 50%;
                max-width: 200px;
            }
            
            .container {
                width: 90%;
                padding: 20px;
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
        <h2>Registro de Usuario</h2>
        <!-- Formulario de registro -->
        <form action="<?= base_url('usuarios/create') ?>" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required>

            <label for="email">Correo</label>
            <input type="email" name="email" required>

            <label for="password">Contraseña</label>
            <input type="password" name="password" required>

            <label for="tipo_usuario">Tipo de usuario</label>
            <select name="tipo_usuario" required>
                <option value="turista">Turista</option>
                <option value="comunidad">Comunidad</option>
            </select>

            <label for="foto_perfil">Foto de perfil</label>
            <input type="file" name="foto_perfil">

            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>