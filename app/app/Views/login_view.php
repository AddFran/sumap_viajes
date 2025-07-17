<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600&display=swap" rel="stylesheet">
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

        /* Contenedor principal fijo */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 20px;
        }

        /* Contenedor interno con tamaño fijo */
        .login-wrapper {
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

        .login-logo {
            width: 180px;
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
            transition: transform 0.3s ease;
        }

        .login-logo:hover {
            transform: scale(1.05);
        }

        /* Sección del formulario */
        .form-section {
            flex: 1;
            padding: 50px;
            background: rgba(10, 25, 47, 0.8);
        }

        /* Título */
        .login-title {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            font-size: 1.8rem;
            position: relative;
        }

        .login-title::after {
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
        .login-links {
            text-align: center;
            margin-top: 25px;
            color: var(--text-muted);
        }

        .login-links a {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
            margin: 0 8px;
        }

        .login-links a:hover {
            color: #fff;
            text-decoration: underline;
        }

        /* Mensaje de error */
        .login-error {
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

        /* Responsive */
        @media (max-width: 768px) {
            .login-wrapper {
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
            
            .login-logo {
                width: 120px;
            }
        }
    </style>
</head>
<body>
    <!-- Contenedor principal -->
    <div class="login-container">
        <div class="login-wrapper">
            <!-- Sección del logo -->
            <div class="logo-section">
                <img class="login-logo" src="<?= base_url('upload/logo.png') ?>" alt="Logo">
            </div>
            
            <!-- Sección del formulario -->
            <div class="form-section">
                
                <h2 class="login-title">Iniciar Sesión</h2>
                
                <!-- Mensaje de error -->
                <?php if (isset($error)): ?>
                    <div class="login-error">
                        <?= esc($error) ?>
                    </div>
                <?php endif; ?>
                
                <!-- Formulario de Login -->
                <form action="<?= base_url('auth/login_process') ?>" method="post">
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </form>
                
                <div class="login-links">
                    <p>¿No tienes una cuenta? <a href="<?= base_url('registro') ?>">Regístrate aquí</a></p>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>