<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
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
            --success-color: #28a745;
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

        /* Contenido principal */
        .admin-content {
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .admin-title {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 25px;
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

        /* Tabla */
        .table-container {
            background: rgba(0, 0, 0, 0.2);
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table {
            color: var(--text-light);
            margin-bottom: 0;
        }

        .table-dark {
            background: rgba(0, 51, 102, 0.7) !important;
            border-color: rgba(255, 255, 255, 0.1);
        }

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            background-color: rgba(255, 255, 255, 0.03);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(28, 135, 255, 0.1) !important;
        }

        .table-bordered {
            border-color: rgba(255, 255, 255, 0.1);
        }

        /* Badges para tipos de cuenta */
        .badge-account {
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 20px;
        }

        .badge-admin {
            background-color: var(--danger-color);
        }

        .badge-community {
            background-color: var(--primary-light);
        }

        .badge-tourist {
            background-color: var(--success-color);
        }

        /* Botones */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 6px;
            margin-right: 5px;
        }

        .btn-edit {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
            color: #212529;
        }

        .btn-delete {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .btn-add {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        /* Barra de búsqueda */
        .search-bar {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Sin resultados */
        .no-results {
            color: var(--text-muted);
            text-align: center;
            padding: 30px;
        }

        .search-container {
            margin-bottom: 30px;
            position: relative;
        }

        .search-input-group {
            display: flex;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .search-input {
            flex: 1;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: var(--text-light);
            padding: 12px 20px;
            padding-left: 45px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            background: rgba(255, 255, 255, 0.15);
            outline: none;
            box-shadow: 0 0 0 2px rgba(28, 135, 255, 0.3);
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1.2rem;
            pointer-events: none;
        }

        .search-btn {
            background: var(--primary-light);
            border: none;
            color: white;
            padding: 0 20px;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background: var(--primary-base);
        }

        /* Estilos para los resultados de búsqueda */
        .search-results-container {
            margin-top: 20px;
        }

        .no-results-alert {
            background: rgba(10, 25, 47, 0.8);
            border: 1px solid var(--primary-light);
            color: var(--text-light);
            border-radius: var(--border-radius);
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
        }

        .no-results-alert i {
            font-size: 2rem;
            color: var(--primary-light);
            margin-bottom: 10px;
            display: block;
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
            
            .table-responsive {
                border-radius: var(--border-radius);
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
            <a href="<?= base_url('/admin/menu') ?>" class="btn btn-outline-light btn-sm">
                <i class="bi bi-house-door"></i> Menú
            </a>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm ms-2">
                <i class="bi bi-box-arrow-right"></i> Salir
            </a>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="admin-content">
        <h1 class="admin-title">Gestión de Usuarios</h1>
        
        <form method="get" action="<?= base_url('/admin/ver_usuarios') ?>" class="search-container mb-4">
        <div class="search-input-group">
            <i class="bi bi-search search-icon"></i>
            <input type="text" name="search" class="search-input" placeholder="Buscar usuarios por nombre, correo o tipo..." 
                value="<?= esc($searchTerm ?? '') ?>">
            <button type="submit" class="search-btn">
                <i class="bi bi-search"></i> Buscar
            </button>
        </div>
    </form>

    <?php if (!empty($searchTerm) && empty($usuarios)): ?>
        <div class="no-results-alert">
            <i class="bi bi-exclamation-circle"></i>
            <p>No se encontraron usuarios que coincidan con tu búsqueda.</p>
            <p class="text-muted">Intenta con otro término de búsqueda.</p>
        </div>
    <?php elseif (empty($usuarios)): ?>
        <div class="no-results">
            <i class="bi bi-people" style="font-size: 2rem;"></i>
            <h4>No hay usuarios registrados</h4>
            <p>Actualmente no hay usuarios en el sistema.</p>
        </div>
    <?php else: ?>
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-dark table-bordered table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Tipo de Cuenta</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td>#<?= $usuario['id_usuario'] ?></td>
                                    <td><?= esc($usuario['nombre']) ?></td>
                                    <td><?= esc($usuario['correo']) ?></td>
                                    <td>
                                        <?php 
                                            $badgeClass = '';
                                            if ($usuario['tipo_cuenta'] === 'Administrador') {
                                                $badgeClass = 'badge-admin';
                                            } elseif ($usuario['tipo_cuenta'] === 'Comunidad') {
                                                $badgeClass = 'badge-community';
                                            } else {
                                                $badgeClass = 'badge-tourist';
                                            }
                                        ?>
                                        <span class="badge-account <?= $badgeClass ?>">
                                            <?= esc($usuario['tipo_cuenta']) ?>
                                        </span>
                                    </td>
                                    
                                    <td>
                                        <div class="d-flex flex-wrap">
                                            <a href="<?= site_url('/admin/editar_usuario/' . $usuario['id_usuario']) ?>" 
                                               class="btn btn-sm btn-edit">
                                               <i class="bi bi-pencil-fill"></i> Editar
                                            </a>
                                            <form action="<?= site_url('/admin/eliminar_usuario/' . $usuario['id_usuario']) ?>" 
                                                  method="post" class="d-inline">
                                                <button type="submit" 
                                                        class="btn btn-sm btn-delete"
                                                        onclick="return confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.');">
                                                    <i class="bi bi-trash-fill"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <?php if (isset($pager)): ?>
                <div class="d-flex justify-content-center mt-4">
                    <?= $pager->links() ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        
    </main>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>