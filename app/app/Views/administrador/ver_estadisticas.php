<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de la Plataforma</title>
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
            max-width: 1200px;
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

        /* Tarjetas de estadísticas */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .stats-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 25px;
            color: var(--text-light);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-light);
        }

        .stats-card h3 {
            font-weight: 600;
            font-size: 2.2rem;
            margin-bottom: 10px;
            color: var(--primary-light);
        }

        .stats-card p {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 15px;
        }

        .stats-card .badge {
            font-weight: 600;
            padding: 0.5em 1em;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        /* Gráficos */
        .chart-section {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            margin-top: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-weight: 600;
            font-size: 1.3rem;
            color: #333;
        }

        .chart-container {
            position: relative;
            height: 350px;
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
        <h1 class="admin-title">Estadísticas de la Plataforma</h1>

        <div class="stats-cards">
            <!-- Total de Usuarios Registrados -->
            <div class="stats-card">
                <h3><?= $usuariosRegistrados ?></h3>
                <p>Usuarios Registrados</p>
                <span class="badge bg-primary">Total</span>
            </div>

            <!-- Total de Experiencias Aprobadas -->
            <div class="stats-card">
                <h3><?= $experienciasAprobadas ?></h3>
                <p>Experiencias Aprobadas</p>
                <span class="badge bg-success">Aprobadas</span>
            </div>

            <!-- Total de Reservas Realizadas -->
            <div class="stats-card">
                <h3><?= $reservasRealizadas ?></h3>
                <p>Reservas Realizadas</p>
                <span class="badge bg-warning">Total</span>
            </div>
        </div>

        <!-- Gráfico de Reservas por Día -->
        <div class="chart-section">
            <div class="chart-header">
                <h3 class="chart-title">Tendencia de Reservas</h3>
            </div>
            <div class="chart-container">
                <canvas id="reservasDiaChart"></canvas>
            </div>
        </div>
    </main>

    <!-- JS Bootstrap y Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Configuración común para los gráficos
        Chart.defaults.font.family = "'Roboto', sans-serif";
        Chart.defaults.color = '#666';

        // Gráfico de Reservas por Día
        const ctxDia = document.getElementById('reservasDiaChart').getContext('2d');
        const reservasDiaChart = new Chart(ctxDia, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($reservasPorDia, 'fecha')) ?>,
                datasets: [{
                    label: 'Reservas por Día',
                    data: <?= json_encode(array_column($reservasPorDia, 'total')) ?>,
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>