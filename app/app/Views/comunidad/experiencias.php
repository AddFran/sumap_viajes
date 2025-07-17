<!-- app/Views/comunidad/experiencias.php -->
<?= $this->extend('layout'); ?> <!-- Extiende el layout base -->

<?= $this->section('content'); ?> <!-- Contenido específico de la página -->
<!-- Estilos CSS -->
<style>
    .experiencia-card {
        background-color: #f9f9f9;
        padding: 20px;
        margin: 20px 0;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .experiencia-imagen img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        margin-top: 10px;
    }

    /* Botón para editar y eliminar experiencia */
    .experiencia-actions {
        margin-top: 10px;
    }

    .btn-edit, .btn-delete {
        padding: 8px 15px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        margin-right: 10px;
    }

    .btn-edit {
        background-color: #7a8aff;
        color: white;
    }

    .btn-delete {
        background-color: #ff5b5b;
        color: white;
    }

    /* Botón flotante para agregar experiencia */
    .btn-add {
        background-color: #96AFFF;
        color: white;
        padding: 15px 20px;
        border-radius: 50%;
        font-size: 24px;
        position: fixed;
        bottom: 20px;
        right: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-add:hover {
        background-color: #7a8aff;
    }

    .btn-add i {
        font-size: 30px;
    }
</style>

<h2>Gestionar Experiencias de la Comunidad</h2>

<!-- Lista de experiencias -->
<div class="experiencias-list">
    <p>Lista de experiencias publicadas:</p>
    <ul>
        <!-- Ciclo para mostrar todas las experiencias -->
        <?php if (!empty($experiencias)): ?>
            <?php foreach ($experiencias as $experiencia): ?>
                <li class="experiencia-card">
                    <div class="experiencia-header">
                        <strong class="titulo"><?= esc($experiencia['titulo']); ?></strong>
                        <span class="estado"><?= esc($experiencia['estado']); ?></span>
                    </div>
                    <p class="descripcion"><?= esc($experiencia['descripcion']); ?></p>
                    <div class="experiencia-details">
                        <p><strong>Precio:</strong> $<?= esc($experiencia['precio']); ?></p>
                        <p><strong>Cupo disponible:</strong> <?= esc($experiencia['cupo']); ?></p>
                        <p><strong>Fecha de inicio:</strong> <?= esc($experiencia['fecha_inicio']); ?></p>
                    </div>

                    <!-- Mostrar la imagen -->
                    <?php if ($experiencia['imagen']): ?>
                        <div class="experiencia-imagen">
                            <img src="<?= base_url('uploads/profile_pics/' . esc($experiencia['imagen'])); ?>" alt="Imagen de la experiencia" class="experiencia-img">
                        </div>
                    <?php else: ?>
                        <p>No hay imagen disponible para esta experiencia.</p>
                    <?php endif; ?>

                    <div class="experiencia-actions">
                        <a class="btn-edit" href="<?= base_url('comunidad/editar/' . $experiencia['id']); ?>">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a class="btn-delete" href="<?= base_url('comunidad/eliminar/' . $experiencia['id']); ?>" onclick="return confirm('¿Estás seguro de eliminar esta experiencia?');">
                            <i class="fas fa-trash-alt"></i> Eliminar
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay experiencias publicadas aún.</p>
        <?php endif; ?>
    </ul>
</div>

<!-- Botón para agregar una nueva experiencia -->
<div class="add-experience">
    <a href="<?= base_url('comunidad/crear'); ?>" class="btn-add">
        <i class="fas fa-plus-circle"></i> Agregar nueva experiencia
    </a>
</div>

<?= $this->endSection(); ?> <!-- Fin de la sección de contenido -->

