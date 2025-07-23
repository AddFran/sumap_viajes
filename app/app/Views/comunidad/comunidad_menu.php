<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Comunidad</title>
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
        
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, var(--bg-dark), #001a33);
            color: var(--text-light);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* Header estilo similar al login */
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

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-name {
            font-weight: 500;
            color: var(--text-light);
        }

        .user-type {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* Contenido principal */
        .main-content {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .panel-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .panel-title {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        .panel-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--primary-light);
            position: absolute;
            bottom: 0;
            left: 0;
            border-radius: 3px;
        }

        /* Botones */
        .btn-primary {
            background: var(--primary-base);
            border: none;
            border-radius: var(--border-radius);
            padding: 12px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(28, 135, 255, 0.3);
        }

        .btn-outline-primary {
            border-color: var(--primary-base);
            color: var(--primary-light);
        }

        .btn-outline-primary:hover {
            background: rgba(28, 135, 255, 0.1);
            border-color: var(--primary-light);
            color: var(--text-light);
        }

        .btn-danger {
            border-radius: var(--border-radius);
        }

        
<style>
    .feature-card {
        background: rgba(0, 51, 102, 0.2);
        border: 1px solid rgba(28, 135, 255, 0.2);
        transition: all 0.3s ease;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        border-color: var(--primary-light);
    }
    
    .feature-icon {
        color: white;
        transition: all 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
        background: var(--primary-light) !important;
        transform: rotate(10deg);
    }
    
    .btn-light {
        background: rgba(255, 255, 255, 0.9);
        color: var(--primary-base);
        font-weight: 500;
    }
    
    .btn-light:hover {
        background: white;
        color: var(--primary-dark);
    }

    
        /* Responsive */
        @media (max-width: 768px) {
            .main-header {
                flex-direction: column;
                padding: 15px;
                text-align: center;
            }
            
            .logo-container {
                margin-bottom: 15px;
            }
            
            .user-profile {
                flex-direction: column;
                gap: 5px;
            }
            
            .main-content {
                padding: 20px;
            }
        }
</style>

</head>
<body>
    <!-- Header fijo -->
    <header class="main-header">
        <div class="logo-container">
            <img class="logo-img" src="<?= base_url('upload/logo.png') ?>" alt="Logo">
        </div>
        
        <!-- Sección del usuario -->
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name"><?= session()->get('nombre'); ?></div>
                <div class="user-type">Cuenta Comunidad</div>
            </div>
        </div>

        <!-- Nueva sección de enlaces alineados a la derecha -->
        <div class="admin-navigation ms-auto">
            <a href="<?= base_url('/comunidad/menu') ?>" class="btn btn-outline-light">
                <i class="bi bi-house-door"></i> Menú
            </a>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger ms-2">
                <i class="bi bi-box-arrow-right"></i> Salir
            </a>
        </div>
    </header>

    <!-- Contenido principal -->
<main class="main-content">
    <div class="panel-card">
        <h1 class="panel-title">Panel de Comunidad</h1>

        <!-- Sección de bienvenida -->
        <div class="welcome-card mt-4 p-4 rounded-3" style="background: rgba(28, 135, 255, 0.1); border-left: 4px solid var(--primary-light);">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="var(--primary-light)" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </svg>
                </div>
                <div class="ms-3">
                    <h4 class="mb-1">¡Bienvenido, <?= session()->get('nombre'); ?>!</h4>
                    <p class="mb-0 text-muted">Estás en el panel de administración de tu comunidad educativa.</p>
                </div>
            </div>
        </div>
        
        <!-- Tarjetas de acciones principales -->
        <div class="row g-4 mt-3">
            <!-- Tarjeta Crear Experiencia -->
            <div class="col-md-6">
                <div class="feature-card bg-primary-dark p-4 rounded-3 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="feature-icon bg-primary-light rounded-circle p-3 me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </div>
                        <h3 class="mb-0">Crear Experiencia</h3>
                    </div>
                    <p class="text-muted">Agrega nuevas experiencias educativas a la plataforma.</p>
                    <a href="<?= base_url('comunidad/crear-experiencia') ?>" class="btn btn-light mt-2 w-100">
                        Acceder <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
            
            <!-- Tarjeta Gestionar Experiencias -->
            <div class="col-md-6">
                <div class="feature-card bg-primary-dark p-4 rounded-3 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="feature-icon bg-primary-light rounded-circle p-3 me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2z"/>
                            </svg>
                        </div>
                        <h3 class="mb-0">Gestionar Experiencias</h3>
                    </div>
                    <p class="text-muted">Administra y edita tus experiencias existentes.</p>
                    <a href="<?= base_url('comunidad/gestionar-experiencias') ?>" class="btn btn-light mt-2 w-100">
                        Acceder <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
            <!-- Tarjeta Ver Reservas -->
<div class="col-md-6">
    <div class="feature-card bg-primary-dark p-4 rounded-3 h-100">
        <div class="d-flex align-items-center mb-3">
            <div class="feature-icon bg-primary-light rounded-circle p-3 me-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0-0.001-6.001A3 3 0 0 0 8 8z"/>
                </svg>
            </div>
            <h3 class="mb-0">Ver Reservas</h3>
        </div>
        <p class="text-muted">Consulta las reservas realizadas por turistas y su estado.</p>
        <a href="<?= base_url('comunidad/ver-reservas') ?>" class="btn btn-light mt-2 w-100">
            Acceder <i class="bi bi-arrow-right ms-2"></i>
        </a>
    </div>
</div>

</main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>