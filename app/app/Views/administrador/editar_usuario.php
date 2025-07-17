<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
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
            max-width: 800px;
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

        /* Formulario */
        .form-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
        }

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

        .form-select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: var(--border-radius);
            color: var(--text-light);
            padding: 12px 15px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .form-select:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.25rem rgba(28, 135, 255, 0.25);
            color: var(--text-light);
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

        .btn-secondary {
            border-radius: var(--border-radius);
            padding: 12px;
            width: 100%;
            margin-top: 15px;
            border: 1px solid var(--text-muted);
            color: var(--text-light);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Switch para estado */
        .form-check-input {
            width: 3em;
            height: 1.5em;
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .form-check-input:checked {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        option{
            color: #000;
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
    </header>

    <!-- Contenido principal -->
    <main class="admin-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="admin-title">Editar Usuario</h1>
            <a href="<?= base_url('/admin/ver_usuarios') ?>" class="btn btn-outline-light btn-sm">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>

        <div class="form-card">
            <form action="<?= base_url('/admin/actualizar_usuario') ?>" method="post">
                <input type="hidden" name="id_usuario" value="<?= esc($usuario['id_usuario']) ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre completo</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" 
                           value="<?= esc($usuario['nombre']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="correo" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" name="correo" id="correo" 
                           value="<?= esc($usuario['correo']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="tipo_cuenta" class="form-label">Tipo de cuenta</label>
                    <select class="form-select" name="tipo_cuenta" id="tipo_cuenta" required>
                        <option value="Comunidad" <?= $usuario['tipo_cuenta'] == 'Comunidad' ? 'selected' : '' ?>>Comunidad</option>
                        <option value="Admin" <?= $usuario['tipo_cuenta'] == 'Admin' ? 'selected' : '' ?>>Administrador</option>
                        <option value="Turista" <?= $usuario['tipo_cuenta'] == 'Turista' ? 'selected' : '' ?>>Turista</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="contrasena" class="form-label">Nueva contraseña (opcional)</label>
                    <input type="password" class="form-control" name="contrasena" id="contrasena"
                           placeholder="Dejar en blanco para mantener la actual">
                    <small class="text-muted">Mínimo 8 caracteres</small>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar cambios
                    </button>
                    <a href="<?= base_url('/admin/ver_usuarios') ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </main>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Cambiar texto del estado cuando se modifica el switch
        document.getElementById('activo').addEventListener('change', function() {
            const label = document.querySelector('label[for="activo"]');
            label.textContent = this.checked ? 'Activo' : 'Inactivo';
        });
    </script>
</body>
</html>