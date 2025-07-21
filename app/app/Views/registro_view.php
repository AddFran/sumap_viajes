<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #002244;
            --primary-base: #003366;
            --primary-light: #1c87ff;
            --text-light: #f8f9fa;
            --text-muted: #adb5bd;
            --bg-dark: #0a192f;
            --card-bg: rgba(255, 255, 255, 0.05);
            --border-radius: 12px;
        }
        
        body, html {
            height: 100%;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, var(--bg-dark), #001a33);
            color: var(--text-light);
            margin: 0;
            padding: 0;
        }


        option{
            color: #000;
        }
        /* Contenedor principal fijo */
        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 20px;
        }

        /* Contenedor interno con tamaño fijo */
        .register-wrapper {
            width: 900px; /* Ancho fijo */
            display: flex;
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Sección del logo */
        .logo-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-base));
        }

        .register-logo {
            width: 180px;
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
            transition: transform 0.3s ease;
        }

        .register-logo:hover {
            transform: scale(1.05);
        }

        /* Sección del formulario */
        .form-section {
            flex: 1;
            padding: 50px;
            padding-top: 100px;
            background: rgba(10, 25, 47, 0.8);
        }

        /* Título */
        .register-title {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            font-size: 1.8rem;
            position: relative;
        }

        .register-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--primary-light);
            margin: 15px auto 0;
            border-radius: 3px;
        }

        /* Campos del formulario */
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            color: var(--text-light);
            padding: 12px 15px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.25rem rgba(28, 135, 255, 0.25);
            color: var(--text-light);
        }

        .form-label {
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 8px;
        }

        /* Botón */
        .btn-primary {
            background: var(--primary-base);
            border: none;
            border-radius: var(--border-radius);
            padding: 12px;
            font-weight: 500;
            letter-spacing: 0.5px;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(28, 135, 255, 0.3);
        }

        /* Enlaces */
        .register-links {
            text-align: center;
            margin-top: 25px;
            color: var(--text-muted);
        }

        .register-links a {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
            margin: 0 8px;
        }

        .register-links a:hover {
            color: #fff;
            text-decoration: underline;
        }

        /* Mensaje de error */
        .register-error {
            background: rgba(199, 56, 79, 0.2);
            color: #ff6b81;
            border-left: 3px solid #ff6b81;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        /* Pestañas de login/registro */
        .nav-tabs {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 25px;
            margin-top: 10px; /* Ajustamos el margen superior */
            padding-top: 10px; /* Agregamos padding superior */
        }

        .nav-link {
            color: var(--text-muted);
            border: none;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link.active {
            color: var(--primary-light);
            background: transparent;
            border-bottom: 2px solid var(--primary-light);
        }

        .nav-link:hover {
            color: var(--text-light);
            border-color: transparent;
        }

        /* Campo Select con fondo oscuro */
        .form-control[type="select"] {
            background: #0a192f; /* Fondo oscuro */
            border: 1px solid #1c87ff;
        }

        

        /* Responsive */
        @media (max-width: 768px) {
            .register-wrapper {
                flex-direction: column;
                width: 100%;
                max-width: 450px;
            }
            
            .logo-section {
                padding: 30px;
            }
            
            .form-section {
                padding: 30px;
            }
            
            .register-logo {
                width: 120px;
            }
        }
    </style>
</head>
<body>
    <!-- Contenedor principal -->
    <div class="register-container">
        <div class="register-wrapper">
            <!-- Sección del logo -->
            <div class="logo-section">
                <img class="register-logo" src="<?= base_url('upload/logo.png') ?>" alt="Logo">
            </div>
            
            <!-- Sección del formulario -->
            <div class="form-section">
                <h2 class="register-title"> </h2>
                <h2 class="register-title"> </h2>
                <h2 class="register-title">Crear Cuenta</h2>
                
                <!-- Mensaje de éxito -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <!-- Mensaje de error -->
                <?php if (isset($validation)): ?>
                    <div class="register-error">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>
                
                <!-- Formulario de Registro -->
                <form action="<?= base_url('registro/guardar') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= old('nombre') ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="<?= old('correo') ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confirmar_contraseña" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confirmar_contraseña" name="confirmar_contraseña" required>
                    </div>

                    <div class="mb-3">
                        <label for="tipo_cuenta" class="form-label">Tipo de Cuenta</label>
                        <select class="form-control" name="tipo_cuenta" id="tipo_cuenta" required>
                            <option value="">Selecciona</option>
                            <option value="Turista" <?= old('tipo_cuenta') == 'Turista' ? 'selected' : '' ?>>Turista</option>
                            <option value="Comunidad" <?= old('tipo_cuenta') == 'Comunidad' ? 'selected' : '' ?>>Comunidad</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="foto_perfil" class="form-label">Foto de Perfil</label>
                        <input type="file" class="form-control" name="foto_perfil" id="foto_perfil">
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>

                <div class="register-links">
                    <p>¿Ya tienes una cuenta? <a href="<?= base_url('login') ?>">Inicia sesión</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
