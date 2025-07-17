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

        /* Detalles reporte */
        .report-details {
            display: none;
            background: rgba(255, 255, 255, 0.1);
            border-radius: var(--border-radius);
            padding: 15px;
            margin-top: 10px;
            border-left: 3px solid var(--warning-color);
        }

        .report-details p {
            margin-bottom: 5px;
        }

        /* Badges */
        .badge-report {
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 20px;
        }

        .badge-user {
            background-color: var(--primary-light);
        }

        .badge-experience {
            background-color: var(--warning-color);
            color: #212529;
        }

        /* Botones */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 6px;
            margin-right: 5px;
        }

        .btn-justify {
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

        /* Sin resultados */
        .no-results {
            color: var(--text-muted);
            text-align: center;
            padding: 30px;
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
        <h1 class="admin-title">Reportes Pendientes</h1>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert-admin">
                <i class="bi bi-check-circle-fill"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (empty($reportes)): ?>
            <div class="no-results">
                <i class="bi bi-check-circle" style="font-size: 2rem;"></i>
                <h4>No hay reportes pendientes</h4>
                <p>Todos los reportes han sido revisados.</p>
            </div>
        <?php else: ?>
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-dark table-bordered table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Motivo</th>
                                <th>Reportado</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reportes as $reporte): ?>
                                <tr>
                                    <td>#<?= $reporte['id_reporte'] ?></td>

                                    <!-- Columna de Motivo y breve descripción -->
                                    <td>
                                        <strong><?= esc($reporte['motivo'] ?? 'Sin motivo') ?></strong>
                                        
                                    </td>

                                    <!-- Columna de Tipo de Reportado (Usuario o Experiencia) -->
                                    <td>
                                        <span class="badge-report <?= $reporte['tipo_reportado'] === 'Usuario' ? 'badge-user' : 'badge-experience' ?>">
                                            <?= esc($reporte['tipo_reportado']) ?>
                                        </span>
                                        <br>
                                        <?= esc($reporte['detalle_reportado']) ?>
                                    </td>

                                    <!-- Nueva columna: Descripción completa del reporte -->
                                    <td><?= esc($reporte['descripcion']) ?></td>

                                    <!-- Botones de acción (Justificar / Rechazar) -->
                                    <td>
                                        <div class="d-flex flex-wrap">
                                            <a href="<?= base_url('admin/evaluar_reporte/' . $reporte['id_reporte'] . '/Justificado') ?>"
                                            class="btn btn-sm btn-justify text-white me-1">
                                                <i class="bi bi-check-lg"></i> Justificar
                                            </a>
                                            <a href="<?= base_url('admin/evaluar_reporte/' . $reporte['id_reporte'] . '/No_Justificado') ?>"
                                            class="btn btn-sm btn-reject text-white">
                                                <i class="bi bi-x-lg"></i> Rechazar
                                            </a>
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

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar/ocultar detalles
        function toggleDetalles(id) {
            const detalles = document.getElementById('detalles_' + id);
            if (detalles.style.display === 'none' || detalles.style.display === '') {
                detalles.style.display = 'block';
            } else {
                detalles.style.display = 'none';
            }
        }

        // Evaluar reporte con confirmación
        function evaluarReporte(id, accion) {
            const mensaje = accion === 'Justificado' 
                ? '¿Estás seguro de marcar este reporte como justificado?'
                : '¿Estás seguro de rechazar este reporte?';
            
            if (confirm(mensaje)) {
                window.location.href = /admin/evaluar_reporte/${id}/${accion};
            }
        }

        // Mostrar todos los detalles al cargar si hay parámetros
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('detalle')) {
                const id = urlParams.get('detalle');
                const detalles = document.getElementById('detalles_' + id);
                if (detalles) {
                    detalles.style.display = 'block';
                    detalles.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });


        function evaluarReporte(id, estado) {
            fetch('<?= base_url('admin/evaluar_reporte') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest' // importante para detectar AJAX en CodeIgniter
                },
                body: new URLSearchParams({
                    id_reporte: id,
                    estado: estado
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'ok') {
                    alert('Reporte actualizado correctamente');
                    // Puedes eliminar la fila o actualizar la tabla aquí:
                    document.querySelector(`#fila-${id}`).remove();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }


    </script>
</body>
</html>