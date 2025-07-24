<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta Suspendida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
            --danger-color: #dc3545;
            --warning-color: #ffc107;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, var(--bg-dark), #001a33);
            color: var(--text-light);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* Header estilo consistente */
        .main-header {
            background: rgba(10, 25, 47, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-img {
            height: 40px;
            margin-right: 15px;
        }

        /* Contenido principal */
        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            min-height: calc(100vh - 72px); /* Resta la altura del header */
        }

        .suspended-card {
            background: rgba(10, 25, 47, 0.9);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px;
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        .suspended-icon {
            font-size: 4rem;
            color: var(--danger-color);
            margin-bottom: 20px;
        }

        h1 {
            color: var(--danger-color);
            font-weight: 600;
            margin-bottom: 20px;
        }

        p {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn-suspended {
            background-color: var(--primary-base);
            color: var(--text-light);
            border: none;
            padding: 12px 25px;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-suspended:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(28, 135, 255, 0.2);
            color: var(--text-light);
        }

        .contact-link {
            color: var(--primary-light);
            text-decoration: none;
            transition: all 0.2s;
        }

        .contact-link:hover {
            color: var(--warning-color);
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .main-header {
                flex-direction: column;
                padding: 15px;
                gap: 15px;
            }
            
            .suspended-card {
                padding: 30px 20px;
            }
            
            .suspended-icon {
                font-size: 3rem;
            }
            
            h1 {
                font-size: 1.8rem;
            }
            
            p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header consistente con tus otras páginas -->
    <header class="main-header">
        <div class="logo-container">
            <img class="logo-img" src="<?= base_url('upload/logo.png') ?>" alt="Logo">
        </div>
        
        <div class="user-profile">
            <div>
                <div class="user-name">Cuenta Suspendida</div>
                <div class="user-type">Estado de cuenta</div>
            </div>
        </div>
    </header>

    <!-- Contenido principal centrado verticalmente -->
    <main class="main-content">
        <div class="suspended-card">
            <div class="suspended-icon">
                <i class="bi bi-slash-circle-fill"></i>
            </div>
            <h1>Tu cuenta ha sido suspendida</h1>
            <p>
                Tu cuenta ha sido suspendida temporalmente debido a muchos reportes. 
                Si crees que esto es un error o deseas más información, por favor contacta a nuestro equipo de soporte 
                a través de <a href="" class="contact-link">soporte@sumaqviajes.com</a>.
            </p>
            <a href="<?= base_url('/logout') ?>" class="btn btn-suspended">
                <i class="bi bi-box-arrow-left"></i> Cerrar Sesión.
            </a>
        </div>
    </main>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>