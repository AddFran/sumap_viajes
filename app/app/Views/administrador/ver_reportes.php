<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Pendientes</title>
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
            --info-color: #17a2b8;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, var(--bg-dark), #001a33);
            color: var(--text-light);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* Header */
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

        /* Contenido principal */
        .admin-content {
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .panel-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
        }

        .panel-title {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
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

        /* Badges */
        .badge-report {
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 20px;
            font-size: 0.75rem;
        }

        .badge-user {
            background-color: rgba(28, 135, 255, 0.15);
            color: var(--primary-light);
        }

        .badge-experience {
            background-color: rgba(255, 193, 7, 0.15);
            color: var(--warning-color);
        }

        /* Botones */
        .btn-action {
            padding: 0.35rem 0.75rem;
            font-size: 0.85rem;
            border-radius: 6px;
            margin-right: 5px;
            transition: all 0.2s;
            border: none;
        }

        .btn-action:hover {
            transform: translateY(-1px);
        }

        .btn-justify {
            background-color: rgba(40, 167, 69, 0.15);
            color: var(--success-color);
        }

        .btn-justify:hover {
            background-color: rgba(40, 167, 69, 0.3);
        }

        .btn-reject {
            background-color: rgba(220, 53, 69, 0.15);
            color: var(--danger-color);
        }

        .btn-reject:hover {
            background-color: rgba(220, 53, 69, 0.3);
        }

        .btn-ban {
            background-color: rgba(220, 53, 69, 0.3);
            color: var(--danger-color);
        }

        .btn-ban:hover {
            background-color: rgba(220, 53, 69, 0.5);
        }

        .btn-details {
            background-color: rgba(23, 162, 184, 0.15);
            color: var(--info-color);
        }

        .btn-details:hover {
            background-color: rgba(23, 162, 184, 0.3);
        }

        /* Detalles reporte */
        .report-details {
            display: none;
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--border-radius);
            padding: 15px;
            margin-top: 10px;
            border-left: 3px solid var(--warning-color);
        }

        .report-details p {
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .detail-label {
            color: var(--text-muted);
            font-weight: 500;
            margin-right: 5px;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background-color: rgba(255, 255, 255, 0.03);
            border-radius: var(--border-radius);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--text-muted);
            opacity: 0.5;
            margin-bottom: 15px;
        }

        .empty-state h4 {
            color: var(--text-light);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--text-muted);
            max-width: 500px;
            margin: 0 auto 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                padding: 15px;
                text-align: center;
                gap: 15px;
            }
            
            .logo-container {
                margin-bottom: 0;
            }
            
            .admin-content {
                padding: 20px;
            }
            
            .panel-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .panel-title::after {
                left: 0;
            }
            
            .table-responsive {
                border-radius: var(--border-radius);
            }
            
            /* Tabla responsive */
            .table thead {
                display: none;
            }
            
            .table tbody tr {
                display: block;
                margin-bottom: 15px;
                border-radius: var(--border-radius);
                overflow: hidden;
                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            }
            
            .table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 12px 15px;
                border-bottom: 1px solid rgba(255,255,255,0.05);
            }
            
            .table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                margin-right: 15px;
                color: var(--text-muted);
                font-size: 0.85rem;
                text-transform: uppercase;
            }
            
            .btn-group-mobile {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
            }
        }

        /* Agrupación por experiencia */
        .experience-group {
            background: rgba(28, 135, 255, 0.1);
            border-left: 3px solid var(--primary-light);
            margin-bottom: 15px;
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .experience-header {
            padding: 10px 15px;
            background: rgba(0, 51, 102, 0.5);
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .experience-title {
            font-weight: 500;
            color: var(--primary-light);
        }

        .report-count {
            background-color: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        .reports-container {
            padding: 0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="admin-header">
        <div class="logo-container">
            <img class="logo-img" src="<?= base_url('upload/logo.png') ?>" alt="Logo">
        </div>

        <div class="user-profile">
            <div class="user-info">
                <div class="user-name"><?= session()->get('nombre') ?></div>
                <div class="user-role">Administrador</div>
            </div>
        </div>

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
        <div class="panel-card">
            <h1 class="panel-title">
                <i class="bi bi-flag-fill"></i> Reportes Pendientes
            </h1>
            
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert-admin">
                    <i class="bi bi-check-circle-fill"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (empty($reportes)): ?>
                <div class="empty-state">
                    <i class="bi bi-check-circle"></i>
                    <h4>No hay reportes pendientes</h4>
                    <p>Todos los reportes han sido revisados.</p>
                </div>
            <?php else: ?>
                <!-- Agrupación por experiencia -->
                <?php 
                // Agrupar reportes por experiencia (si son de tipo experiencia)
                $groupedReports = [];
                foreach ($reportes as $reporte) {
                    if ($reporte['tipo_reportado'] === 'Experiencia') {
                        $expId = $reporte['id_experiencia'] ?? 'general';
                        $groupedReports[$expId][] = $reporte;
                    } else {
                        $groupedReports['usuarios'][] = $reporte;
                    }
                }
                ?>

                <!-- Reportes de experiencias agrupados -->
                <?php foreach ($groupedReports as $expId => $reports): ?>
                    <?php if ($expId !== 'usuarios'): ?>
                        <?php $firstReport = $reports[0]; ?>
                        <div class="experience-group">
                            <div class="experience-header" onclick="toggleGroup('exp_<?= $expId ?>')">
                                <div class="experience-title">
                                    <i class="bi bi-image-alt"></i> Experiencia: <?= esc($firstReport['detalle_reportado']) ?>
                                    <small class="text-muted">(ID: <?= $expId ?>)</small>
                                </div>
                                <div class="report-count"><?= count($reports) ?></div>
                            </div>
                            <div class="reports-container" id="exp_<?= $expId ?>">
                                <div class="table-container">
                                    <div class="table-responsive">
                                        <table class="table table-dark table-bordered table-striped table-hover align-middle">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Motivo</th>
                                                    <th>Reportado por</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($reports as $reporte): ?>
                                                    <tr>
                                                        <td data-label="ID">#<?= $reporte['id_reporte'] ?></td>
                                                        <td data-label="Motivo">
                                                            <strong><?= esc($reporte['motivo'] ?? 'Sin motivo') ?></strong>
                                                        </td>
                                                        <td data-label="Reportado por">
                                                            <span class="badge-report badge-user">
                                                                <?= esc($reporte['nombre_reportador']) ?>
                                                            </span>
                                                        </td>
                                                        <td data-label="Acciones">
                                                            <div class="d-flex flex-wrap btn-group-mobile">
                                                                <button class="btn-action btn-details" onclick="toggleDetalles(<?= $reporte['id_reporte'] ?>)">
                                                                    <i class="bi bi-info-circle"></i> Detalles
                                                                </button>
                                                                <button class="btn-action btn-ban" 
                                                                onclick="banExperience(<?= $expId ?>, '<?= esc($firstReport['detalle_reportado']) ?>')">
                                                                <i class="bi bi-slash-circle"></i> Banear Experiencia
                                                                </button>
                                                            </div>
                                                            
                                                            <!-- Detalles del reporte -->
                                                            <div class="report-details" id="detalles_<?= $reporte['id_reporte'] ?>">
                                                                <p><span class="detail-label">Descripción:</span> <?= esc($reporte['descripcion']) ?></p>
                                                                <p><span class="detail-label">Reportador:</span> <?= esc($reporte['nombre_reportador']) ?></p>
                                                                <p><span class="detail-label">Email:</span> <?= esc($reporte['email_reportador']) ?></p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar/ocultar detalles
        function toggleDetalles(id) {
            const detalles = document.getElementById('detalles_' + id);
            detalles.style.display = detalles.style.display === 'none' ? 'block' : 'none';
        }

        // Mostrar/ocultar grupo de experiencias
        function toggleGroup(id) {
            const group = document.getElementById(id);
            group.style.display = group.style.display === 'none' ? 'block' : 'none';
        }

        // Banear experiencia
        function banExperience(id, nombre) {
    if (confirm(`¿Estás seguro de banear la experiencia "${nombre}"? Esto la ocultará de la plataforma.`)) {
        fetch('<?= base_url('admin/ban_experiencia') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id_experiencia=${id}&razon=Baneado por múltiples reportes`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'ok') {
                alert(`La experiencia "${nombre}" ha sido baneada`);
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al banear la experiencia');
        });
    }
}


        // Inicialización - cerrar todos los grupos al cargar
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.reports-container').forEach(container => {
                container.style.display = 'none';
            });
        });
    </script>
</body>
</html>