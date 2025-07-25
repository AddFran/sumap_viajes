<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
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
            --success-color: #28a745;
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
        .admin-header {
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

        .user-role {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* Contenido principal */
        .admin-content {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .admin-title {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 10px;
        }

        .admin-title::after {
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

        /* Tarjetas de opciones */
        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 40px;
        }

        .option-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 25px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--text-light);
        }

        .option-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
            border-color: var(--primary-light);
        }

        .option-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--primary-light);
        }

        .option-title {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .option-desc {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Footer */
        .admin-footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-header {
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
            
            .admin-content {
                padding: 20px;
            }
            
            .options-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="admin-header">
        <div class="logo-container">
            <img class="logo-img" src="<?= base_url('upload/logo.png') ?>" alt="Logo">
        </div>

        <!-- Sección del usuario (sin cambios) -->
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name"><?= session()->get('nombre') ?></div>
                <div class="user-role">Administrador</div>
            </div>
        </div>

        <!-- Nueva sección de enlaces en el header alineada a la derecha -->
        <div class="admin-navigation ms-auto">
            <a href="<?= base_url('/admin/menu') ?>" class="btn btn-outline-light">
                <i class="bi bi-house-door"></i> Menú
            </a>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger ms-2">
                <i class="bi bi-box-arrow-right"></i> Salir
            </a>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="admin-content">
        <h1 class="admin-title">Panel de Administración</h1>
        
        <div class="options-grid">
            <!-- Tarjeta Experiencias -->
            <a href="<?= site_url('/admin/ver_experiencias') ?>" class="option-card">
                <div class="option-icon">
                    <i class="bi bi-collection"></i>
                </div>
                <h3 class="option-title">Gestionar Experiencias</h3>
                <p class="option-desc">Revisa y aprueba nuevas experiencias pendientes de publicación</p>
            </a>
            
            <!-- Tarjeta Reportes -->
            <a href="<?= site_url('/admin/ver_reportes') ?>" class="option-card">
                <div class="option-icon">
                    <i class="bi bi-flag"></i>
                </div>
                <h3 class="option-title">Reportes de Usuarios</h3>
                <p class="option-desc">Revisa y gestiona los reportes realizados por los usuarios</p>
            </a>
            
            <!-- Tarjeta Usuarios -->
            <a href="<?= site_url('/admin/ver_usuarios') ?>" class="option-card">
                <div class="option-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h3 class="option-title">Gestión de Usuarios</h3>
                <p class="option-desc">Administra los usuarios registrados en la plataforma</p>
            </a>

            <a href="<?= site_url('/admin/estadisticas') ?>" class="option-card">
                <div class="option-icon">
                    <i class="bi bi-graph-up"></i>
                </div>
                <h3 class="option-title">KMeans</h3>
                <p class="option-desc">Agrupar a los usuarios en clusters basados en ciertas características.</p>
            </a>
            
        </div>
    </main>

    <!-- Footer -->
    <footer class="admin-footer">
        <p>Sistema de Administración &copy; <?= date('Y') ?></p>
    </footer>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>