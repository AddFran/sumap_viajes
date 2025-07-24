<?php helper('text'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas de Mis Experiencias</title>
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

        /* Celdas de usuario */
        .user-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name-sm {
            font-weight: 500;
            font-size: 0.95rem;
        }

        .user-email {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* Estado de reserva */
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-pendiente {
            background-color: rgba(255, 193, 7, 0.15);
            color: #ffc107;
        }

        .status-confirmada {
            background-color: rgba(40, 167, 69, 0.15);
            color: #28a745;
        }

        .status-completada {
            background-color: rgba(23, 162, 184, 0.15);
            color: #17a2b8;
        }

        .status-cancelada {
            background-color: rgba(220, 53, 69, 0.15);
            color: #dc3545;
        }

        /* Formulario de estado */
        .status-form {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .status-select {
            background-color: rgba(0, 34, 68, 0.7);
            color: var(--text-light);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .status-select:focus {
            background-color: rgba(0, 56, 112, 0.7);
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.2rem rgba(28, 135, 255, 0.25);
        }

        .btn-status {
            background-color: var(--primary-base);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .btn-status:hover {
            background-color: var(--primary-light);
            transform: translateY(-1px);
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

        .text-muted {
            color: #6c757d !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-header {
                flex-direction: column;
                padding: 15px;
                text-align: center;
                gap: 15px;
            }
            
            .logo-container {
                margin-bottom: 0;
            }
            
            .user-profile {
                flex-direction: column;
                gap: 5px;
            }
            
            .main-content {
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
            
            .user-cell {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="logo-container">
            <img class="logo-img" src="<?= base_url('upload/logo.png') ?>" alt="Logo">
        </div>
        
        <div class="user-profile">
            <div>
                <div class="user-name"><?= session()->get('nombre'); ?></div>
                <div class="user-type">Cuenta Comunidad</div>
            </div>
        </div>

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
            <h2 class="panel-title">
                <i class="bi bi-calendar-check"></i> Reservas Recibidas
            </h2>

            <?php if (empty($reservas)): ?>
                <div class="empty-state">
                    <i class="bi bi-calendar-x"></i>
                    <h4>No hay reservas registradas</h4>
                    <p>Actualmente no tienes reservas para tus experiencias. Cuando los turistas reserven, aparecerán aquí.</p>
                    <a href="<?= base_url('/comunidad/gestionar-experiencias') ?>" class="btn btn-outline-primary">
                        <i class="bi bi-compass"></i> Ver mis experiencias
                    </a>
                </div>
            <?php else: ?>
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-dark table-bordered table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Turista</th>
                                    <th>Experiencia</th>
                                    <th>Fecha Reserva</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reservas as $res): ?>
                                    <tr>
                                        <td data-label="Turista">
                                            <div class="user-cell">
                                                <img src="<?= base_url('uploads/perfiles/' . $res['id_usuario'] . '.jpg') ?>" 
                                                     alt="Turista" 
                                                     class="user-avatar-sm"
                                                     width="40"
                                                     height="40"
                                                     onError="this.src='<?= base_url('upload/profile-avatar.jpg') ?>'">
                                                <div class="user-info">
                                                    <span class="user-name-sm"><?= esc($res['turista']) ?></span>
                                                    <span class="user-email"><?= esc($res['correo_turista']) ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Experiencia">
                                            <div class="fw-medium"><?= esc($res['experiencia']) ?></div>
                                            <small class="text-muted">ID: <?= esc($res['id_experiencia']) ?></small>
                                        </td>
                                        <td data-label="Fecha Reserva">
                                            <?= date('d/m/Y H:i', strtotime(esc($res['fecha_reserva']))) ?>
                                        </td>
                                        <td data-label="Estado">
                                            <span class="status-badge status-<?= strtolower(esc($res['estado_reserva'])) ?>">
                                                <?= esc($res['estado_reserva']) ?>
                                            </span>
                                        </td>
                                        <td data-label="Acciones">
                                            <form action="<?= base_url('comunidad/cambiar_estado_reserva') ?>" method="post" class="status-form">
                                                <input type="hidden" name="id_reserva" value="<?= esc($res['id_reserva']) ?>">
                                                <input type="hidden" name="estado_reserva" value="Completada">
                                                <button 
                                                    type="submit" 
                                                    class="btn btn-success"
                                                    <?= $res['estado_reserva'] == 'Confirmada' ? '' : 'disabled' ?>
                                                >
                                                    Completó la experiencia
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function contactarTurista(email) {
            // Abre el cliente de correo con el correo del turista y asunto predeterminado
            window.open(`mailto:${email}?subject=SUMAQ VIAJES - Consulta sobre tu reserva`, '_blank');
        }

        
        // Actualizar el badge de estado cuando cambia el select
        document.querySelectorAll('select[name="estado_reserva"]').forEach(select => {
            select.addEventListener('change', function() {
                const badge = this.closest('tr').querySelector('.status-badge');
                // Remover todas las clases de estado
                badge.className = 'status-badge';
                // Añadir la clase correspondiente al nuevo estado
                badge.classList.add(`status-${this.value.toLowerCase()}`);
                // Actualizar el texto
                badge.textContent = this.options[this.selectedIndex].text;
            });
        });
    </script>
</body>
</html>