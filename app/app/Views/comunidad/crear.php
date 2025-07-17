
<!-- app/Views/comunidad/crear.php -->
<?= $this->extend('layout'); ?> <!-- Extiende el layout base -->

<?= $this->section('content'); ?> <!-- Contenido específico de la página -->
<!-- Estilos CSS -->
<style>
    .experience-form {
        max-width: 800px;
        margin: 0 auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: var(--primary-color);
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
    }

    .form-group input, .form-group textarea {
        width: 100%;
        padding: 12px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 8px;
        outline: none;
        transition: all 0.3s ease;
    }

    .form-group input:focus, .form-group textarea:focus {
        border-color: var(--primary-color);
    }

    .form-group textarea {
        resize: vertical;
        height: 120px;
    }

    .form-group input[type="file"] {
        padding: 5px;
        background-color: #f7f7f7;
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-submit:hover {
        background-color: var(--primary-hover);
    }

    /* Estilos para dispositivos móviles */
    @media (max-width: 768px) {
        .experience-form {
            padding: 20px;
        }
    }

    /* Vista previa de la imagen */
    #image-preview img {
        max-width: 100%;
        border-radius: 8px;
        margin-top: 10px;
    }
</style>

<h2>Agregar Nueva Experiencia</h2>

<!-- Mostrar mensaje de éxito -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<!-- Si hay errores de validación, mostrarlos -->
<?php if (isset($validation) && $validation->getErrors()): ?>
    <div class="errors" style="color: red; margin-bottom: 20px;">
        <ul>
            <?php foreach ($validation->getErrors() as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Formulario para crear una experiencia -->
<form action="<?= base_url('comunidad/crear'); ?>" method="post" enctype="multipart/form-data" class="experience-form">
    <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo" required placeholder="Ingrese el título de la experiencia" value="<?= old('titulo') ?>">
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" required placeholder="Escribe una breve descripción de la experiencia" rows="5"><?= old('descripcion') ?></textarea>
    </div>

    <div class="form-group">
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" id="imagen" accept="image/*">
        <div id="image-preview" style="margin-top: 10px;"></div>
    </div>

    <div class="form-group">
        <label for="precio">Precio</label>
        <input type="text" name="precio" id="precio" required placeholder="Ingrese el precio de la experiencia" value="<?= old('precio') ?>">
    </div>

    <div class="form-group">
        <label for="cupo">Cupo disponible</label>
        <input type="number" name="cupo" id="cupo" required placeholder="Cantidad de personas permitidas" value="<?= old('cupo') ?>">
    </div>

    <div class="form-group">
        <label for="fecha_inicio">Fecha de inicio</label>
        <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" required value="<?= old('fecha_inicio') ?>">
    </div>

    <button type="submit" class="btn-submit">Crear Experiencia</button>
</form>

<?= $this->endSection(); ?> <!-- Fin de la sección de contenido -->

