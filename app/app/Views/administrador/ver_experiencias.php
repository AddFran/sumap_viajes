<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Experiencias Pendientes</title>
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

        /* Alertas */
        .alert-admin {
            background: rgba(40, 167, 69, 0.2);
            color: var(--success-color);
            border-left: 3px solid var(--success-color);
            border-radius: var(--border-radius);
            padding: 15px;
            margin-bottom: 25px;
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

        .table-bordered th, 
        .table-bordered td {
            border-color: rgba(255, 255, 255, 0.1);
        }

        /* Imágenes */
        .experience-img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Botones */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 6px;
            margin-right: 5px;
        }

        .btn-approve {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        .btn-reject {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .btn-details {
            background-color: var(--primary-light);
            border-color: var(--primary-light);
        }

        /* Estado */
        .badge-pending {
            background-color: var(--warning-color);
            color: #212529;
        }

        /* Sin resultados */
        .no-results {
            color: var(--text-muted);
            text-align: center;
            padding: 30px;
        }

        /* Modal */
        .modal-content {
            background: var(--bg-dark);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-light);
            border-radius: var(--border-radius);
        }

        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .modal-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
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
        <h1 class="admin-title">Experiencias Pendientes de Aprobación</h1>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert-admin">
                <i class="bi bi-check-circle-fill"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (empty($experienciasPendientes)): ?>
            <div class="no-results">
                <i class="bi bi-check-circle" style="font-size: 2rem;"></i>
                <h4>No hay experiencias pendientes</h4>
                <p>Todas las experiencias han sido revisadas.</p>
            </div>
        <?php else: ?>
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-dark table-bordered table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($experienciasPendientes as $experiencia): ?>
                                <tr>
                                    <td><?= esc($experiencia['titulo']) ?></td>
                                    <td><?= esc(character_limiter($experiencia['descripcion'], 100)) ?></td>
                                    <td>
                                        <?php if ($experiencia['foto_experiencia']): ?>
                                            <img src="<?= base_url($experiencia['foto_experiencia']) ?>" 
                                                 alt="Imagen de la experiencia" 
                                                 class="experience-img"
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#imageModal"
                                                 onclick="mostrarImagen('<?= base_url($experiencia['foto_experiencia']) ?>')">
                                        <?php else: ?>
                                            <span class="text-muted">Sin imagen</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-pending">Pendiente</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap">
                                            <a href="<?= site_url('/admin/aprobar_experiencia/' . $experiencia['id_experiencia']) ?>" 
                                               class="btn btn-sm btn-approve text-white"
                                               onclick="return confirm('¿Estás seguro de aprobar esta experiencia?')">
                                               <i class="bi bi-check-lg"></i> Aprobar
                                            </a>
                                            <a href="<?= site_url('/admin/rechazar_experiencia/' . $experiencia['id_experiencia']) ?>" 
                                               class="btn btn-sm btn-reject text-white"
                                               onclick="return confirm('¿Estás seguro de rechazar esta experiencia?')">
                                               <i class="bi bi-x-lg"></i> Rechazar
                                            </a>
                                            <button class="btn btn-sm btn-details text-white"
                                                    onclick="mostrarDetalles(<?= htmlspecialchars(json_encode($experiencia), ENT_QUOTES, 'UTF-8') ?>)">
                                               <i class="bi bi-eye-fill"></i> Detalles
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <!-- Modal para imagen grande -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-transparent border-0">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <img id="modalImage" src="" alt="Imagen ampliada" class="img-fluid rounded">
            </div>
        </div>
    </div>

    <!-- Modal para detalles -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles completos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalDetailsContent">
                    <!-- Contenido dinámico -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar imagen en modal
        function mostrarImagen(src) {
            document.getElementById('modalImage').src = src;
        }

        // Mostrar detalles completos
        function mostrarDetalles(experiencia) {
            const modalContent = document.getElementById('modalDetailsContent');
            let html = `
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h4>${experiencia.titulo}</h4>
                        <p class="text-muted">ID: ${experiencia.id_experiencia}</p>
                    </div>
                    <div class="col-md-6 text-end mb-3">
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5>Descripción completa</h5>
                    <p>${experiencia.descripcion}</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5>Información básica</h5>
                        <p><strong>Precio:</strong> S/ ${parseFloat(experiencia.precio).toFixed(2)}</p>
                        <p><strong>Cupo máximo:</strong> ${experiencia.cupo_maximo} personas</p>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <h5>Fechas</h5>
                        <p><strong>Inicio:</strong> ${experiencia.fecha_inicio}</p>
                        <p><strong>Fin:</strong> ${experiencia.fecha_fin}</p>
                    </div>
                </div>
            `;
            
            if (experiencia.foto_experiencia) {
                html += `
                    <div class="mb-3">
                        <h5>Imagen principal</h5>
                        <img src="${experiencia.foto_experiencia}" alt="Imagen experiencia" class="img-fluid rounded">
                    </div>
                `;
            }
            
            modalContent.innerHTML = html;
            
            const modal = new bootstrap.Modal(document.getElementById('detailsModal'));
            modal.show();
        }
    </script>
</body>
</html>