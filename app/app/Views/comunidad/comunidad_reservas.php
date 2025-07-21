<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
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
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, var(--bg-dark), #001a33);
            color: var(--text-light);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .main-header {
            background: rgba(10, 25, 47, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-img {
            height: 40px;
        }

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
        }

        .panel-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .table {
            color: var(--text-light);
        }

        .table th, .table td {
            background-color: transparent;
        }

        .btn-outline-light:hover {
            background: var(--primary-light);
            color: #fff;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        .status-pendiente {
            color: #ffc107;
        }

        .status-aprobada {
            color: #28a745;
        }

        .status-cancelada {
            color: #dc3545;
        }

        @media (max-width: 768px) {
            .main-header {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>

<header class="main-header">
    <div>
        <img class="logo-img" src="<?= base_url('upload/logo.png') ?>" alt="Logo">
    </div>
    <div class="user-profile d-flex flex-column text-end">
        <div class="user-name"><?= session()->get('nombre'); ?></div>
        <div class="user-type">Cuenta Comunidad</div>
    </div>
    <div class="admin-navigation ms-auto">
        <a href="<?= base_url('/comunidad/menu') ?>" class="btn btn-outline-light btn-sm">
            <i class="bi bi-house-door"></i> Menú
        </a>
        <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm ms-2">
            <i class="bi bi-box-arrow-right"></i> Salir
        </a>
    </div>
</header>

<main class="main-content">
    <div class="panel-card">
        <h1 class="panel-title">Reservas Recibidas</h1>

        <?php if (isset($reservas) && count($reservas) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th>Turista</th>
                            <th>Experiencia</th>
                            <th>Fecha Reserva</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservas as $res): ?>
                            <tr>
                                <td><?= esc($res['turista']) ?></td>
                                <td><?= esc($res['experiencia']) ?></td>
                                <td><?= esc($res['fecha_reserva']) ?></td>
                                <td>
                                    <span class="status-<?= strtolower($res['estado_reserva']) ?>">
                                        <?= ucfirst($res['estado_reserva']) ?>
                                    </span>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center mt-4">
                No hay reservas registradas para tus experiencias aún.
            </div>
        <?php endif; ?>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
