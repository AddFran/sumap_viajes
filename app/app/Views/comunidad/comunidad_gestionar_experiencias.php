<?php helper('text'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Experiencias</title>
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
            --error-color: #ff6b81;
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

        /* Botones */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 8px;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        /* Modal */
        .modal-content {
            background: var(--bg-dark);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-light);
        }

        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .modal-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-close {
            filter: invert(1);
        }

        /* Estado */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }

        .bg-success {
            background-color: #198754 !important;
        }

        .bg-warning {
            background-color: #ffc107 !important;
            color: #212529;
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
            
            .table-responsive {
                border-radius: var(--border-radius);
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
            <a href="<?= base_url('/comunidad/menu') ?>" class="btn btn-outline-light btn-sm">
                <i class="bi bi-house-door"></i> Menú
            </a>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm ms-2">
                <i class="bi bi-box-arrow-right"></i> Salir
            </a>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="panel-card">
            <h2 class="panel-title">Gestión de Experiencias</h2>

            <?php if (empty($experiencias)): ?>
                <div class="alert alert-info bg-primary-dark border-primary-light text-light">
                    No has registrado ninguna experiencia aún.
                    <a href="<?= base_url('comunidad/crear-experiencia') ?>" class="alert-link text-light">Crear nueva experiencia</a>
                </div>
            <?php else: ?>
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-dark table-bordered table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Fechas</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($experiencias as $exp): ?>
                                    <tr>
                                        <td><?= esc($exp['titulo']) ?></td>
                                        <td><?= character_limiter(esc($exp['descripcion']), 50) ?></td>
                                        <td>
                                            <small>
                                                <strong>Inicio:</strong> <?= esc($exp['fecha_inicio']) ?><br>
                                                <strong>Fin:</strong> <?= esc($exp['fecha_fin']) ?>
                                            </small>
                                        </td>
                                        <td>S/ <?= number_format($exp['precio'], 2) ?></td>
                                        <td>
                                            <span class="badge <?= $exp['estado'] == 'Activo' ? 'bg-success' : 'bg-warning' ?>">
                                                <?= esc($exp['estado']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button class="btn btn-warning btn-sm" onclick='abrirModal(<?= json_encode($exp) ?>)'>
                                                    <i class="bi bi-pencil-fill"></i> Editar
                                                </button>
                                                <form action="<?= base_url('comunidad/eliminar-experiencia') ?>" method="post" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta experiencia?');">
                                                    <input type="hidden" name="id_experiencia" value="<?= $exp['id_experiencia'] ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">
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
            <?php endif; ?>

            <div class="d-flex justify-content-between mt-4">
                <a href="<?= base_url('comunidad/menu') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Volver al Menú
                </a>
                <a href="<?= base_url('comunidad/crear-experiencia') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Nueva Experiencia
                </a>
            </div>
        </div>
    </main>

    <!-- Modal de edición -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('comunidad/actualizar-experiencia') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditarLabel">Editar Experiencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_experiencia" id="id_experiencia">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Título</label>
                                <input type="text" name="titulo" id="titulo" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Precio (S/)</label>
                                <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha Inicio</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha Fin</label>
                                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select name="estado" id="estado" class="form-select">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- JS Bootstrap y lógica del modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modalEditar = new bootstrap.Modal(document.getElementById('modalEditar'));

        function abrirModal(exp) {
            document.getElementById('id_experiencia').value = exp.id_experiencia;
            document.getElementById('titulo').value = exp.titulo;
            document.getElementById('descripcion').value = exp.descripcion;
            document.getElementById('fecha_inicio').value = exp.fecha_inicio;
            document.getElementById('fecha_fin').value = exp.fecha_fin;
            document.getElementById('precio').value = exp.precio;
            document.getElementById('estado').value = exp.estado;

            modalEditar.show();
        }
    </script>
</body>
</html>