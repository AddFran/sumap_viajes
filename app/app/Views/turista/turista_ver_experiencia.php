<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Experiencia</title>
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

        .text-muted {
            color: #6c757d !important;
        }

        /* Contenido principal */
        .main-content {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .experience-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .experience-title {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .experience-title::after {
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

        .detail-item {
            margin-bottom: 15px;
        }

        .detail-label {
            font-weight: 500;
            color: var(--primary-light);
        }

        /* Galería */
        .gallery-container {
            margin-top: 30px;
        }

        .gallery-title {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 20px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .gallery-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: var(--border-radius);
            transition: transform 0.3s ease;
        }

        .gallery-img:hover {
            transform: scale(1.03);
        }

        .no-images {
            color: var(--text-muted);
            font-style: italic;
        }

        /* Botones */
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn-back {
            background: transparent;
            border: 1px solid var(--text-muted);
            color: var(--text-light);
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .btn-reserve {
            background: var(--success-color);
            border: none;
            color: white;
        }

        .btn-reserve:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
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

        .payment-method {
            display: none;
        }
         
        .valoraciones {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-light);
        }

        .valoraciones h3 {
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--primary-light);
        }

        .valoraciones-list {
            list-style: none;
            padding: 0;
        }

        .valoracion-item {
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--border-radius);
            padding: 15px;
            margin-bottom: 15px;
            border-left: 3px solid var(--primary-light);
        }

        .valoracion-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            align-items: center;
        }

        .valoracion-comment {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* Sistema de estrellas fraccionarias mejorado */
        .star-rating-container {
            display: inline-flex;
            position: relative;
            font-size: 1.5rem;
            letter-spacing: 2px;
        }

        .star-rating-background {
            color: #ccc;
            display: inline-flex;
        }

        .star-rating-foreground {
            color: gold;
            position: absolute;
            top: 0;
            left: 0;
            overflow: hidden;
            display: inline-flex;
        }

        .star-fraction {
            position: relative;
            width: 1em;
        }

        .star-fraction .filled {
            position: absolute;
            left: 0;
            overflow: hidden;
            width: 100%;
        }

        .star-fraction .filled-partial {
            position: absolute;
            left: 0;
            width: 100%;
            clip-path: inset(0 0 0 0); /* Esto se ajustará dinámicamente */
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
            
            .action-buttons {
                flex-direction: column;
                gap: 10px;
            }
            
            .action-buttons .btn {
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

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="experience-card">
            <h1 class="experience-title"><?= esc($experiencia['titulo']) ?></h1>
            
            <div class="detail-item">
                <span class="detail-label">Descripción:</span>
                <p><?= esc($experiencia['descripcion']) ?></p>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Fecha de Inicio:</span>
                        <p><?= esc($experiencia['fecha_inicio']) ?></p>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Precio por persona:</span>
                        <p>S/ <?= number_format($experiencia['precio'], 2) ?></p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Fecha de Fin:</span>
                        <p><?= esc($experiencia['fecha_fin']) ?></p>
                    </div>
                    
                    <div class="detail-item">
                        <span class="detail-label">Cupos disponibles:</span>
                        <p><?= esc($experiencia['cupos']) ?></p>
                    </div>
                </div>
            </div>

            <div class="experience-rating">
                <h4>Promedio calificación</h4>
                <div class="d-flex align-items-center mb-3">
                    <div class="star-rating-container">
                        <div class="star-rating-background">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <i class="bi bi-star-fill"></i>
                            <?php endfor; ?>
                        </div>

                        <div class="star-rating-foreground">
                            <?php
                            $fullStars = floor($promedio);
                            $fraction = $promedio - $fullStars;
                            
                            for ($i = 0; $i < $fullStars; $i++): ?>
                                <i class="bi bi-star-fill"></i>
                            <?php endfor; ?>
                            

                            <?php if ($fraction > 0 && $fullStars < 5): ?>
                                <div class="star-fraction">
                                    <div class="filled" style="width: <?= $fraction * 100 ?>%">
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <i class="bi bi-star-fill" style="color: #ccc"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <span class="average-rating ms-2"><?= number_format($promedio, 1) ?> de 5</span>
                </div>
                <p class="text-muted">Basado en <?= count($valoraciones) ?> valoraciones</p>
            </div>

            <div class="gallery-container">
                <h3 class="gallery-title">Galería de Imágenes</h3>

                <?php if (empty($imagenes)): ?>
                    <p class="no-images">No hay imágenes disponibles</p>
                <?php else: ?>
                    <div class="gallery-grid">
                        <?php foreach ($imagenes as $img): ?>
                            <img src="<?= base_url($img['ruta_imagen']) ?>" alt="Imagen experiencia" class="gallery-img" 
                                data-bs-toggle="modal" data-bs-target="#imageModal"
                                onclick="mostrarImagen('<?= base_url($img['ruta_imagen']) ?>')">
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>


            <div class="valoraciones">
                <h3>Valoraciones de usuarios</h3>
                <?php if (count($valoraciones) > 0): ?>
                    <ul class="valoraciones-list">
                        <?php foreach ($valoraciones as $valoracion): ?>
                            <li class="valoracion-item">
                                <div class="valoracion-header">
                                    <strong><?= esc($valoracion['nombre']) ?></strong>
                                    <div class="star-rating-container">
                                        <div class="star-rating-background">
                                            <?php for ($i = 0; $i < 5; $i++): ?>
                                                <i class="bi bi-star-fill"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="star-rating-foreground">
                                            <?php
                                            $fullStars = floor($valoracion['calificacion']);
                                            $fraction = $valoracion['calificacion'] - $fullStars;
                                            
                                            for ($i = 0; $i < $fullStars; $i++): ?>
                                                <i class="bi bi-star-fill"></i>
                                            <?php endfor; ?>
                                            
                                            <?php if ($fraction > 0 && $fullStars < 5): ?>
                                                <div class="star-fraction">
                                                    <div class="filled" style="width: <?= $fraction * 100 ?>%">
                                                        <i class="bi bi-star-fill"></i>
                                                    </div>
                                                    <i class="bi bi-star-fill" style="color: #ccc"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="valoracion-comment">
                                    <p><?= esc($valoracion['comentario']) ?></p>
                                    <small class="text-muted"><?= date('d/m/Y', strtotime($valoracion['fecha_valoracion'])) ?></small>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="alert alert-secondary">
                        Esta experiencia aún no tiene valoraciones.
                    </div>
                <?php endif; ?>
            </div>

            <div class="action-buttons">
                <a href="<?= base_url('turista/menu') ?>" class="btn btn-back">
                    <i class="bi bi-arrow-left"></i> Volver al menú
                </a>
                <button class="btn btn-reserve" onclick="abrirReserva()">
                    <i class="bi bi-calendar-plus"></i> Reservar Experiencia
                </button>
            </div>
        </div>
    </main>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-transparent border-0">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <img id="modalImage" src="" alt="Imagen ampliada" class="img-fluid rounded">
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalReserva" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-calendar-plus"></i> Reservar Experiencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formReserva">
                        <input type="hidden" name="id_experiencia" id="id_experiencia" value="<?= $experiencia['id_experiencia'] ?>">
                        <input type="hidden" name="precio_unitario" id="precio_unitario" value="<?= $experiencia['precio'] ?>">

                        <div class="mb-3">
                            <label class="form-label">Número de personas</label>
                            <input type="number" class="form-control" name="numero_personas" id="numero_personas" 
                                   min="1" max="<?= $experiencia['cupo_maximo'] ?>" value="1" required oninput="calcularTotal()">
                            <small class="text-muted">Cupo máximo: <?= $experiencia['cupo_maximo'] ?> personas</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total a pagar</label>
                            <input type="text" class="form-control" id="monto_total" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="abrirPago()">
                        <i class="bi bi-credit-card"></i> Continuar al pago
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPago" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-credit-card"></i> Confirmar Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('turista/confirmar-pago') ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="monto" id="pago_monto">
                        <input type="hidden" name="id_experiencia" id="pago_id_experiencia">
                        <input type="hidden" name="numero_personas" id="pago_num_personas">

                        <div class="mb-3">
                            <label class="form-label">Método de pago</label>
                            <select class="form-select" name="metodo_pago" id="metodo_pago" required onchange="mostrarCampos()">
                                <option value="">Seleccione...</option>
                                <option value="yape">Yape</option>
                                <option value="tarjeta">Tarjeta de crédito/débito</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>

                        <div class="payment-method" id="campo_yape">
                            <div class="mb-3">
                                <label class="form-label">Número de celular</label>
                                <input type="text" class="form-control" name="celular" placeholder="Ej: 987654321">
                            </div>
                        </div>

                        <div class="payment-method" id="campo_tarjeta">
                            <div class="mb-3">
                                <label class="form-label">Número de tarjeta</label>
                                <input type="text" class="form-control" name="numero_tarjeta" placeholder="Ej: 4111 1111 1111 1111">
                            </div>
                        </div>

                        <div class="payment-method" id="campo_paypal">
                            <div class="mb-3">
                                <label class="form-label">Cuenta PayPal</label>
                                <input type="email" class="form-control" name="paypal" placeholder="Ej: usuario@example.com">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" required>
                            <small class="text-muted">Confirma tu contraseña para autorizar el pago</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Confirmar Pago y Reservar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modalReserva = new bootstrap.Modal(document.getElementById('modalReserva'));
        const modalPago = new bootstrap.Modal(document.getElementById('modalPago'));

        function mostrarImagen(url) {
            // Cambia la fuente de la imagen en el modal
            document.getElementById('modalImage').src = url;
        }

        function abrirReserva() {
            modalReserva.show();
            calcularTotal();
        }

        function abrirPago() {
            const precio = parseFloat(document.getElementById("precio_unitario").value);
            const cantidad = parseInt(document.getElementById("numero_personas").value);
            const total = (precio * cantidad).toFixed(2);

            // Pasar valores al modal de pago
            document.getElementById("pago_monto").value = total;
            document.getElementById("pago_id_experiencia").value = document.getElementById("id_experiencia").value;
            document.getElementById("pago_num_personas").value = cantidad;

            modalReserva.hide();
            modalPago.show();
        }

        function calcularTotal() {
            const precio = parseFloat(document.getElementById("precio_unitario").value);
            const cantidad = parseInt(document.getElementById("numero_personas").value);
            const total = (precio * cantidad).toFixed(2);
            document.getElementById("monto_total").value = "S/ " + total;
        }

        function mostrarCampos() {
            document.getElementById("campo_yape").style.display = "none";
            document.getElementById("campo_tarjeta").style.display = "none";
            document.getElementById("campo_paypal").style.display = "none";

            const metodo = document.getElementById("metodo_pago").value;

            if (metodo === 'yape') document.getElementById("campo_yape").style.display = "block";
            if (metodo === 'tarjeta') document.getElementById("campo_tarjeta").style.display = "block";
            if (metodo === 'paypal') document.getElementById("campo_paypal").style.display = "block";
        }
    </script>
</body>
</html>