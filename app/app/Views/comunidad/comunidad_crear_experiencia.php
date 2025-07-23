<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Experiencia</title>
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
            max-width: 800px;
            margin: 0 auto;
        }

        .form-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
        }

        .form-title {
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        .form-title::after {
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

        /* Campos del formulario */
        .form-label {
            color: var(--text-light);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            color: var(--text-light);
            padding: 12px 15px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.25rem rgba(28, 135, 255, 0.25);
            color: var(--text-light);
        }

        textarea.form-control {
            min-height: 120px;
        }

        /* Botones */
        .btn-primary {
            background: var(--primary-base);
            border: none;
            border-radius: var(--border-radius);
            padding: 12px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(28, 135, 255, 0.3);
        }

        .btn-outline-secondary {
            border-color: var(--text-muted);
            color: var(--text-light);
            border-radius: var(--border-radius);
        }

        .btn-outline-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--text-light);
        }

        /* Errores */
        .error-message {
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: -15px;
            margin-bottom: 15px;
        }

        .is-invalid {
            border-color: var(--error-color) !important;
        }

        .invalid-feedback {
            color: var(--error-color);
            font-size: 0.85rem;
        }

        /* Preview de imágenes */
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .image-preview {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px dashed rgba(255, 255, 255, 0.3);
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
        }
    </style>
</head>
<body>
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
        <div class="form-card">
            <h2 class="form-title">Registrar Nueva Experiencia</h2>

            <?php if (isset($validation)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('comunidad/guardar-experiencia') ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control <?= isset($validation) && $validation->hasError('titulo') ? 'is-invalid' : '' ?>" 
                        id="titulo" name="titulo" value="<?= old('titulo') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('titulo')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('titulo') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control <?= isset($validation) && $validation->hasError('descripcion') ? 'is-invalid' : '' ?>" 
                            id="descripcion" name="descripcion" required><?= old('descripcion') ?></textarea>
                    <?php if (isset($validation) && $validation->hasError('descripcion')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('descripcion') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                        <input type="date" class="form-control <?= isset($validation) && $validation->hasError('fecha_inicio') ? 'is-invalid' : '' ?>" 
                            id="fecha_inicio" name="fecha_inicio" value="<?= old('fecha_inicio') ?>" required>
                        <?php if (isset($validation) && $validation->hasError('fecha_inicio')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('fecha_inicio') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fecha_fin" class="form-label">Fecha Fin</label>
                        <input type="date" class="form-control <?= isset($validation) && $validation->hasError('fecha_fin') ? 'is-invalid' : '' ?>" 
                            id="fecha_fin" name="fecha_fin" value="<?= old('fecha_fin') ?>" required>
                        <?php if (isset($validation) && $validation->hasError('fecha_fin')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('fecha_fin') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="precio" class="form-label">Precio (S/)</label>
                    <input type="number" step="0.01" class="form-control <?= isset($validation) && $validation->hasError('precio') ? 'is-invalid' : '' ?>" 
                        id="precio" name="precio" value="<?= old('precio') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('precio')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('precio') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="cupos" class="form-label">Cupos Disponibles</label>
                    <input type="number" class="form-control <?= isset($validation) && $validation->hasError('cupos') ? 'is-invalid' : '' ?>" 
                        id="cupos" name="cupos" value="<?= old('cupos') ?>" required>
                    <?php if (isset($validation) && $validation->hasError('cupos')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('cupos') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <label for="imagenes" class="form-label">Imágenes (máx. 5, solo JPG/PNG)</label>
                    <input type="file" class="form-control <?= isset($validation) && $validation->hasError('imagenes') ? 'is-invalid' : '' ?>" 
                        id="imagenes" name="imagenes[]" accept=".jpg,.jpeg,.png" multiple required>
                    <?php if (isset($validation) && $validation->hasError('imagenes')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('imagenes') ?>
                        </div>
                    <?php endif; ?>
                    <small class="text-muted">Seleccione entre 1 y 5 imágenes</small>
                    
                    <div class="image-preview-container mt-3" id="imagePreview"></div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Guardar Experiencia</button>
                    <a href="<?= base_url('comunidad/menu') ?>" class="btn btn-outline-secondary">
                        ← Volver al Menú
                    </a>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview de imágenes seleccionadas
        document.getElementById('imagenes').addEventListener('change', function() {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';
            
            if (this.files) {
                const files = Array.from(this.files).slice(0, 5); // Limitar a 5 imágenes
                
                files.forEach(file => {
                    if (!file.type.match('image.*')) return;
                    
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('image-preview');
                        previewContainer.appendChild(img);
                    }
                    
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>
</body>
</html>