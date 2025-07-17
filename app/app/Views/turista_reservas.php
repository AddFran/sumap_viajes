<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
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
            --warning-color: #ffc107;
            --danger-color: #dc3545;
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

        /* Contenido principal */
        .main-content {
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .reservas-title {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        .reservas-title::after {
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

        /* Tabla de reservas */
        .table-container {
            background: rgba(0, 0, 0, 0.2);
            border-radius: var(--border-radius);
            overflow: hidden;
            margin-bottom: 30px;
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

        /* Estado de reserva */
        .badge-estado {
            font-weight: 500;
            padding: 0.35em 0.65em;
            border-radius: 20px;
        }

        .badge-confirmada {
            background-color: var(--success-color);
        }

        .badge-cancelada {
            background-color: var(--danger-color);
        }

        .badge-completada {
            background-color: var(--primary-light);
        }

        .badge-pendiente {
            background-color: var(--warning-color);
            color: #212529;
        }

        /* Botones */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 8px;
            margin-right: 5px;
        }

        .btn-cancelar {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .btn-valorar {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Estrellas valoración */
        .rating-stars {
            font-size: 1.5rem;
            margin: 10px 0;
        }

        .rating-star {
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }

        .rating-star.selected {
            color: gold;
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
            margin-top: 20px;
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
                <div class="user-name"><?= esc($nombre) ?></div>
                <div class="user-type">Cuenta Turista</div>
            </div>
        </div>

        <!-- Nueva sección de enlaces alineados a la derecha -->
        <div class="admin-navigation ms-auto">
            <a href="<?= base_url('/turista/menu') ?>" class="btn btn-outline-light btn-sm">
                <i class="bi bi-house-door"></i> Menú
            </a>
            <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm ms-2">
                <i class="bi bi-box-arrow-right"></i> Salir
            </a>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="main-content">
        <h1 class="reservas-title">Mis Reservas</h1>

        <?php if (empty($reservas)): ?>
            <div class="alert alert-info bg-primary-dark border-primary-light text-light">
                No tienes reservas registradas.
                <a href="<?= base_url('turista/menu') ?>" class="alert-link text-light">Explora experiencias disponibles</a>
            </div>
        <?php else: ?>
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-dark table-bordered table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Experiencia</th>
                                <th>Fecha</th>
                                <th>Personas</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Pago</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservas as $res): ?>
                                <tr id="reserva-<?= $res['id_reserva'] ?>" data-experiencia="<?= $res['id_experiencia'] ?>">
                                    <td><?= esc($res['experiencia']['titulo']) ?></td>
                                    <td><?= esc($res['fecha_reserva']) ?></td>
                                    <td><?= esc($res['numero_personas']) ?></td>
                                    <td>S/ <?= number_format($res['monto_total'], 2) ?></td>
                                    <td>
                                        <span class="badge-estado badge-<?= strtolower($res['estado_reserva']) ?>">
                                            <?= esc($res['estado_reserva']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?= $res['pago'] ? esc($res['pago']['metodo_pago']) : '<span class="text-muted">Pendiente</span>' ?>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap">
                                            <button class="btn btn-sm btn-cancelar text-white"
                                                onclick="abrirCancelarModal(<?= $res['id_reserva'] ?>)"
                                                <?= $res['estado_reserva'] === 'Confirmada' ? '' : 'disabled' ?>>
                                                <i class="bi bi-x-circle"></i> Cancelar
                                            </button>
                                            <button class="btn btn-sm btn-valorar text-white"
                                                onclick="abrirValorarModal(<?= $res['id_reserva'] ?>)"
                                                <?= $res['estado_reserva'] === 'Completada' ? '' : 'disabled' ?>>
                                                <i class="bi bi-star-fill"></i> Valorar
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

        <div class="footer-actions">
            <a href="<?= base_url('turista/menu') ?>" class="btn btn-outline-light">
                <i class="bi bi-arrow-left"></i> Volver al menú
            </a>
        </div>
    </main>

    <!-- Modal Cancelar Reserva -->
    <div class="modal fade" id="modalCancelar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-x-circle"></i> Cancelar Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('turista/cancelar-reserva') ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_reserva" id="cancelar_id_reserva">

                        <div class="mb-3">
                            <label class="form-label">Motivo de la cancelación</label>
                            <textarea name="motivo_cancelacion" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de cancelar esta reserva?')">
                            <i class="bi bi-check-circle"></i> Confirmar cancelación
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Valorar Experiencia -->
    <div class="modal fade" id="modalValorar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-star-fill"></i> Valorar Experiencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('turista/valorar') ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_reserva" id="valorar_id_reserva">
                        <input type="hidden" name="id_experiencia" id="valorar_id_experiencia">

                        <div class="mb-3">
                            <label class="form-label">Calificación</label>
                            <div class="rating-stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="rating-star" data-value="<?= $i ?>" onclick="seleccionarEstrella(this)">★</span>
                                <?php endfor; ?>
                            </div>
                            <input type="hidden" name="calificacion" id="calificacion" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Comentario</label>
                            <textarea name="comentario" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Enviar valoración
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modalCancelar = new bootstrap.Modal(document.getElementById('modalCancelar'));
        const modalValorar = new bootstrap.Modal(document.getElementById('modalValorar'));

        function abrirCancelarModal(idReserva) {
            document.getElementById('cancelar_id_reserva').value = idReserva;
            modalCancelar.show();
        }

        function abrirValorarModal(idReserva) {
            const experienciaId = document.querySelector(`#reserva-${idReserva}`).dataset.experiencia;
            document.getElementById('valorar_id_reserva').value = idReserva;
            document.getElementById('valorar_id_experiencia').value = experienciaId;
            resetearEstrellas();
            modalValorar.show();
        }

        function seleccionarEstrella(estrella) {
            const estrellas = document.querySelectorAll('.rating-star');
            const valor = parseInt(estrella.dataset.value);
            
            estrellas.forEach((star, index) => {
                if (index < valor) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
            
            document.getElementById('calificacion').value = valor;
        }

        function resetearEstrellas() {
            const estrellas = document.querySelectorAll('.rating-star');
            estrellas.forEach(star => star.classList.remove('selected'));
            document.getElementById('calificacion').value = '';
        }
    </script>
</body>
</html>