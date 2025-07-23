<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Turista</title>
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
            max-width: 1200px;
            margin: 0 auto;
        }

        .welcome-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .welcome-title {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 15px;
            position: relative;
            padding-bottom: 10px;
        }

        .welcome-title::after {
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

        .text-muted {
            color: #6c757d !important;
        }

        /* Tarjetas de experiencia */
        .experiencia-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }

        .experiencia-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
            border-color: var(--primary-light);
        }

        .experiencia-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: var(--border-radius);
            margin-bottom: 15px;
        }

        .experiencia-title {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .experiencia-desc {
            color: var(--text-muted);
            margin-bottom: 15px;
        }

        /* Botones */
        .btn-action {
            border-radius: var(--border-radius);
            padding: 8px 15px;
            font-weight: 500;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .btn-details {
            background: var(--primary-base);
            border: none;
            color: white;
        }

        .btn-details:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(28, 135, 255, 0.3);
        }

        .btn-report {
            background: transparent;
            border: 1px solid var(--error-color);
            color: var(--error-color);
        }

        .btn-report:hover {
            background: rgba(255, 107, 129, 0.1);
            transform: translateY(-2px);
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

        .btn-close {
            filter: invert(1);
        }

        /* Footer */
        .footer-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
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

        .no-experiences-alert {
            background: rgba(10, 25, 47, 0.8);
            border: 1px solid var(--primary-light);
            color: var(--text-light);
            border-radius: var(--border-radius);
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
        }

        .no-experiences-alert i {
            font-size: 2rem;
            color: var(--primary-light);
            margin-bottom: 10px;
            display: block;
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
            
            .footer-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .footer-actions a {
                width: 100%;
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
                <div class="user-name"><?= esc($nombre) ?></div>
                <div class="user-type">Cuenta Turista</div>
            </div>
        </div>

        <div class="admin-navigation ms-auto">
            <a href="<?= base_url('/turista/menu') ?>" class="btn btn-outline-light">
                <i class="bi bi-house-door"></i> Menú
            </a>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger ms-2">
                <i class="bi bi-box-arrow-right"></i> Salir
            </a>
        </div>
    </header>

    <main class="main-content">
        <div class="welcome-card">
            <h1 class="welcome-title">¡Bienvenido, <?= esc($nombre) ?>!</h1>
            <p>Estás navegando como <strong>Turista</strong>. Explora algunas experiencias destacadas:</p>
        </div>

        <form method="get" action="<?= base_url('turista/menu') ?>" class="search-container">
            <div class="search-input-group">
                <i class="bi bi-search search-icon"></i>
                <input type="text" name="search" class="search-input" placeholder="Buscar experiencias por nombre..." 
                    value="<?= esc($searchTerm ?? '') ?>">
                <button type="submit" class="search-btn">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        <?php if (empty($experiencias)): ?>
            <div class="no-experiences-alert">
                <i class="bi bi-info-circle"></i>
                <p>No hay experiencias aprobadas disponibles por el momento.</p>
                <?php if (!empty($searchTerm)): ?>
                    <p class="text-muted">Intenta con otro término de búsqueda.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($experiencias as $exp): ?>
                    <div class="col-lg-6">
                        <div class="experiencia-card">
                            <?php if ($exp['imagen']): ?>
                                <img src="<?= base_url($exp['imagen']) ?>" alt="Imagen de la experiencia" class="experiencia-img">
                            <?php else: ?>
                                <div class="experiencia-img bg-dark d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                </div>
                            <?php endif; ?>
                            
                            <h3 class="experiencia-title"><?= esc($exp['titulo']) ?></h3>
                            <p class="experiencia-desc"><?= esc($exp['descripcion']) ?></p>
                            
                            <div class="d-flex flex-wrap">
                                <a href="<?= base_url('turista/experiencia/' . $exp['id_experiencia']) ?>" class="btn btn-action btn-details">
                                    <i class="bi bi-eye-fill"></i> Ver detalles
                                </a>
                                <button class="btn btn-action btn-report" onclick="abrirModalReporte(<?= $exp['id_experiencia'] ?>)">
                                    <i class="bi bi-flag-fill"></i> Reportar
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="footer-actions">
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-left"></i> Cerrar sesión
            </a>
            <a href="<?= base_url('turista/reservas') ?>" class="btn btn-primary">
                <i class="bi bi-calendar-check"></i> Gestionar reservas
            </a>
        </div>
    </main>

    <div class="modal fade" id="modalReporte" tabindex="-1" aria-labelledby="modalReporteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url('turista/reportar') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalReporteLabel"><i class="bi bi-flag-fill"></i> Reportar experiencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_experiencia" id="input_experiencia_id">
                        
                        <div class="mb-3">
                            <label class="form-label">Categoría</label>
                            <select name="id_categoria" class="form-select" required>
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?= $cat['id_categoria'] ?>"><?= esc($cat['motivo']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción del reporte</label>
                            <textarea name="descripcion" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Confirmar reporte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modalReporte = new bootstrap.Modal(document.getElementById('modalReporte'));
        function filterExperiences() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toUpperCase();
            const cards = document.querySelectorAll('.experiencia-card');
            
            cards.forEach(card => {
                const title = card.querySelector('.experiencia-title').textContent.toUpperCase();
                if (title.includes(filter)) {
                    card.style.display = "";
                    card.parentElement.style.display = "";
                } else {
                    card.style.display = "none";
                    card.parentElement.style.display = "none";
                }
            });
        }
        function abrirModalReporte(id) {
            document.getElementById('input_experiencia_id').value = id;
            modalReporte.show();
        }
    </script>
</body>
</html>