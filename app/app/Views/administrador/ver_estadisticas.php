<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KMeans</title>
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
        <h1 class="admin-title">Uso del algoritmo KMeans</h1>

        <div class="stats-cards">
            <!-- Mostrar resumen de clusters -->
            <?php if (isset($clusterCounts) && isset($numClusters)): ?>
                <?php for ($i = 0; $i < $numClusters; $i++): ?>
                    <div class="stats-card">
                        <h3><?= isset($clusterCounts[$i]) ? $clusterCounts[$i] : 0 ?></h3>
                        <p>Elementos en Cluster <?= $i + 1 ?></p>
                        <span class="badge bg-primary">Cluster <?= $i + 1 ?></span>
                    </div>
                <?php endfor; ?>
            <?php else: ?>
                <p>No hay datos de clusters disponibles.</p>
            <?php endif; ?>
        </div>

        <!-- Gráfico de Clusters -->
        <div class="chart-section">
            <div class="chart-header">
                <h3 class="chart-title">Distribución de Clusters</h3>
            </div>
            <div class="chart-container">
                <canvas id="clustersChart"></canvas>
            </div>
        </div>
    </main>

    <section class="admin-content" style="margin-top: 40px; max-width: 1200px; margin-left: auto; margin-right: auto; color: var(--text-light); font-family: 'Roboto', sans-serif;">
        <h2>Información sobre el algoritmo k-means</h2>
        <p>El algoritmo k-means se ejecutó usando las siguientes características de los usuarios:</p>
        <ul>
            <li><strong>Tipo de cuenta:</strong> Codificado numéricamente (Admin=0, Comunidad=1, Turista=2, Suspendido=3)</li>
            <li><strong>Longitud del nombre:</strong> Número de caracteres en el nombre del usuario</li>
            <li><strong>Foto de perfil:</strong> Indicador binario (1 si tiene foto, 0 si no)</li>
            <li><strong>Estado de suspensión:</strong> Indicador binario (1 si está suspendido, 0 si no)</li>
            <li><strong>Dominio del correo electrónico:</strong> Codificado numéricamente para dominios comunes (gmail.com=0, yahoo.com=1, hotmail.com=2, otro=3)</li>
        </ul>
        <p>Los resultados de los clusters representan grupos de usuarios con características similares según estas variables. Esto puede ayudar a entender la composición de los usuarios y a tomar decisiones informadas para personalizar servicios o campañas.</p>
    </section>

    <!-- JS Bootstrap y Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Configuración común para los gráficos
        Chart.defaults.font.family = "'Roboto', sans-serif";
        Chart.defaults.color = '#666';

        // Gráfico de Clusters
        const ctxClusters = document.getElementById('clustersChart').getContext('2d');

        // Preparar datos para scatter plot
        const scatterDataPoints = [
            <?php for ($i = 0; $i < $numClusters; $i++): ?>
                { x: <?= $i + 1 ?>, y: <?= isset($clusterCounts[$i]) ? $clusterCounts[$i] : 0 ?> },
            <?php endfor; ?>
        ];

        // Colores para los clusters
        const clusterColors = [
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(255, 99, 132, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)'
        ];

        // Preparar datasets por cluster con colores distintos
        const datasets = [];
        <?php for ($i = 0; $i < $numClusters; $i++): ?>
            datasets.push({
                label: 'Cluster <?= $i + 1 ?>',
                data: [{ x: <?= $i + 1 ?>, y: <?= isset($clusterCounts[$i]) ? $clusterCounts[$i] : 0 ?> }],
                backgroundColor: clusterColors[<?= $i ?> % clusterColors.length],
                borderColor: clusterColors[<?= $i ?> % clusterColors.length].replace('0.6', '1'),
                pointRadius: 8,
                pointHoverRadius: 10,
                showLine: false
            });
        <?php endfor; ?>

        const clustersData = {
            datasets: datasets
        };

        const clustersChart = new Chart(ctxClusters, {
            type: 'scatter',
            data: clustersData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        title: {
                            display: true,
                            text: 'Número de elementos'
                        }
                    },
                    x: {
                        type: 'linear',
                        position: 'bottom',
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                return 'Cluster ' + value;
                            }
                        },
                        grid: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Clusters'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
